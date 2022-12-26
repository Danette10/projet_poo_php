<?php
namespace App\Spells;

use App\Classes\Spell;

class AttackSpell extends Spell
{
    public function __construct(
        private int $attackEfficiency,
        string $name,
        string $description,
        int $manaCost
    ) {
        parent::__construct(
            name: $name,
            description: $description,
            manaCost: $manaCost,
            typeSpell: 'Attack',
            elementaryType: 'Fire',
            healingEfficiency: 0,
            attackEfficiency: $attackEfficiency,
            defenceEfficiency: 0,
        );
    }


    // Getter & Setter for AttackEfficiency
    public function getAttackEfficiency()
    {
        return $this->attackEfficiency;
    }

    public function setAttackEfficiency(int $attackEfficiency)
    {
        $this->attackEfficiency = $attackEfficiency;
    }

    //
}
