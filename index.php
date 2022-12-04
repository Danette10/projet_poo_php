<?php
use App\Characters\Dracofeu;
use App\Characters\Tortank;
use App\Characters\Tortipouss;
use App\Spells\AttackSpell;
use App\Spells\DefenceSpell;
use App\Spells\HealingSpell;

require_once 'autoload.php';


// Création des personnages
$dracofeu = new Dracofeu();
$tortank = new Tortank();

$elementaryTypePlayer = $dracofeu->getElementaryType();
$elementaryTypeEnemy = $tortank->getElementaryType();


// Création des sorts
$fireball = new AttackSpell(
    attackEfficiency: 20,
    name: 'Fireball',
    description: 'Un sort de feu qui inflige des dégâts',
    manaCost: 10,
);

$hydrocanon = new AttackSpell(
    attackEfficiency: 20,
    name: 'Hydrocanon',
    description: 'Un sort d\'eau qui inflige des dégâts',
    manaCost: 10,
);

$heal = new HealingSpell(
    healingEfficiency: 20,
    name: 'Heal',
    description: 'Un sort de soin qui soigne des dégâts',
    manaCost: 10,
);

$shield = new DefenceSpell(
    defenceEfficiency: 20,
    name: 'Shield',
    description: 'Un sort de défense qui réduit les dégâts',
    manaCost: 10,
);

$dracofeu->setAttackSpells([
    $fireball
]);

$tortank->setAttackSpells([
    $hydrocanon
]);


$numberOfRound = 1;


//Boucle de jeu
while ($dracofeu->getHealth() > 0 && $tortank->getHealth() > 0) {

    echo PHP_EOL . 'Tour ' . $numberOfRound . PHP_EOL;


    //Affichage et Input action du joueur
    echo "Choisissez un sort parmi les suivants : " . PHP_EOL;
    echo "\t1. Fireball" . PHP_EOL;
    echo "\t2. Heal" . PHP_EOL;
    echo "\t3. Shield" . PHP_EOL;

    $sortChoisi = readline();


    //AI de l'ennemie
    $randomSpellTortank = $tortank->getAttackSpells()[array_rand($tortank->getAttackSpells())];

    $previousManaTortank = $tortank->getMana();
    $tortank->setMana($previousManaTortank - $randomSpellTortank->getManaCost());
    $tortank->attackEnemy($dracofeu, false);
    echo "Tortank a utilisé " . $randomSpellTortank->getName() . " et a infligé " . $randomSpellTortank->getAttackEfficiency() . " points de dégâts à Dracofeu" . PHP_EOL;
    echo "Dracofeu a perdu " . $randomSpellTortank->getAttackEfficiency() . " points de vie" . PHP_EOL;
    echo "Dracofeu a maintenant " . $dracofeu->getHealth() . " points de vie" . PHP_EOL;
    echo "Il reste " . $tortank->getMana() . " points de mana à Tortank" . PHP_EOL . PHP_EOL;


    //Logique des choix du personnages
    switch ($sortChoisi) {
        case 1:
            $dracofeu->setSpell($fireball);

            $previousMana = $dracofeu->getMana();
            $dracofeu->setMana($previousMana - $dracofeu->getSpell()->getManaCost());

            echo "Vous avez choisi le sort ";
            echo "\033[31m";
            echo $fireball->getName() . PHP_EOL;
            echo "\033[0m";
            echo "Il vous reste " . $dracofeu->getMana() . " points de mana" . PHP_EOL;

            $dracofeu->attackEnemy($tortank, true);

            break;

        case 2:
            echo "Vous avez choisi le sort Heal" . PHP_EOL;
            break;

        case 3:
            echo "Vous avez choisi le sort Shield" . PHP_EOL;
            break;

        default:
            echo 'Sort non reconnu';
            exit;
    }


    //Post round
    $numberOfRound++;
    $dracofeu->setMana($dracofeu->getMana() + $dracofeu->getManaRecoveryRate());
    $tortank->setMana($tortank->getMana() + $tortank->getManaRecoveryRate());
}


if ($dracofeu->getHealth() > 0) {
    echo PHP_EOL . "Dracofeu a gagné !" . PHP_EOL;
} else {
    echo PHP_EOL . "Tortank a gagné !" . PHP_EOL;
}
