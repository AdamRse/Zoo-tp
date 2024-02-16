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
    protected $_owner;

    public function AffichageContenueEnclos($enclos)
    {
        return $enclos->CaracteristqueEnclos();
    }
    public function AffichageAnimauxZoo($enclos)
    {
        return $enclos->CaracteristqueAnimaux();
    }
    public function main(Animal $animal, Enclos $enclos, Employe $employe)
    {
        while ($animal && $enclos && $employe ) {
  
        }

    }
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
    public function nbEmployes(){
        return sizeof($this->_employes);
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
    public function getOwner(){
        return $this->_owner;
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
    public function setOwner($o){
        $this->_owner = $o;
    }
}