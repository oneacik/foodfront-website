<?php

abstract class Module {

    var $main;

    public function __construct($main) {
        $this->main = $main;
        if(!$this->validate()){
            throw new Exception("Module used in incorrect context");
            
        }
    }

    abstract function process();

    abstract function display();

    abstract function validate();
}
