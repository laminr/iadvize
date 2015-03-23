<?php

namespace AppBundle\Controller;

use AppBundle\Business\VdmBusiness;
use AppBundle\Entity\Vdm;
use AppBundle\Manager\CurlManager;
use Symfony\Component\DomCrawler\Crawler;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{

    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $publics = $em->getRepository(Vdm::CLASS_NAME)->findAll();


        return new JsonResponse($publics);
    }

    /**
     * @Route("/app/parse", name="parse")
     */
    public function parseAction()
    {
        $urlHome = "http://www.viedemerde.fr/";


        // empty the database
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(Vdm::CLASS_NAME)->deleteData();

        $curl = new CurlManager();

        $howMany = 0;
        while ($howMany <= 200) {

            $html = $curl->getData( $urlHome.($howMany >0 ? "?page=".$howMany : ""));
            $crawler = new Crawler($html);
            //*
            $crawler = $crawler->filter('.wrapper div.post.article');
            foreach ($crawler as $node) {

                $vdm = VdmBusiness::parseOneVdm($node);
                $em->persist($vdm);
                $em->flush();
                $howMany++;
                if ($howMany == 200) break;
            }
        }

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/api/posts", name="_posts")
     */
    public function postsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $publics = $em->getRepository(Vdm::CLASS_NAME)->findAll();

        $data = array();
        foreach($publics as $vdm ) {
            $vdmJson = array(
                "id" => $vdm->getId(),
                "content" => $vdm->getContent(),
                "date" => $vdm->getWhen()->format("Y-m-d H:i:s"),
                "author" => $vdm->getAuthor(),
            );
            array_push($data, $vdmJson);
        }

        $json = array("posts" => $data, "count" =>count($data) );
        return new JsonResponse($json);
    }

    /**
     * @Route("/api/posts/from/{from}/to/{to}", name="_posts_with_date")
     */
    public function postsWithDateAction($from = "", $to = "")
    {
        $em = $this->getDoctrine()->getManager();
        $publics = $em->getRepository(Vdm::CLASS_NAME)->findOverPeriod($from, $to);

        $data = array();
        foreach($publics as $vdm ) {
            $vdmJson = array(
                "id" => $vdm->getId(),
                "content" => $vdm->getContent(),
                "date" => $vdm->getWhen()->format("Y-m-d H:i:s"),
                "author" => $vdm->getAuthor(),
            );
            array_push($data, $vdmJson);
        }

        $json = array("posts" => $data, "count" =>count($data) );
        return new JsonResponse($json);
    }

    /**
     * @Route("/api/posts/author/{author}", name="_posts_author")
     */
    public function postsByAuthorAction($author = "")
    {
        $em = $this->getDoctrine()->getManager();
        $publics = $em->getRepository(Vdm::CLASS_NAME)->findByAuthor($author);

        $data = array();
        foreach($publics as $vdm ) {
            $vdmJson = array(
                "id" => $vdm->getId(),
                "content" => $vdm->getContent(),
                "date" => $vdm->getWhen()->format("Y-m-d H:i:s"),
                "author" => $vdm->getAuthor(),
            );
            array_push($data, $vdmJson);
        }

        $json = array("posts" => $data, "count" =>count($data) );
        return new JsonResponse($json);
    }

    /**
     * @Route("/api/posts/id/{id}", name="_posts_id")
     */
    public function postsById($id = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $publics = $em->getRepository(Vdm::CLASS_NAME)->findById($id);

        $data = array();
        foreach($publics as $vdm ) {
            $vdmJson = array(
                "id" => $vdm->getId(),
                "content" => $vdm->getContent(),
                "date" => $vdm->getWhen()->format("Y-m-d H:i:s"),
                "author" => $vdm->getAuthor(),
            );
            array_push($data, $vdmJson);
        }

        $json = array("posts" => $data, "count" =>count($data) );
        return new JsonResponse($json);
    }
}
