<?php

namespace App\Weapons;

use App\Classes\PhysicalWeapon;


class Needle extends PhysicalWeapon
{
    public function __construct()
    {
        parent::__construct("une aiguille mortelle", "Un aiguille empoisonné privilégié par les attaquants rapides et malins.", 70);
    }
}
