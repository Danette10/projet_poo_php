<?php
namespace App\Classes;

abstract class Spell
{
    public function __construct(
        private string $name,
        private string $description,
        private int $manaCost,
        private string $typeSpell,
        private string $elementaryType,
        private int $healingEfficiency,
        private int $attackEfficiency,
        private int $defenceEfficiency,
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->manaCost = $manaCost;
        $this->typeSpell = $typeSpell;
        $this->elementaryType = $elementaryType;
        $this->healingEfficiency = $healingEfficiency;
        $this->attackEfficiency = $attackEfficiency;
        $this->defenceEfficiency = $defenceEfficiency;
    }

    // Getter for name
    public function getName()
    {
        return $this->name;
    }

    // Getter for description
    public function getDescription()
    {
        return $this->description;
    }

    // Getter for manaCost
    public function getManaCost()
    {
        return $this->manaCost;
    }

    // Getter & Setter for typeSpell
    public function getTypeSpell()
    {
        return $this->typeSpell;
    }

    public function setTypeSpell(string $typeSpell)
    {
        $this->typeSpell = $typeSpell;
    }

    // Getter & Setter for elementaryType
    public function getElementaryType()
    {
        return $this->elementaryType;
    }

    public function setElementaryType(string $elementaryType)
    {
        $this->elementaryType = $elementaryType;
    }

    // Getter & Setter for healingEfficiency
    public function getHealingEfficiency()
    {
        return $this->healingEfficiency;
    }

    public function setHealingEfficiency(int $healingEfficiency)
    {
        $this->healingEfficiency = $healingEfficiency;
    }

    // Getter & Setter for attackEfficiency
    public function getAttackEfficiency()
    {
        return $this->attackEfficiency;
    }

    public function setAttackEfficiency(int $attackEfficiency)
    {
        $this->attackEfficiency = $attackEfficiency;
    }

    // Getter & Setter for defenceEfficiency
    public function getDefenceEfficiency()
    {
        return $this->defenceEfficiency;
    }

    public function setDefenceEfficiency(int $defenceEfficiency)
    {
        $this->defenceEfficiency = $defenceEfficiency;
    }

}