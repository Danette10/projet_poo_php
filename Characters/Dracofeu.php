<?php
namespace App\Characters;

use App\Classes\Character;

class Dracofeu extends Character
{
    public function __construct()
    {
        parent::__construct(
            name: 'Dracofeu',
            attacktType: 'Magical',
            elementarytType: 'Fire',
            health: 100,
            physicalAttack: 0,
            magicalAttack: 20,
            defence: 10,
            mana: 100,
            manaRecoveryRate: 10,
            weapon: null,
            spell: null,
            isProtectedByDefenceSpell: false,
            bonusAttack: false,
        );
    }
}