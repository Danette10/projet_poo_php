<?php

class Spell
{
    public function __construct(
        private string $name,
        private string $description,
        private int $manaCost
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getManaCost(): int
    {
        return $this->manaCost;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}