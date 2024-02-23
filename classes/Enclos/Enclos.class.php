<?php
namespace Enclos;

use Animaux\Animal;

class Enclos
{
    protected int $_id;
    protected int $_proprete = 100;
    protected int $_maxAnimaux = 6;
    protected array $_animal = [];
    protected $_type = "Enclos";
    protected $_posX;
    protected $_posY;

    public function __construct(array $hydrate = [])
    {
        if(!empty($hydrate))
            $this->hydrate($hydrate);
    }
    public function hydrate($tab){
        foreach ($tab as $attribut => $value) {
            $method = 'set'.ucfirst($attribut);
            if(is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }
    public function exportAssoc(bool $afficherAnimaux = false){
        $rt = array(
            "id" => $this->_id
            , "type" => $this->_type
            , "proprete" => $this->_proprete
            , "maxAnimaux" => $this->_maxAnimaux
            , "posX" => $this->_posX
            , "posY" => $this->_posY
        );
        if($afficherAnimaux){
            foreach ($this->_animal as $animal1) {
                $rt["animaux"][]=$animal1->exportAssoc();
            }
        }
        return $rt;
    }
    public function isFree(){
        return sizeof($this->_animal) < $this->_maxAnimaux;
    }
    public function getAnimalId($id){
        $animal = false;
        foreach($this->_animal as $a){
            if($a->getId() == $id)
                $animal = $a;
        }
        return $animal;
    }
    public function CaracteristqueEnclos()
    {
        $retour = "Enclos n° $this->_id : ";
        $retour .= ($this->_proprete) ? "Propre" : "A nettoyer";
        $retour .= ". Polulation : ".sizeof($this->_animal)."/$this->_maxAnimaux";
        return $retour;
    }
    public function CaracteristqueAnimaux()
    {
        $retour = "Liste des annimaux dans l'enclos $this->_id : ";
        foreach ($this->_animal as $animal){
            $retour .= "<table>";
            $retour .= "<tr><td colspan='2'>".$animal->getName()."</td></tr>";
            $retour .= "<tr><td>Taille</td><td>".$animal->getTaille()."</td></tr>";
            $retour .= "<tr><td>Poids</td><td>".$animal->getPoids()."</td></tr>";
            $retour .= "<tr><td>Age</td><td>".$animal->getAge()."</td></tr>";
            $retour .= "<tr><td>Dort</td><td>".$animal->getDort()."</td></tr>";
            $retour .= "<tr><td>Faim</td><td>".$animal->getFaim()."</td></tr>";
            $retour .= "<tr><td>Malade</td><td>".$animal->getMalade()."</td></tr>";
            $retour .= "<tr><td>Crie</td><td>".$animal->getCrie()."</td></tr>";
            $retour .= "</table>";
        }
        return $retour;
    }
    public function AddAnimal(Animal $animaux)
    {
        if (sizeof($this->_animal) < $this->_maxAnimaux) 
        {
            $this->_animal[] = $animaux;          
        }
        
    }
    public function DeleteAnimal(Animal $animal)
    {
        //$animal->getId();
        foreach ($this->_animal as $offset => $animal1  ) {
           if ($animal->getId() == $animal1->getId()) 
           {
                array_splice($this->_animal, $offset, 1);
           } 
            
        }
        
    }
    public function ClearEnclos()
    {
        if ($this->_proprete) 
        {    
            $retour = "L'enclos est déja propre";
        }
        else
        {
            $retour = "L'enclos viens d'etre nettoyé";
            $this->_proprete = true;
        }
        return $retour;
    }
   
    
    
    
    // GETTER
    public function getId()
    {
        return $this->_id;
    }
    public function getPropete()
    {
        return $this->_proprete;
    }
    public function getMaxAnimaux()
    {
        return $this->_maxAnimaux;
    }
    public function getAnimal()
    {
        return $this->_animal;
    }
    public function getType(){
        return $this->_type;
    }
    public function getPosX(){
        return $this->_posX;
    }
    public function getPosY(){
        return $this->_posY;
    }

    // SETTER
    public function setId($_id)
    {
        $this->_id = $_id;
    }
    public function setPropete($_proprete)
    {
        if($_proprete<0) $_proprete = 0;
        elseif($_proprete>100) $_proprete = 100;
        $this->_proprete = $_proprete;
    }
    public function setMaxAnimaux($_maxAnimaux)
    {
        $this->_maxAnimaux = $_maxAnimaux;
    }
    public function setAnimal($_animal)
    {
        $this->_animal = $_animal;
    }
    public function setType($t){
        $this->_type = $t;
    }
    public function setPosX($p){
        $this->_posX = $p;
    }
    public function setPosY($p){
        $this->_posY = $p;
    }
}