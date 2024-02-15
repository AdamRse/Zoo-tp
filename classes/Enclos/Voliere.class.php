<?php
namespace Enclos;
class Voliere extends Enclos 
{
    protected $hauteur;

    public function __construct($id, $proprete, $hauteur) {
        parent::__construct($id, $proprete);
        $this->hauteur = $hauteur;
    }
}

