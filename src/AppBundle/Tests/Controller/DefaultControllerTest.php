<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/app/example');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("Homepage")')->count() > 0);
    }

    public function getVdmScenario()
    {
    	$urlHome = "http://www.viedemerde.fr/";
        $client = static::createClient();

        $crawler = $client->request('GET', $urlHome);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $crawler->filter('.wrapper div.post.article');
        foreach ($crawler as $node) {

            $vdm = VdmBusiness::parseOneVdm($node);
            $this->assertTrue(trim($vdm->getText()) != "");
        }
    }

    public function getApiScenario()
    {

    	$client = static::createClient();
        $client->request('GET', '/api/posts');

		$response = $client->getResponse();
		
        $this->assertEquals(200, $response->getStatusCode());
	    $this->assertSame('application/json', $response->headers->get('Content-Type'));
	    $this->assertNotEmpty($client->getResponse()->getContent()); 

    }
}
