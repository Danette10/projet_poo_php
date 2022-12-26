<?php

namespace App\Classes;


abstract class Weapon{

	protected string $name;
    protected string $description;
    protected float $physicalDamageRatio;
    protected float $magicalDamageRatio;
    
    public function __construct(string $name,string $description,float $physicalDamageRatio,float $magicalDamageRatio
    ) {
    	$this->name = $name;
    	$this->description = $description;
    	$this->physicalDamageRatio = $physicalDamageRatio;
    	$this->magicalDamageRatio = $magicalDamageRatio;
    	
    }

    abstract public function applyBonus(float $baseDamages);

    public function getName(): string{
        return $this->name;
    }

    public function getDescription(): string{
        return $this->description;
    }
    
    public function getPhysicalDamageRatio(): float{
    	return $this->physicalDamageRatio;
    }
    
    public function getMagicalDamageRatio(): float{
    	return $this->magicalDamageRatio;
    }

    public function __toString() {
        return "{$this->getName()}, ".lcfirst($this->getDescription()).PHP_EOL;
    }


    
}
