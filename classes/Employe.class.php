<?php
class Employe
{
    protected int $_id;
    protected string $_name;
    protected int $_age;
    protected string $_sexe;
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
    public function Nettoyer ($enclos)
    {
        $enclos->ClearEnclos();
    }
    public function Nourrir($animal)
    {
        $animal->manger();
    }
    public function Ajouter ($enclos)
    {
        $enclos->AddAnimal();
    }
    public function Supprimer ($enclos)
    {
        $enclos->DeleteAnimal();
    }
    public function Transfert ($enclos)
    {
        $enclos->move();
    }

    // GETTER
    public function getId()
    {
        return $this->_id;
    }
    public function getName()
    {
        return $this->_name;
    }
    public function getAge()
    {
        return $this->_age;
    }
    
    
    // SETTER
    public function setId($_id)
    {
        $this->_id = $_id;
    }

    public function setName($_name)
    {
        $this->_name = $_name;
    }
    public function setAge($_age)
    {
        $this->_age = $_age;
    }
}