<?php
$zooManager = new Managers\ZooManager($connexion);
$animalManager = new Managers\AnimalManager($connexion);
$employeManager = new \Managers\EmployesManager($connexion);

$listeAnimal = $animalManager->getAnimalAvailableArray();
$zoo = $zooManager->getZooId(ZOO, false);
?>

<div id="hiddenElem" class="hidden" data-id="<?= $zoo->getId() ?>" data-p_i_animals="<?= P_ICON_ANIMAUX ?>" data-color_theme="<?= COLOR_THEME_TW ?>">
    <!-- Employee -->
    <div class="elem-menuEmploye py-1 px-5 flex justify-between border-b border-<?= COLOR_THEME_TW ?>-700">
        <div class="flex items-center">
            <img data-p_icon="<?= P_ICON ?>"  src="" class="w-10 mr-2" />
        </div>
        <div>
            <div class="name text-xl font-bold"></div>
            <div class="role"></div>
            <div class="experience"></div>
        </div>
    </div>

    <!-- Enclosures -->
    <div class="elem-enclosure enclosure inline-block absolute rounded-full shadow-2xl border cursor-pointer">
        <div class="animals px-2 rounded-full"></div>
        <div class="tag-enclos px-2 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14"></div>
    </div>

    <!-- Animals -->
    <div class="elem-animal">
        <img src="" class="elem-icon max-h-8 max-w-8"/>
    </div>
</div>

<!-- 
//////////////////////// MAP //////////////////////// 
-->
<div id="divMap" class="relative inline-block w-full overflow-hidden select-none">
    <div class="absolute pt-5 pl-7">

        <i id="btMenu" class="p-2 cursor-pointer rounded-full  ring-offset-4 shadow-<?= COLOR_THEME_TW ?>-700 fa-solid fa-bars text-<?= COLOR_THEME_TW ?>-700 fa-2x"></i>
        <i id="btStats" class="p-2 cursor-pointer rounded-full  ring-offset-4  fa-regular fa-compass text-<?= COLOR_THEME_TW ?>-700 fa-2x"></i>

    </div>
    <div class="absolute mt-20 flex justify-center">

        <!-- Menu -->
        <div id="divMenuMap" class="hidden z-40 ml-5 py-5  text-<?= COLOR_THEME_TW ?>-700 border-2 border-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 rounded-lg">
            <div class="px-5 py-2 text-3xl text-center">
                Zoo d<?= (in_array(substr(strtolower($zoo->getOwner()), 0, 1), array("a", "e", "i", "o", "u", "y")) ? "'" : "e")." <b>".$zoo->getOwner()."</b>" ?>
            </div>
            <div class="px-5 py-2 mb-2 text-xl text-center border-b-4 border-<?= COLOR_THEME_TW ?>-700">
                Stats
            </div>
            <div>
                <table class="w-full">
                    <tr>
                        <td class="py-1 px-3">Money</td>
                        <td class="py-1 px-3 text-right font-bold">
                            <span id="statMoney"><?= number_format($zoo->getMoney(), 0, '.', ' ') ?></span>€
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-3">Entrance</td>
                        <td class="py-1 px-3 text-right font-bold">
                            <span id="statEntry"><?= $zoo->getEntry_price() ?></span>€
                        </td>
                    </tr>
                    <tr>
                        <td class="py-1 px-3">Employees</td>
                        <td class="py-1 px-3 text-right font-bold">
                            <span id="statNbEmployes"><?= $zoo->nbEmployes() ?></span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="px-5 py-2 mb-2 text-xl text-center border-b-4 border-<?= COLOR_THEME_TW ?>-700">
                Invests
            </div>
            <div>
                <table class="m-5">
                    <tr>
                        <td>Zookeeper</td>
                        <td class="pl-3 text-right font-bold">
                            <button id="btBuyZk" class="m-2 p-2 <?= COLOR_THEME_BT ?>">Hire one (<?= number_format($zooManager->getPrices("ZooKeeper"), 0, '.', ' ') ?>€)</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Enclosure</td>
                        <td class="pl-3 text-right font-bold">
                            <div id="divSelectBuyEnc">
                                <select id="selectBuyEnc" class="m-2 p-2 <?= COLOR_THEME_BT ?>">
                                    <option value="Enclos">Enclosure (<?= number_format($zooManager->getPrices("Enclos"), 0, '.', ' ') ?>€)</option>
                                    <option value="Voliere">Aviary (<?= number_format($zooManager->getPrices("Voliere"), 0, '.', ' ') ?>€)</option>
                                    <option value="Aquarium">Aquarium (<?= number_format($zooManager->getPrices("Aquarium"), 0, '.', ' ') ?>€)</option>
                                </select>
                                <button id="btBuyEnclosure" class="m-2 p-2 <?= COLOR_THEME_BT ?>">Buy</button>
                            </div>
                            <div id="divPendingBuyEnclos" class="hidden">
                                Select your new enclosure location on the map
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Animal</td>
                        <td class="pl-3 text-right font-bold">
                            <div id="divSelectBuyAnimal">
                                <select id="selectBuyAnimal" class="m-2 p-2 <?= COLOR_THEME_BT ?>">
                                    <?php
                                    foreach($listeAnimal as $animal){
                                        ?>
                                        <option value="<?= $animal['name'] ?>"><?= $animal['name']." (".number_format($animal['cost'], 0, '.', ' ')."€)" ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button id="btBuyAnimal" class="m-2 p-2 <?= COLOR_THEME_BT ?>">Buy</button>
                            </div>
                            <div id="divPendingBuyAnimal" class="hidden">
                                Select an enclosure on the map for this newcomer
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Employee -->
        <div id="divStatMap" class="hidden z-40 ml-5 py-5 text-<?= COLOR_THEME_TW ?>-700 border-2 border-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 rounded-lg">
            <div id="divTitleEmployees" class="px-5 py-2 text-xl text-center border-b-4 border-<?= COLOR_THEME_TW ?>-700">
                Employee<?= $zoo->nbEmployes() > 1 ? "s" : "" ?> (<?= $zoo->nbEmployes() ?>)
            </div>
            <div id="appendEmployees">
            </div>
        </div>
    </div>
    <img src="/images/map.png" class="w-full top-0 left-0"/>
    <div id="tmpEnclosSelect" class="Enclos enclosure text-center hidden bg-slate-400 hover:bg-white absolute rounded-full shadow-2xl border cursor-pointer">
        Select
    </div>
    <div id="tmpEnclos" class="enclosure hidden absolute rounded-full shadow-2xl border cursor-pointer">
        <div class="px-2 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14"></div>
    </div><!--
    <?php
    foreach($zoo->getEnclos() as $enclos){
        if($enclos->getType() == "Enclos"){
            ?>
            <div class="enclosure inline-block absolute rounded-full shadow-2xl border cursor-pointer" style="left: <?= $enclos->getPosX() ?>%; top: <?= $enclos->getPosY() ?>%; background: center/150% url('./images/Enclos.png')">
                <div class="px-2 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14">Enclos</div>
            </div>
            <?php
        }
        elseif($enclos->getType() == "Voliere"){
            ?>
            <div class="enclosure inline-block absolute rounded-full shadow-2xl border cursor-pointer" style="left: <?= $enclos->getPosX() ?>%; top: <?= $enclos->getPosY() ?>%; background: center/150% url('./images/Voliere.png')">
                <div class="px-2 min-w-16 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14">Volière</div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="enclosure text-center enclos inline-block absolute rounded-full shadow-2xl border cursor-pointer" style="left: <?= $enclos->getPosX() ?>%; top: <?= $enclos->getPosY() ?>%; background: center/150% url('./images/Aquarium.png')">
                <div class="px-2 min-w-24 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14">Aquarium</div>
            </div>
        <?php
        }
    }
    ?>-->
</div>