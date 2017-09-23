<?php

/**
 * A classe est_class_interface_element_edit implementa os controles de um edit 
 * comum para entrada de dados em tela
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_edit extends est_class_interface_element_edit_base {
    
    function __construct() {
        parent::__construct('input');
        $this->addCssClass('edit');
    }
    
}
