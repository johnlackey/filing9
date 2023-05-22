<?php

namespace App\Tests\Entity;

use App\Entity\Item;
use App\Entity\Location;
use PHPUnit\Framework\TestCase;


class LocationTest extends TestCase
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
    public function testGetDescription()
    {
        $this->assertEquals('Description', $this->location->getDescription());
    }

    public function testRemoveItem()
    {
        $items = $this->location->getItems();
        $this->location->removeItem($items[0]);
        $this->assertFalse($this->location->getItems()->contains($items[0]));
        $this->assertEquals(null, $this->item->getLocation());
    }

    public function testAddItem()
    {
        $this->assertTrue($this->location->getItems()->contains($this->item));
        $this->assertEquals($this->location, $this->item->getLocation());
    }

    public function testSetName()
    {
        $this->location->setName('Name');
        $this->assertEquals('Name', $this->location->getName());
    }

    public function testGetItems()
    {
        $this->assertTrue($this->location->getItems()->contains($this->item));
    }

    public function testGetId()
    {
        $this->assertEquals(null, $this->location->getId());
    }

    public function testGetName()
    {
        $this->assertEquals('Name', $this->location->getName());
    }

    public function testSetDescription()
    {
        $this->assertEquals('Description', $this->location->getDescription());
    }
}
