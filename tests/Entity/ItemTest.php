<?php

namespace App\Tests\Entity;

use App\Entity\Item;
use App\Entity\Location;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{

    /**
     * @var \App\Entity\Location
     */
    private $location;
    /**
     * @var \App\Entity\Item
     */
    private $item;

    protected function setUp(): void
    {
        $this->location = new Location();
        $this->location->setDescription('Description');
        $this->location->setName('Name');
        $this->item = new Item();
        $this->location->addItem($this->item);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

    }
    public function testSetNumber()
    {
        $this->item->setNumber(15);
        $this->assertEquals(15, $this->item->getNumber());
    }

    public function testGetReview()
    {
        $this->item->setReview(new \DateTime('2023-5-21'));
        $this->assertEquals(new \DateTime('2023/5/21'), $this->item->getReview());
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->item->getId());
    }

    public function testGetLocation()
    {
        $this->assertEquals($this->location, $this->item->getLocation());
    }

    public function testSetReview()
    {
        $this->item->setReview(new \DateTime('2023-5-21'));
        $this->assertEquals(new \DateTime('2023/5/21'), $this->item->getReview());
    }

    public function testSetLocation()
    {
        $this->assertEquals($this->location, $this->item->getLocation());
    }

    public function testGetNumber()
    {
        $this->item->setNumber(15);
        $this->assertEquals(15, $this->item->getNumber());
    }
}
