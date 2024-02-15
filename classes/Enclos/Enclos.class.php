<?php
namespace Enclos;

use Animaux\Animal;

class Enclos
{
    protected int $_id;
    protected bool $_proprete = true;
    protected int $_maxAnimaux = 6;
    protected array $_animal = [];

    public function __construct($_id, $_proprete) {
        $this->_id = $_id;
        $this->_proprete = $_proprete;
        $this->_animal = 0;
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

    // SETTER
    public function setId($_id)
    {
        $this->_id = $_id;
    }
    public function setPropete($_proprete)
    {
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
}