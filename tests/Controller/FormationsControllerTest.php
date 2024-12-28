<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of FormationsControllerTest
 *
 * @author sysadmin
 */
class FormationsControllerTest extends WebTestCase
{
    public function test()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/'); //INTERNAL SERVER ERROR
        $this->assertSelectorTextContains('h3', 'Bienvenue sur le site');
    }
    public function testSort()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/formations');
        $table = $crawler->filter("table#rows");
        $this->assertResponseIsSuccessful(); //INTERNAL SERVER ERROR
    }
    
}
