<?php

namespace App\Tests\Repository;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Doctrine\ORM\Exception\MissingIdentifierField;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LocationRepositoryTest extends KernelTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSearchByName()
    {
        $location = $this->entityManager
            ->getRepository(Location::class)
            ->findOneBy(['name' => 'Location 1'])
        ;

        $this->assertEquals('Description 1', $location->getDescription());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testSave()
    {
        // Create a basic version of the entity and store it
        $originalEntity = new Location();
        $originalEntity->setName('Location 2');
        $this->entityManager->getRepository(Location::class)->save($originalEntity, true);

        // Now load it from the database
        $entityFromDatabase = $this->entityManager->getRepository(Location::class)->find($originalEntity->getId());

        // Compare it to the entity you created for this test
        self::assertEquals($originalEntity, $entityFromDatabase);
    }

    public function testRemove()
    {
        // Create the entity
        $originalEntity = new Location();
        $originalEntity->setName('Location 3');
        $this->entityManager->getRepository(Location::class)->save($originalEntity, true);

        // Create another entity
        $anotherEntity = new Location();
        $anotherEntity->setName('Location 4');
        $this->entityManager->getRepository(Location::class)->save($anotherEntity, true);

        // Now delete that other entity
        $this->entityManager->getRepository(Location::class)->remove($anotherEntity, true);

        // Verify that the first entity still exists
        $entityFromDatabase = $this->entityManager->getRepository(Location::class)->find($originalEntity->getId());
        self::assertEquals($originalEntity, $entityFromDatabase);

        // Verify that the second entity we just removed, can't be found
        $this->expectException(MissingIdentifierField::class);
        $this->entityManager->getRepository(Location::class)->find($anotherEntity->getId());
    }
}
