<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SignUpControllerControllerTest extends WebTestCase
{
    public function testSignup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/SignUp');
    }

}
