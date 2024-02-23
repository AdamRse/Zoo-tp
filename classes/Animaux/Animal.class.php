<?php

namespace Animaux;

abstract class Animal
{
    protected int $_id;
    protected int $_age = 0;
    protected float $_poids;
    protected float $_taille;
    protected string $_name;
    protected int $_faim = 100;
    protected int $_dort = 100;
    protected int $_malade = 0;
    protected string $_crie;
    protected $_icon;
    
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
    public function exportAssoc(){
        return array(
            "id" => $this->_id
            , "age" => $this->_age
            , "poids" => $this->_poids
            , "taille" => $this->_taille
            , "name" => $this->_name
            , "faim" => $this->_faim
            , "dort" => $this->_dort
            , "malade" => $this->_malade
            , "crie" => $this->_crie
            , "icon" => $this->_icon
        );
    }
    public function manger()
    {
        $retour = "";
        if ($this->_faim)
        {
            $this->_faim = false;
            $retour = "$this->_name a mangé";
        }
        else
        {
            $priseDePoids = $this->_poids / 200;
            $this->_poids += $priseDePoids;
            $this->_malade = true;
            $retour = "$this->_name a trop mangé, $this->_name est tombé malade et $this->_name a pris $priseDePoids";
        }
        return $retour;
    }

    public function Crie()
    {
        if ($this->_dort)
        {
            $retour = "$this->_name dort ...";
        }
        elseif($this->_malade)
        {
            $retour = "$this->_name $this->_crie faiblement";
        }
        else
        {
            $retour = "$this->_name $this->_crie ";
        }
        return $retour;
    }
    public function Heal()
    {
        if ($this->_malade)
        { 
            if (rand(0, 1000) == 0)
            {
                $retour = "$this->_name a succombé a la suite de ça maladie";
            } 
            else {
                $this->_malade = false;
                $this->_dort = true;
                $retour = "$this->_name est soignée et se repose";
            }
        } 
        else
        {
            $retour = "$this->_name n'est pas malade ";
        }
        return $retour;
    }
    public function Dormir()
    {  
        if($this->_dort)
        {
            $retour = "$this->_name est déja entain de dormir";
        }
        else
        {
            $this->_dort = true;
            $retour = "$this->_name s'endort";
        }
        return $retour;
    }
    public function Réveiller()
    {  
        if($this->_dort)
        {
            $this->_dort = false;
            $retour = "$this->_name se réveille";
        }
        else
        {
            $retour = "$this->_name est déja réveiller";
        }
        return $retour;
    }
    public function starve($starve = 1){
        $this->setFaim($this->_faim-$starve);
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
    public function getCrie()
    {
        return $this->_crie;
    }
    public function getIcon()
    {
        return $this->_icon;
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
    public function setPoids($_poids)
    {
        $this->_poids = $_poids;
    }
    public function setFaim($_faim)
    {
        if($_faim < 0) $_faim = 0;
        if($_faim > 100) $_faim = 100;
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
    public function setCrie($_crie)
    {
        $this->_crie = $_crie;
    }
    public function setIcon($i)
    {
        $this->_icon = $i;
    }
}
