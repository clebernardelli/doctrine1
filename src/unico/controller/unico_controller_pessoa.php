<?php
/**
 * Implementa a classe unico_controller_pessoa
 *
 * @author Cleber Nardelli
 */
class unico_controller_pessoa extends est_class_controller_base 
{

    function __construct() {
        parent::__construct();
    }

    public function execute() 
    {
       $this->getAcao();
    }

}
