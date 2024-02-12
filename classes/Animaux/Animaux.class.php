<?php
namespace Animaux;

class Animaux
{
    protected int $_id;
    protected int $_age;
    protected int $_poids;
    protected int $_taille;
    protected string $_name;
    protected bool $_faim;
    protected bool $_dort;
    protected bool $_malade;

    public function manger()
    {
        $retour = "";
        if ($this->_faim) {
            $this->_faim = false;
            $retour = "$this->_name a mangé";
        }
        else
        {
            $priseDePoids = $this->_poids/200;
            $this->_poids += $priseDePoids;
            $this->_malade = true;
            $retour = "$this->_name a trop mangé, $this->_name est tombé malade et $this->_name a pris $priseDePoids";   
        }
        return $retour;
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
    public function getPoids()
    {
        return $this->_poids;
    }
    public function getAge()
    {
        return $this->_age;
    }
    public function getTaille()
    {
        return $this->_taille;
    }
    public function getFaim()
    {
        return $this->_faim;
    }
    public function getDort()
    {
        return $this->_dort;
    }
    public function getMalade()
    {
        return $this->_malade;
    }

    // SETTER

    public function setId($_id)
    {
        $this->_id = $_id;
    }
    public function setAge($_age)
    {
        $this->_age = $_age;
    }
    public function setPoids($_poids)
    {
        $this->_poids = $_poids;
    }
    public function setFaim($_faim)
    {
        $this->_faim = $_faim;
    }
    public function setTaille($taille)
    {
        $this->_taille = $taille;
    }
    public function setDort($_dort)
    {
        $this->_dort = $_dort;
    }
    public function setMalade($_malade)
    {
        $this->_malade = $_malade;
    }
}

