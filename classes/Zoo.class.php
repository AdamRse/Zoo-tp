<?php
use Animaux\Animal;
use Enclos\Enclos;
use Employe\Employe;
class Zoo {

    private const enclosMax = 10;
    protected $_id;
    protected $_money;
    protected $_entry_price;
    protected array $_employes = [];
    protected array $_enclos = [];

    public function AffichageContenueEnclos($enclos)
    {
        $enclos->CaracteristqueEnclos();
    }
    public function AffichageAnimauxZoo($enclos)
    {
        $enclos->CaracteristqueAnimaux();
    }
    public function main(Animal $animal, Enclos $enclos, Employe $employe)
    {
        while ($this->$animal) {
            
        }

    }

    protected $_enclosPosition = array(
        [5, 35]
        ,[10, 31]
        ,[8, 23]
        ,[26, 21]
        ,[28, 37]
        ,[42, 47]
        ,[17, 43]
        ,[52, 84]
        ,[51, 20]
        ,[42, 14]
        ,[64, 35]
        ,[84, 32]
        ,[92, 44]
        ,[27, 67]
    );
    protected $_volierePosition = array(
        [51.5, 9]
        ,[59, 9]
        ,[41, 37]
        ,[49, 43]
        ,[53, 55]
        ,[57.5, 29]
        ,[75, 38]
        ,[83, 48]
        ,[71, 64]
        ,[53, 71]
        ,[7, 52]
        ,[32, 59]
        ,[17, 10]
    );
    protected $_aquaPosition = array(
        [28, 49]
        ,[19, 56]
        ,[20, 36]
        ,[37, 24]
        ,[68, 25]
        ,[57, 42]
        ,[62, 53]
        ,[46, 61]
        ,[44, 76]
    );

    public function __construct($hydrate = false){
        if(!empty($hydrate) && is_array($hydrate)){
            $this->hydrate($hydrate);
        }
    }
    public function hydrate($tab){
        foreach ($tab as $attribut => $value) {
            $method = 'set'.ucfirst($attribut);
            if(is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }
    public function afficherMap(){
        ?>
        <div class="relative inline-block w-full overflow-hidden select-none">
            <div class="absolute pt-5 pl-7">
                <i id="btMenu" class="p-2 cursor-pointer shadow-<?= COLOR_THEME_TW ?>-700 fa-solid fa-bars text-<?= COLOR_THEME_TW ?>-700 fa-2x"></i>
                <i id="btStats" class="p-2 cursor-pointer fa-regular fa-compass text-<?= COLOR_THEME_TW ?>-700 fa-2x"></i>
            </div>
            <div class="absolute mt-20 flex justify-center">
                <div id="divMenuMap" class="hidden ml-5 p-5 text-<?= COLOR_THEME_TW ?>-700 border-2 border-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 rounded-lg">
                    Menu
                </div>
                <div id="divStatMap" class="hidden ml-5 p-5 text-<?= COLOR_THEME_TW ?>-700 border-2 border-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 rounded-lg">
                    Status
                </div>
            </div>
            <img src="/images/map.png" class="w-full top-0 left-0"/>
            <?php
            foreach($this->_enclosPosition as $xy){
                ?>
                <div class="enclos inline-block absolute rounded-full shadow-2xl border cursor-pointer" style="left: <?= $xy[0] ?>%; top: <?= $xy[1] ?>%; background: center/150% url('./images/enclos.png')">
                <div class="px-2 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14">Enclos</div>
                </div>
                <?php
            }
            foreach($this->_volierePosition as $xy){
                ?>
                <div class="enclos inline-block absolute rounded-full shadow-2xl border cursor-pointer" style="left: <?= $xy[0] ?>%; top: <?= $xy[1] ?>%; background: center/150% url('./images/voliere.png')">
                <div class="px-2 min-w-16 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14">Volière</div>
                </div>
                <?php
            }
            foreach($this->_aquaPosition as $xy){
                ?>
                <div class="text-center enclos inline-block absolute rounded-full shadow-2xl border cursor-pointer" style="left: <?= $xy[0] ?>%; top: <?= $xy[1] ?>%; background: center/150% url('./images/aquarium.png')">
                    <div class="px-2 min-w-24 rounded-md text-center text-<?= COLOR_THEME_TW ?>-700 bg-<?= COLOR_THEME_TW ?>-200 mt-14">Aquarium</div>
                </div>
                <?php
            }

            ?>
        </div>
        <?php
    }

    ////////GETTERS
    public function getId(){
        return $this->_id;
    }
    public function getMoney(){
        return $this->_money;
    }
    public function getEntry_price(){
        return $this->_entry_price;
    }
    public function getEmployes(){
        return $this->_employes;
    }
    public function getEnclos(){
        return $this->_enclos;
    }

    ////////SETTERS
    public function setId($i){
       $this->_id = $i;
    }
    public function setMoney($m){
        $this->_money = $m;
    }
    public function setEntry_price($e){
        $this->_entry_price = $e;
    }
    public function setEmployes($e){
        $this->_employes = $e;
    }
    public function setEnclos($e){
        $this->_enclos = $e;
    }
}