<?php

abstract class Character
{
    public function __construct(
        protected string $name, 
        protected string $attacktType, 
        protected string $elementarytType, 
        protected int $health, 
        protected int $physicalAttack, 
        protected int $magicalAttack, 
        protected int $defence,
        protected int $mana,
        protected int $manaRecoveryRate,
        protected ?Weapon $weapon,
        protected Spell $healingSpell,
        protected Spell $attackSpell,
        protected Spell $defenceSpell,
        protected bool $isProtectedByDefenceSpell,
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
        $this->healingSpell = $healingSpell;
        $this->attackSpell = $attackSpell;
        $this->defenceSpell = $defenceSpell;
        $this->isProtectedByDefenceSpell = false;
    }

    //Getter & Setter for normals attributs
    public function getHealth(){
        //Jamais utilisé
    }

    public function setHealth(int $health){
        $this->health = $health;
    }

    public function getDefence(){
        return $this->defence;
    }

    public function setDefence(int $defence){
        $this->defence = $defence;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(int $name){
        $this->name = $name;
    }

    //Getter & Setter for Spell
    public function getHealingSpell(){
        return $this->healingSpell;
    }

    public function setHealingSpell(Spell $healingSpell){
        $this->healingSpell = $healingSpell;
    }

    public function getAttackSpell(){
        return $this->attackSpell;
    }

    public function setAttackSpell(Spell $attackSpell){
        $this->attackSpell = $attackSpell;
    }

    public function getDefenceSpell(){
        return $this->defenceSpell;
    }

    public function setDefenceSpell(Spell $defenceSpell){
        $this->defenceSpell = $defenceSpell;
    }

    public function getIsProtectedByDefenceSpell(){
        return $this->isProtectedByDefenceSpell;
    }

    public function setIsProtectedByDefenceSpell(bool $isProtectedByDefenceSpell){
        $this->isProtectedByDefenceSpell = $isProtectedByDefenceSpell;
    }

    public function getMana(){
        return $this->mana;
    }

    public function setMana(int $mana){
        $this->mana = $mana;
    }

    public function getManaRecoveryRate(){
        return $this->manaRecoveryRate;
    }

    public function setManaRecoveryRate(int $manaRecoveryRate){
        $this->manaRecoveryRate = $manaRecoveryRate;
    }


    //Methods of Character
    public function attackEnemy(Character $enemy){
        $enemy->receiveAttack($this->physicalAttack, $this->magicalAttack);
        echo "Le ".$this->getName()." vient d'attaquer' : ".$enemy->getName().PHP_EOL;
    }

    public function receiveAttack(int $physicalAttack, int $magicalAttack){

        if($this->getIsProtectedByDefenceSpell() == true){
            $precedentDefence = $this->getDefence();

            //Besoin de limité le plafond/seuil de la défense totale
            $this->setDefence($this->getDefenceSpell()->getDefenceEfficiency() + $this->getDefence());

            //Besoin de rajouter les réduction de défense
            $this->setHealth($physicalAttack + $magicalAttack);

            $this->setDefence($precedentDefence);
            $this->setIsProtectedByDefenceSpell(false);
        }
        else{
            //Besoin de rajouter les réduction de défense
            $this->setHealth($physicalAttack + $magicalAttack);
        }

        echo "Le ".$this->getName()." possède : ".$this->getHealth()." points de vie".PHP_EOL;
    }

    //Methods of Spells
    public function triggerHealingSpell(){
        $this->setHealth($this->getHealingSpell()->getHealingEfficiency());
        echo "Le ".$this->getName()." vient de ce soigner de : ".$this->getHealingSpell()->getHealingEfficiency().PHP_EOL;
        
        //reduction de mana
        //Passe le tour
    }

    public function triggerAttackSpell(Character $enemy){
        $enemy->receiveAttack(0, $this->getAttackSpell()->getAttackEfficiency());
        echo "Le ".$this->getName()." vient de d'utiliser un sort d'attaque infligeant : ".$this->getAttackSpell()->getAttackEfficiency().PHP_EOL;

        //reduction de mana
        //Passe le tour
    }

    public function triggerDefenceSpell(){
        $this->setIsProtectedByDefenceSpell(true);
        
        //reduction de mana
    }

    public function recoverMana(){
        //Besoin de limité le plafond/seuil de mana

        $this->setMana($this->getMana() + $this->getManaRecoveryRate());
        
        //reduction de mana
    }


    
}