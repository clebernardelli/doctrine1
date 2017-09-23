<?php

/**
 * Descrição da classe est_class_interface_element_label
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_label extends est_class_interface_element {
    
    function __construct() {
        parent::__construct('label');
        $this->addCssClass('label_base');
    }
    
}
