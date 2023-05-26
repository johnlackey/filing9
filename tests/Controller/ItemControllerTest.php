<?php

namespace App\Tests\Controller;

use ApiTestCase\JsonApiTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;

class ItemControllerTest extends WebTestCase
{
    use Factories;

    public function testIndex()
    {
        $client = static::createClient();
        static::ensureKernelShutdown();
        $crawler = $client->request('GET', '/api/item');

        $this->assertResponseIsSuccessful();
        $response = $client->getResponse();
        $json_decode = \Safe\json_decode($response->getContent(), true);
        $this->assertEquals([['id' => 217, 'location' => 'Location 1', 'number' => 15]], $json_decode);
    }
}
