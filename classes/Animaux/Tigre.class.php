<?php
namespace Animaux;
class Tigre extends Animal 
{
    public function __construct($id, $poids = 1, $taille = 0.45)
    {
        parent::__construct($id, $poids, $taille);
        $this->setName("Tigre");
        $this->setCrie("rugis");
    }

}