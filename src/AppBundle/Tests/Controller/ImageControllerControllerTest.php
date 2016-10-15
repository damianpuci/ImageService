<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageControllerControllerTest extends WebTestCase
{
    public function testShowdefaultimage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ShowDefaultImage');
    }

}
