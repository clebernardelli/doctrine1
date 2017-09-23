<?php

/**
 * A classe est_class_interface_tablerow � uma linha de uma tabela
 * Trata-se de uma composi��o, portanto n�o faz sentido sua exist�ncia sem uma tabela para adicion�-la.
 * 
 * @author Cleber Nardelli
 */
class est_class_interface_element_tablerow extends est_class_interface_element_wincontrol {
    
    function __construct() {
        parent::__construct('tr');
    }

    /*
     * O m�todo addCell � respons�vel por adicionar novas c�lulas na linha da tabela.
     * @param $value string = Valor a ser exibido na c�lula
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
