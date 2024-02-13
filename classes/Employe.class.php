<?php
class Employe
{
    protected int $_id;
    protected string $_name;
    protected int $_age;
    protected string $_sexe;
    public function __construct($i, $n, $s)
    {
        $this->_id = $i;
        $this->_name = $n ;
        $this->_sexe = $s;
    }
    public function Nettoyer ($enclos)
    {
        $enclos->clear();
    }
    public function Nourrir($animal)
    {
        $animal->manger();
    }
    public function Ajouter ($enclos)
    {
        $enclos->add();
    }
    public function Supprimer ($enclos)
    {
        $enclos->delete();
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