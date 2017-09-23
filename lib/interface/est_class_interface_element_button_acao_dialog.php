<?php

/**
 * Descrição da classe est_class_interface_element_button_acao_janela
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_button_acao_dialog extends est_class_interface_element_button {
    
    function __construct() {
        parent::__construct();
        $this->addCssClass('botao_acao_base botao_acao_dialog');        
    }
    
}
