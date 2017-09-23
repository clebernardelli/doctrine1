<?php

/**
 * A classe est_class_interface_tablerow é uma linha de uma tabela
 * Trata-se de uma composição, portanto não faz sentido sua existência sem uma tabela para adicioná-la.
 * 
 * @author Cleber Nardelli
 */
class est_class_interface_element_tablerow extends est_class_interface_element_wincontrol {
    
    function __construct() {
        parent::__construct('tr');
    }

    /*
     * O método addCell é responsável por adicionar novas células na linha da tabela.
     * @param $value string = Valor a ser exibido na célula
     * @return est_class_interface_tablecell 
     */
    public function addCell($value) {
        /* @var $cell est_class_interface_tablecell */
        $cell = Factory::interfaceElement('tablecell');
        parent::add($cell);
        $cell->setConteudo($value);
        return $cell;
    }
    
}
