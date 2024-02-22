<?php
namespace Animaux;
class Ours extends Animal
{

    public function __construct($hydrate = [])
    {
        $this->setName("Ours");
        $this->setCrie("grogne");
        $this->_poids = 0.225;
        $this->_taille = 17.5;
        $this->_icon = "ours.png";
        parent::__construct($hydrate);
    }

}