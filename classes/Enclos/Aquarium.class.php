<?php
namespace Enclos;
class Aquarium extends Enclos 
{
    public function __construct($hydrate = []) {
        if(!empty($hydrate))
            parent::__construct($hydrate);
        $this->_type = "Aquarium";
    }
}