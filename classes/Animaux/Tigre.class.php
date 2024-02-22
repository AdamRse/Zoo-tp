<?php
namespace Animaux;
class Tigre extends Animal 
{
    public function __construct($hydrate = [])
    {
        $this->setName("Tigre");
        $this->setCrie("rugis");
        $this->_poids = 1;
        $this->_taille = 0.45;
        parent::__construct($hydrate);
    }
    public function Vagabonder()
    {
        $retour = "$this->_name est entain de vagabonder";
        return $retour;
    }
}