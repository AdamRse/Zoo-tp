<?php
namespace Enclos;
class Voliere extends Enclos 
{

    public function __construct($hydrate = []) {
        if(!empty($hydrate))
            parent::__construct($hydrate);
        $this->_type = "Voliere";
    }
}

