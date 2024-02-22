<?php

namespace App\Tests;

use App\Entity\Trader; 

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TraderFunctionalTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('h1', 'Hello World');
    }
}
