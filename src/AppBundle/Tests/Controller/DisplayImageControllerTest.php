<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DisplayImageControllerTest extends WebTestCase
{
    public function testDisplayimage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/DisplayImage');
    }

}
