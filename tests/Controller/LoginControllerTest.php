<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    /**
     * @test
     * Se connecter en tant qu'admin
     */
    public function checkAdminConnection(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $submitBtn = $crawler->selectButton('submit');
        var_dump($submitBtn);
        /*$form = $submitBtn->form();
        $data = [
            'inputEmail' => 'admin@email.fr',
            'inputPassword' => 'password',
        ];*/


        $this->assertSelectorTextContains('h1', 'Connectez-vous à votre compte');

        $this->assertResponseIsSuccessful();


//        $client->submit($form, $data);
    }
}
