<?php
namespace App\Spells;

use App\Classes\Spell;

class DefenceSpell extends Spell
{
    public function __construct(
        private int $defenceEfficiency,
        private string $name,
        private string $description,
        private int $manaCost
    ) {
        $this->defenceEfficiency = $defenceEfficiency;
        $this->name = $name;
        $this->description = $description;
        $this->manaCost = $manaCost;
    }

    // Getter & Setter for DefenceEfficiency
    public function getDefenceEfficiency(){
        return $this->defenceEfficiency;
    }

    public function setDefenceEfficiency(int $defenceEfficiency){
        $this->defenceEfficiency = $defenceEfficiency;
    }

    // Getter for Name
    public function getName(): string
    {
        return $this->name;
    }

    // Getter for Description
    public function getDescription(): string
    {
        return $this->description;
    }

    // Getter for ManaCost
    public function getManaCost(): int
    {
        return $this->manaCost;
    }
}