<?php
namespace Animaux;
class Poisson extends Animal
{
    public function __construct($id, $poids = 0.0002, $taille = 0.01)
    {
        parent::__construct($id, $poids, $taille);
        $this->setName("Poisson");
        $this->setCrie("rote");
    }

}

