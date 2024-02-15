<?php
namespace Enclos;
class Aquarium extends Enclos 
{
    protected $salinité;

    public function __construct($id, $proprete, $salinité) {
        parent::__construct($id, $proprete);
        $this->salinité = $salinité;
    }
}