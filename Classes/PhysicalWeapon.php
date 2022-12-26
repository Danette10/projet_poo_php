<?php

namespace App\Classes;
//require_once('Weapon.php');

abstract class PhysicalWeapon extends Weapon{

    public function __construct(string $name, string $description, float $physicalDamagesRatio){
    
        parent::__construct($name, $description, $physicalDamagesRatio, 0);
    }

    public function applyBonus(float $baseDamages): float
    {
        return $baseDamages * percentToMultiplier($this->physicalDamageRatio);
    }
}
