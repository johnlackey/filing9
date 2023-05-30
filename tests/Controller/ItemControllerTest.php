<?php

namespace App\Tests\Controller;

use ApiTestCase\JsonApiTestCase;
use PHPUnit\Framework\Constraint\IsType;
use PhrozenByte\PHPUnitArrayAsserts\ArrayAssertsTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;

class ItemControllerTest extends WebTestCase
{
    use Factories;
    use ArrayAssertsTrait;
    public function testIndex()
    {
        $client = static::createClient();
        static::ensureKernelShutdown();
        $crawler = $client->request('GET', '/api/item');

        $this->assertResponseIsSuccessful();
        $response = $client->getResponse();
        $json_decode = \Safe\json_decode($response->getContent(), true);
        $this->assertAssociativeArray(
            [
                'id' => $this->isType(IsType::TYPE_INT),
                'location' => 'Location 1',
                'number' => 15
            ],
            $json_decode[0]
        );
    }
}
