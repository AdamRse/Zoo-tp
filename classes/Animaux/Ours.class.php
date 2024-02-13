<?php
namespace Animaux;
class Ours extends Animal
{
public function __construct($id,$poids , $taille )
{
    parent::__construct($id, $poids, $taille)
    $this->setName("Ours");
    $this->setCrie("grogne");
}

}