<?php
namespace App\Characters;

use App\Classes\Character;

class Tortipouss extends Character
{
    public function __construct()
    {
        parent::__construct(
            name: 'Tortipouss',
            attacktType: 'Magical',
            elementarytType: 'Plant',
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