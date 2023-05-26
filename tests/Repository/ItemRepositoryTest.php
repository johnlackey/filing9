<?php

namespace App\Tests\Repository;

use App\Entity\Item;
use App\Factory\ItemFactory;
use App\Repository\ItemRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\Exception\MissingIdentifierField;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;

class ItemRepositoryTest extends KernelTestCase
{
    use Factories;

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
        // $item_produced = ItemFactory::new()->create(['number' => 15]);
        static::ensureKernelShutdown();
        $item = $this->entityManager
            ->getRepository(Item::class)
            ->findOneBy(['number' => 15])
        ;

        $this->assertEquals(new \DateTime('2023-06-21'), $item->getReview());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testFindOneBy()
    {
        $item = $this->entityManager
            ->getRepository(Item::class)
            ->findOneBy(['number' => 15])
        ;

        $this->assertEquals(new \DateTime('2023-06-21'), $item->getReview());
    }

    public function testSave()
    {
        // Create a basic version of the entity and store it
        $originalEntity = new Item();
        $originalEntity->setNumber(16);
        $originalEntity->setReview(new \DateTime('2023-05-22'));
        $this->entityManager->getRepository(Item::class)->save($originalEntity, true);

        // Now load it from the database
        $entityFromDatabase = $this->entityManager->getRepository(Item::class)->find($originalEntity->getId());

        // Compare it to the entity you created for this test
        self::assertEquals($originalEntity, $entityFromDatabase);
        $this->entityManager->getRepository(Item::class)->remove($originalEntity, true);
    }

    public function testRemove()
    {
        // Create the entity
        $originalEntity = new Item();
        $originalEntity->setNumber(117);
        $originalEntity->setReview(new \DateTime('2023-05-23'));
        $this->entityManager->getRepository(Item::class)->save($originalEntity, true);

        // Create another entity
        $anotherEntity = new Item();
        $anotherEntity->setNumber(18);
        $anotherEntity->setReview(new \DateTime('2023-05-24'));
        $this->entityManager->getRepository(Item::class)->save($anotherEntity, true);

        // Now delete that other entity
        $this->entityManager->getRepository(Item::class)->remove($anotherEntity, true);

        // Verify that the first entity still exists
        $entityFromDatabase = $this->entityManager->getRepository(Item::class)->find($originalEntity->getId());
        self::assertEquals($originalEntity, $entityFromDatabase);
        $this->entityManager->getRepository(Item::class)->remove($originalEntity, true);

        // Verify that the second entity we just removed, can't be found
        $this->expectException(MissingIdentifierField::class);
        $this->entityManager->getRepository(Item::class)->find($anotherEntity->getId());
    }
}
