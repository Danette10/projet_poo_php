<?php

namespace App\Weapons;

use App\Classes\MagicalWeapon;

class Spoon extends MagicalWeapon
{
    public function __construct()
    {
        parent::__construct("La cuillère en argent", "Utilise ses pouvoirs psychiques en tordant les cuillères qu'il tient.",15 );
    }
    
    //Alakazam
}
