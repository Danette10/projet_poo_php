<?php

namespace App\Weapons;

use App\Classes\PhysicalWeapon;
//require_once('PhysicalWeapon.php');

class Cannon extends PhysicalWeapon
{
    public function __construct()
    {
        parent::__construct("Le canon à eau", "Le canon peut etre orienté dans diverses directions par les attaquants lents et massifs.", 10);
    }
}
