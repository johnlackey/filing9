<?php

namespace App\Factory;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Item>
 *
 * @method        Item|Proxy create(array|callable $attributes = [])
 * @method static Item|Proxy createOne(array $attributes = [])
 * @method static Item|Proxy find(object|array|mixed $criteria)
 * @method static Item|Proxy findOrCreate(array $attributes)
 * @method static Item|Proxy first(string $sortedField = 'id')
 * @method static Item|Proxy last(string $sortedField = 'id')
 * @method static Item|Proxy random(array $attributes = [])
 * @method static Item|Proxy randomOrCreate(array $attributes = [])
 * @method static ItemRepository|RepositoryProxy repository()
 * @method static Item[]|Proxy[] all()
 * @method static Item[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Item[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Item[]|Proxy[] findBy(array $attributes)
 * @method static Item[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Item[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ItemFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'number' => self::faker()->randomNumber(),
            'review' => self::faker()->dateTime(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Item $item): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Item::class;
    }
}
