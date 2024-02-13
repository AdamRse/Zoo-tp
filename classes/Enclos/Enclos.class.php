<?php
namespace Enclos;
class Enclos
{
    protected int $_id;
    protected int $proprete;
    protected int $_number;
    protected array $_animal;

    public function CaracteristqueEnclos()
    {

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

    }
    
    
    // GETTER
    public function getId()
    {
        return $this->_id;
    }
    public function getPropreter()
    {
        return $this->proprete;
    }
    public function getNumber()
    {
        return $this->_number;
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
    public function setPropreter($proprete)
    {
        $this->proprete = $proprete;
    }
    public function setNumber($_number)
    {
        $this->_number = $_number;
    }
    public function setAnimal($_animal)
    {
        $this->_animal = $_animal;
    }
}