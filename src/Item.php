<?php

namespace DevOmelchenko\Gentree;

use JsonSerializable;

class Item implements JsonSerializable
{
    public function __construct(
        public readonly string $itemName,
        public readonly ?string $parent = null,
        /** @var array<Item> $children*/
        private array $children = [],
    ) {
        // ...
    }

    public function itemName(): string
    {
        return $this->itemName;
    }

    public function parent(): ?string
    {
        return $this->parent;
    }

    public function addChild(Item $item): void
    {
        $this->children[] = $item;
    }

    /**
     * @return array<Item>
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'itemName' => $this->itemName,
            'parent' => $this->parent,
            'children' => $this->children,
        ];
    }
}
