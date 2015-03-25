<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Business\VdmBusiness;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Vdm;

class DefaultControllerTest extends WebTestCase
{

    public function testVdmScenarioTest()
    {
    	$urlHome = "http://www.viedemerde.fr/";
        $client = static::createClient();

        $crawler = $client->request('GET', $urlHome);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $crawler->filter('.wrapper div.post.article');
        foreach ($crawler as $node) {
            $vdm = VdmBusiness::parseOneVdm($node);
            $this->assertTrue(trim($vdm->getContent()) != "");
        }
    }

    public function testApiScenarioTest()
    {
    	$client = static::createClient();
        $client->request('GET', '/api/posts');

		$response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
	    $this->assertSame('application/json', $response->headers->get('Content-Type'));
	    $this->assertNotEmpty($client->getResponse()->getContent());

    }
}
