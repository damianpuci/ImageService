<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddImageControllerTest extends WebTestCase
{
    public function testAddimage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AddImage');
    }

}
