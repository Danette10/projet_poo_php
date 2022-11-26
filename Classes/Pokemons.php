<?php

abstract class Pokemons
{
    public function __construct($namePoke, $type, $life, $strength, $defense)
    {
        $this->namePoke = $namePoke;
        $this->type = $type;
        $this->life = $life;
        $this->strength = $strength;
        $this->defense = $defense;
    }
}