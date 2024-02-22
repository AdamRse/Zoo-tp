<?php
namespace Animaux;
class Poisson extends Animal
{
    public function __construct($hydrate = [])
    {
        $this->setName("Poisson");
        $this->setCrie("rote");
        $this->_poids = 0.0002;
        $this->_taille = 0.01;
        $this->_icon = "requin.png";
        parent::__construct($hydrate);
    }
    public function Nager()
    {
        $retour = "$this->_name est entain de nager";
        return $retour;
    } 
}