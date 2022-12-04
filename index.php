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
$tortipouss = new Tortipouss();

$enemyTeam = [$tortank, $tortipouss];

$enemy = $enemyTeam[array_rand($enemyTeam)];

$elementaryTypePlayer = $dracofeu->getElementaryType();
$elementaryTypeEnemy = $enemy->getElementaryType();


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

$tranchHerbe = new AttackSpell(
    attackEfficiency: 20,
    name: 'Tranch\'herbe',
    description: 'Un sort de plante qui inflige des dégâts',
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

$enemyTeam[0]->setAttackSpells([
    $hydrocanon
]);

$enemyTeam[1]->setAttackSpells([
    $tranchHerbe
]);


$numberOfRound = 1;


//Boucle de jeu
while ($dracofeu->getHealth() > 0 && !empty($enemyTeam)) {

    if($enemy->getHealth() <= 0) {
        unset($enemyTeam[array_search($enemy, $enemyTeam)]);
        $enemy = $enemyTeam[array_rand($enemyTeam)];
    }

    echo PHP_EOL . 'Tour ' . $numberOfRound . PHP_EOL;


    do {
        //Affichage et Input action du joueur
        echo "Choisissez un sort parmi les suivants : " . PHP_EOL;
        echo "\t1. Fireball" . PHP_EOL;
        echo "\t2. Heal" . PHP_EOL;
        echo "\t3. Shield" . PHP_EOL;

        $sortChoisi = readline();


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

                $dracofeu->attackEnemy($enemy, true);

                break;

            case 2:
                $dracofeu->setSpell($heal);

                $previousMana = $dracofeu->getMana();
                $dracofeu->setMana($previousMana - $dracofeu->getSpell()->getManaCost());

                echo "Vous avez choisi le sort ";
                echo "\033[32m";
                echo $heal->getName() . PHP_EOL;
                echo "\033[0m";
                echo "Il vous reste " . $dracofeu->getMana() . " points de mana" . PHP_EOL;

                $dracofeu->triggerHealingSpell();

                break;

            case 3:
                $dracofeu->setSpell($shield);

                $previousMana = $dracofeu->getMana();
                $dracofeu->setMana($previousMana - $dracofeu->getSpell()->getManaCost());

                echo "Vous avez choisi le sort ";
                echo "\033[34m";
                echo $shield->getName() . PHP_EOL;
                echo "\033[0m";
                echo "Il vous reste " . $dracofeu->getMana() . " points de mana" . PHP_EOL;

                $dracofeu->triggerDefenceSpell();

                break;

            default:
                echo 'Sort non reconnu';
                exit;
        }
    }while($sortChoisi != 1 && $sortChoisi != 2);


    //AI de l'ennemie
    $randomSpellEnemy = $enemy->getAttackSpells()[array_rand($enemy->getAttackSpells())];

    $previousManaEnemy = $enemy->getMana();
    $enemy->setMana($previousManaEnemy - $randomSpellEnemy->getManaCost());
    $enemy->attackEnemy($dracofeu, false);


    //Post round
    $numberOfRound++;
    $dracofeu->setMana($dracofeu->getMana() + $dracofeu->getManaRecoveryRate());
    $enemy->setMana($enemy->getMana() + $enemy->getManaRecoveryRate());
}


if ($dracofeu->getHealth() > 0) {
    echo PHP_EOL . "Dracofeu a gagné !" . PHP_EOL;
} else {
    echo PHP_EOL . $enemy->getName() . " a gagné !" . PHP_EOL;
}
