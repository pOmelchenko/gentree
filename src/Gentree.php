<?php

namespace DevOmelchenko\Gentree;

use JsonException;

class Gentree
{
    /**
     * Name of application
     */
    private const NAME = 'Gentree';

    /**
     * Version of application
     */
    private const VERSION = '0.0.0';

    /**
     * Tree storage
     *
     * @var array<?Item>
     */
    private array $tree = [];

    /**
     * Return name of application
     *
     * @return string
     */
    public static function name(): string
    {
        return self::NAME;
    }

    /**
     * Return version of application
     *
     * @return string
     */
    public static function version(): string
    {
        return self::VERSION;
    }

    /**
     * Parse CSV file to tree of Items
     *
     * @param string $path
     * @return void
     */
    public function parseFile(string $path): void
    {
        $this->tree[] = new Item(
            itemName: 'dummy',
            parent: null,
            children: [],
        );

        $this->tree[] = new Item(
            itemName: 'dummy',
            parent: null,
            children: [
                new Item(
                    itemName: 'dummy',
                    parent: null,
                    children: [],
                )
            ],
        );
    }

    /**
     * @throws JsonException
     */
    public function toJson(bool $pretty): string
    {
        if ($pretty) {
            return json_encode($this->tree, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        }

        return json_encode($this->tree, JSON_THROW_ON_ERROR);
    }
}
