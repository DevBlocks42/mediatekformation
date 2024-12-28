<?php

use \Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Description of FormationsCompatTest
 *
 * @author sysadmin
 */
class FormationsCompatTest extends PantherTestCase
{
    public function testAccueil()
    {
        $client = Client::createChromeClient('/var/www/html/mediatekformation/drivers/chromedriver');
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
    }
}
