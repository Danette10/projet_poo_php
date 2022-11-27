<?php

abstract class Spell
{
    public function __construct(
        public int $healingEfficiency,
        public int $attackEfficiency,
        public int $defenceEfficiency,
    )
    {
        $this->healingEfficiency = $healingEfficiency;
        $this->attackEfficiency = $attackEfficiency;
        $this->defenceEfficiency = $defenceEfficiency;
    }

    public function getHealingEfficiency(){
        return $this->healingEfficiency;
    }

    public function setHealingEfficiency(int $healingEfficiency){
        $this->healingEfficiency = $healingEfficiency;
    }

    public function getAttackEfficiency(){
        return $this->attackEfficiency;
    }

    public function setAttackEfficiency(int $attackEfficiency){
        $this->attackEfficiency = $attackEfficiency;
    }

    public function getDefenceEfficiency(){
        return $this->defenceEfficiency;
    }

    public function setDefenceEfficiency(int $defenceEfficiency){
        $this->defenceEfficiency = $defenceEfficiency;
    }
}