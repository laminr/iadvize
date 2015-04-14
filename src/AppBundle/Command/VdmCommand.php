<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Business\VdmBusiness;
use AppBundle\Entity\Vdm;
use AppBundle\Manager\CurlManager;
use Symfony\Component\DomCrawler\Crawler;

class VdmCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vdm:import')
            ->setDescription('import some Vdm articles')
            ->addArgument('number', InputArgument::OPTIONAL, 'How many Vdm do you want')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $input->getArgument('number');
        if (!$number) $number = 200;

        $urlHome = "http://www.viedemerde.fr/";

        // empty the database
        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->getRepository(Vdm::CLASS_NAME)->deleteData();

        $curl = new CurlManager();

        $howMany = 0;
        while ($howMany < $number) {

            $html = $curl->getData( $urlHome.($howMany >0 ? "?page=".$howMany : ""));
            $crawler = new Crawler($html);

            $crawler = $crawler->filter('.wrapper div.post.article');
            foreach ($crawler as $node) {

                $vdm = VdmBusiness::parseOneVdm($node);
                if ($vdm->getContent() != "") {

                    $output->writeln($howMany." : ".$vdm->getContent());
                    $em->persist($vdm);
                    $em->flush();

                    $howMany++;
                }

                if ($howMany == $number) break;
            }
        }

        $output->writeln("Done: ".$howMany);
    }
}