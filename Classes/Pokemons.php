<?php

abstract class Pokemons
{
    public function __construct($name, $type, $health, $attack, $defence)
    {
        $this->name = $name;
        $this->type = $type;
        $this->health = $health;
        $this->attack = $attack;
        $this->defence = $defence;
    }

    
}