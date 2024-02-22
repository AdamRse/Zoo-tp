<?php
namespace Animaux;
class Aigle extends Animal
{
    public function __construct($hydrate = [])
    {
        $this->setName("Aigle");
        $this->setCrie("Glatissement");
        $this->_poids = 0.015;
        $this->_taille = 0.1;
        $this->_icon = "aigle.png";
        parent::__construct($hydrate);
    }

}