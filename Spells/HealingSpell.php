<?php
namespace App\Spells;

use App\Classes\Spell;

class HealingSpell extends Spell
{
    public function __construct(
        private int $healingEfficiency,
        private string $name,
        private string $description,
        private int $manaCost
    ) {
        $this->healingEfficiency = $healingEfficiency;
        $this->name = $name;
        $this->description = $description;
        $this->manaCost = $manaCost;
    }

    // Getter & Setter for HealingEfficiency
    public function getHealingEfficiency(){
        return $this->healingEfficiency;
    }

    public function setHealingEfficiency(int $healingEfficiency){
        $this->healingEfficiency = $healingEfficiency;
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