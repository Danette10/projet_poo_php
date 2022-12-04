<?php
use App\Characters\Dracofeu;
use App\Characters\Tortank;
use App\Characters\Tortipouss;
use App\Spells\AttackSpell;
use App\Spells\DefenceSpell;
use App\Spells\HealingSpell;

require_once 'autoload.php';


// Création des personnages
$player = new Dracofeu();
$tortank = new Tortank();
$tortipouss = new Tortipouss();

// Création du tableau des joueurs
$allPlayers = [$player, $tortank, $tortipouss];

echo "Choisissez votre personnage : " . PHP_EOL;

foreach ($allPlayers as $key => $player) {

    echo "\t" . $key . " : " . $player->getName() . PHP_EOL;

}

$playerChoice = readline();
$player = $allPlayers[$playerChoice];

echo "Vous avez choisi " . $player->getName() . " !" . PHP_EOL;

// Création du tableau des ennemis
$enemyTeam = $allPlayers;
unset($enemyTeam[$playerChoice]);


$enemy = $enemyTeam[array_rand($enemyTeam)];

$elementaryTypePlayer = $player->getElementaryType();
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

$player->setAttackSpells([
    $fireball
]);

$tortank->setAttackSpells([
    $hydrocanon
]);

$tortipouss->setAttackSpells([
    $tranchHerbe
]);


$numberOfRound = 1;


//Boucle de jeu
do {
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
                $player->setSpell($fireball);

                $previousMana = $player->getMana();
                $player->setMana($previousMana - $player->getSpell()->getManaCost());

                echo "Vous avez choisi le sort ";
                echo "\033[31m";
                echo $fireball->getName() . PHP_EOL;
                echo "\033[0m";
                echo "Il vous reste " . $player->getMana() . " points de mana" . PHP_EOL. PHP_EOL;

                $player->attackEnemy($enemy, true);

                break;

            case 2:
                $player->setSpell($heal);

                $previousMana = $player->getMana();
                $player->setMana($previousMana - $player->getSpell()->getManaCost());

                echo "Vous avez choisi le sort ";
                echo "\033[32m";
                echo $heal->getName() . PHP_EOL;
                echo "\033[0m";
                echo "Il vous reste " . $player->getMana() . " points de mana" . PHP_EOL. PHP_EOL;

                $player->triggerHealingSpell();

                break;

            case 3:
                $player->setSpell($shield);

                $previousMana = $player->getMana();
                $player->setMana($previousMana - $player->getSpell()->getManaCost());

                echo "Vous avez choisi le sort ";
                echo "\033[34m";
                echo $shield->getName() . PHP_EOL;
                echo "\033[0m";
                echo "Il vous reste " . $player->getMana() . " points de mana" . PHP_EOL. PHP_EOL;

                $player->triggerDefenceSpell();

                break;

            default:
                echo 'Sort non reconnu'. PHP_EOL;
        }
    }while($sortChoisi != 1 && $sortChoisi != 2);


    //Etat logique de l'AI
    if($enemy->getHealth() <= 0) {
        unset($enemyTeam[array_search($enemy, $enemyTeam)]);
        if(!empty($enemyTeam)){
            $enemy = $enemyTeam[array_rand($enemyTeam)];
        }
    }
    else{
        //AI de l'ennemie
        $randomSpellEnemy = $enemy->getAttackSpells()[array_rand($enemy->getAttackSpells())];

        $previousManaEnemy = $enemy->getMana();
        $enemy->setMana($previousManaEnemy - $randomSpellEnemy->getManaCost());
        $enemy->attackEnemy($player, false);


        //Post round
        $numberOfRound++;
        $player->setMana($player->getMana() + $player->getManaRecoveryRate());
        $enemy->setMana($enemy->getMana() + $enemy->getManaRecoveryRate());
    }
} while($player->getHealth() > 0 && !empty($enemyTeam));


if ($player->getHealth() > 0) {
    echo PHP_EOL . $player->getName() . " a gagné !" . PHP_EOL;
} else {
    echo PHP_EOL . $enemy->getName() . " a gagné !" . PHP_EOL;
}
