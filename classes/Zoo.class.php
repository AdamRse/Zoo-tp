<?php
use Animaux\Animal;
use Enclos\Enclos;

class Zoo {

    private const enclosMax = 10;
    protected $_id;
    protected $_money;
    protected $_entry_price;
    protected array $_employes = [];
    protected array $_enclos = [];
    protected $_owner;

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
    public function pay($cost){
        $this->_money -= $cost;
    }
    public function addEmployee(Employe $employe){
        $this->_employes[] = $employe;
    }
    public function addEnclos(Enclos $enclos){
        $this->_enclos[] = $enclos;
    }
    public function exportAssoc(){
        return array(
            "id" => $this->_id
            , "money" => $this->_money
            , "entry_price" => $this->_entry_price
        );
    }
    public function getEnclosId($id){
        $enclos = false;
        foreach($this->_enclos as $e){
            if($e->getId() == $id)
                $enclos = $e;
        }
        return $enclos;
    }
    public function AffichageContenueEnclos($enclos)
    {
        return $enclos->CaracteristqueEnclos(); 
    }
    public function AffichageAnimauxZoo($enclos)
    {
        return $enclos->CaracteristqueAnimaux();
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