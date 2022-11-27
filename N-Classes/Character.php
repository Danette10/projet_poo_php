<?php

abstract class Character
{
    public function __construct(
        string $name, 
        string $attacktType, 
        string $elementarytType, 
        int $health, 
        int $physicalAttack, 
        int $magicalAttack, 
        int $defence,
        int $mana,
        int $manaRecoveryRate,
        ?Weapon $weapon
    )
    {
        $this->name = $name;
        $this->attacktType = $attacktType;
        $this->elementarytType = $elementarytType;
        $this->health = $health;
        $this->physicalAttack = $physicalAttack;
        $this->magicalAttack = $magicalAttack;
        $this->defence = $defence;
        $this->mana = $mana;
        $this->manaRecoveryRate = $manaRecoveryRate;
        $this->weapon = $weapon;
    }

    
}