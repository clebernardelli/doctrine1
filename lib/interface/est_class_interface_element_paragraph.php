<?php

/**
 * Descri��o da classe est_class_interface_paragraph
 * Para utilizar chamar o m�todo setConteudo
 *
 * @author Cleber Nardelli
 */

class est_class_interface_element_paragraph extends est_class_interface_element {
    
    /*
     * M�todo construtor j� seta o texto a ser exibido no paragrafo.
     */
    function __construct() {
        parent::__construct('p');
    }
    
    /*
     * O m�todo setAlign() define o alinhamento do texto a ser aplicado ao paragraph
     * @param $align = Alinhamento do texto.
     */
    public function setAlign($align) {
        $this->addProperty('align', $align);
    }
    
}
