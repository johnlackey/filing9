<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Location;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $location = new Location();
        $location->setName('Location 1');
        $location->setDescription('Description 1');
        $manager->persist($location);
        $item = new Item();
        $item->setNumber(15);
        $item->setReview(new \DateTime('2023-06-21'));
        $manager->persist($item);
        $location->addItem($item);


        $manager->flush();
    }
}
