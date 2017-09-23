<?php

/**
 * Descrição da classe est_class_interface_paragraph
 * Para utilizar chamar o método setConteudo
 *
 * @author Cleber Nardelli
 */

class est_class_interface_element_paragraph extends est_class_interface_element {
    
    /*
     * Método construtor já seta o texto a ser exibido no paragrafo.
     */
    function __construct() {
        parent::__construct('p');
    }
    
    /*
     * O método setAlign() define o alinhamento do texto a ser aplicado ao paragraph
     * @param $align = Alinhamento do texto.
     */
    public function setAlign($align) {
        $this->addProperty('align', $align);
    }
    
}
