<?php

/**
 * Implementa a classe base para exce��es na aplica��o.
 *
 * @author Cleber Nardelli
 */
class_alias('est_class_exception_base', 'EstException');
class est_class_exception_base extends Exception 
{
    
    const EXC_ALERTA = 1;
    const EXC_GRAVE = 2;
    const EXC_AVISO = 3; 

    /* @var int $type*/
    private $type;
    /* @var string $description*/
    private $description;
    
    function __construct($msg, $description = null, $type = EstException::EXC_GRAVE) {
        parent::__construct($msg);
        $this->message = $msg;
        $this->description = $description;
        $this->type = $type;
        
        generic_application_message($this->getMessage(), E_USER_ERROR);
    }
    
    function getType() {
        return $this->type;
    }

    function getDescription() {
        return $this->description;
    }

}
