<?php
namespace Animaux;
class Ours extends Animal
{

    public function __construct($id, $poids = 0.225, $taille = 17.5)
    {
        parent::__construct($id, $poids, $taille);
        $this->setName("Ours");
        $this->setCrie("grogne");
    }

}