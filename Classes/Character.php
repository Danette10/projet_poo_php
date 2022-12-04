<?php
namespace App\Classes;

use Weapon;

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
        protected ?Spell $spell,
        protected bool $isProtectedByDefenceSpell,
        protected bool $bonusAttack,
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
        $this->spell = $spell;
        $this->isProtectedByDefenceSpell = false;
        $this->bonusAttack = false;
    }

    //Getter & Setter for normals attributs
    public function getElementaryType()
    {
        return $this->elementarytType;
    }

    public function getHealth(){
        return $this->health;
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

    //Getter & Setter for Spell
    public function getSpell(){
        return $this->spell;
    }

    public function setSpell(Spell $spell){
        $this->spell = $spell;
    }

    public function setAttackSpells(array $array)
    {
        $this->attackSpells = $array;
    }

    public function getAttackSpells()
    {
        return $this->attackSpells;
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
    public function setBonusAttack($enemy): bool
    {
        switch ($this->elementarytType) {
            case 'Water':

                if ($enemy->getElementaryType() === 'Fire') {

                    $this->bonusAttack = true;

                }

                break;

            case 'Fire':

                if ($enemy->getElementaryType() === 'Plant') {

                    $this->bonusAttack = true;

                }

                break;

            case 'Plant':

                if ($enemy->getElementaryType() === 'Water') {

                    $this->bonusAttack = true;

                }

                break;

            default:

                $this->bonusAttack = false;

                break;
        }

        return $this->bonusAttack;
    }

    public function attackEnemy(Character $enemy, bool $isAttackSpell){

        echo $this->name . ' attaque ' . $enemy->getName() . PHP_EOL;

        if($this->setBonusAttack($enemy)){
            // Text color in green
            echo "\033[32m";
            echo $this->name . ' a un bonus d\'attaque de 10 points !' . PHP_EOL;
            echo "\033[0m";
            if($isAttackSpell == true){
                $enemy->receiveAttack(0, $this->spell->getAttackEfficiency() + $this->magicalAttack + 10);
            }
            else{
                $enemy->receiveAttack($this->physicalAttack, $this->magicalAttack + 10);
            }
        }else{
            if($isAttackSpell == true){
                $enemy->receiveAttack(0, $this->spell->getAttackEfficiency() + $this->magicalAttack);
            }
            else{
                $enemy->receiveAttack($this->physicalAttack, $this->magicalAttack);
            }
        }

    }

    public function receiveAttack(int $physicalAttack, int $magicalAttack){

        if($this->getIsProtectedByDefenceSpell() == true){
            $precedentDefence = $this->getDefence();

            //Besoin de limité le plafond/seuil de la défense totale
            $this->setDefence($this->getDefenceSpell()->getDefenceEfficiency() + $this->getDefence());

            $this->setHealth($this->getHealth() - ($physicalAttack + $magicalAttack) + $this->getDefence());

            $this->setDefence($precedentDefence);
            $this->setIsProtectedByDefenceSpell(false);
        }
        else{
            $this->setHealth($this->getHealth() - ($physicalAttack + $magicalAttack) + $this->getDefence());
        }

        if($this->getHealth() <= 0){
            $this->setHealth(0);
        }

        echo $this->getName()." possède : ".$this->getHealth()." points de vie".PHP_EOL . PHP_EOL;
    }

    //Methods of Spells
    /*
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
    }*/

    public function recoverMana(){
        //Besoin de limité le plafond/seuil de mana

        $this->setMana($this->getMana() + $this->getManaRecoveryRate());

        //reduction de mana
    }
}