<?php
use Managers\AnimalManager;
use Managers\ZooManager;

$zooManager = new ZooManager($connexion);
$zoo = $zooManager->getZooId(ZOO);

$enclos = $zoo->getEnclosId($_GET['enclos']);

if(!empty($_GET['a']) && $_GET['a'] == "feed" && !empty($_GET['id'])){
    $animal = $enclos->getAnimalId($_GET['id']);
    if($animal){
        $animalManager = new AnimalManager($connexion);
        $animal->setFaim(100);
        $animalManager->save($animal);
    }
}
?>
<h1 class="text-4xl font-bold text-center my-8">Enclos </h1>
<div class="flex justify-normal">
    <?php
    foreach($enclos->getAnimal() as $animal){
        ?>
        <div class="m-3">
            <div class="p-3 text-center text-2xl font-bold text-<?= COLOR_THEME_TW ?>-700 bg-white flex justify-start items-center">
                <img src="<?= P_ICON_ANIMAUX.$animal->getIcon() ?>" class="max-h-10 max-w-10"/>
                <span class="ml-5"><?= $animal->getName() ?></span>
            </div>
            <div>
                <a href="?s=enclos&enclos=<?= $enclos->getId() ?>&a=feed&id=<?= $animal->getId() ?>" class="text-center <?= COLOR_THEME_BT ?>">Nourrir</a>
            </div>
            <div class="p-2 flex justify-between">
                <div>Age</div>
                <div class="font-bold"><?= $animal->getAge() ?></div>
            </div>
            <div class="p-2 flex justify-between">
                <div>Taille</div>
                <div class="font-bold"><?= $animal->getTaille() ?></div>
            </div>
            <div class="p-2 flex justify-between">
                <div>Poids</div>
                <div class="font-bold"><?= $animal->getPoids() ?></div>
            </div>
            <div class="p-2 flex justify-between">
                <div>Faim</div>
                <div class="font-bold"><?= $animal->getFaim() ?></div>
            </div>
            <div class="p-2 flex justify-between">
                <div>Fatigue</div>
                <div class="font-bold"><?= $animal->getDort() ?></div>
            </div>
        </div>
        <?php
    }
    ?>
</div>