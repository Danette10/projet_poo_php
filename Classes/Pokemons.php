<?php

abstract class Pokemons
{
    // nom, type, pv, attaque, defense

    public function __construct($nom, $type, $pv, $attaque, $defense)
    {
        $this->nom = $nom;
        $this->type = $type;
        $this->pv = $pv;
        $this->attaque = $attaque;
        $this->defense = $defense;
    }
}