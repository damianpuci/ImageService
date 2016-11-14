<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TopRatedControllerTest extends WebTestCase
{
    public function testShowtoprated()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ShowTopRated');
    }

}
