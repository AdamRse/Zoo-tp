<?php
namespace Animaux;
class Aigle extends Animal
{
    public function __construct($id, $poids = 0.0150, $taille = 0.10)
    {
        parent::__construct($id, $poids, $taille);
        $this->setName("Aigle");
        $this->setCrie("Glatissement");
    }

}