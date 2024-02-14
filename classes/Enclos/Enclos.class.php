<?php
namespace Enclos;
class Enclos
{
    protected int $_id;
    protected bool $_proprete = true;
    protected int $_maxAnimaux = 6;
    protected array $_especeAnimal;

    public function CaracteristqueEnclos()
    {
        $retour = "$this->_maxAnimaux";
        $retour = "$this->_proprete";
        $retour = "$this->_especeAnimal";
        return $retour;
    }
    public function CaracteristqueAnimaux()
    {

    }
    public function AddAninal()
    {

    }
    public function DeleteAnimal()
    {

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
        return $this->_especeAnimal;
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
    public function setAnimal($_especeAnimal)
    {
        $this->_especeAnimal = $_especeAnimal;
    }
}