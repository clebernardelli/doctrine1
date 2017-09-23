<?php

/**
 * A classe est_class_interface_table implementa o comportamento visual de uma tabela
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_table extends est_class_interface_element_wincontrol {
    
    /*
     * @var $rowCount integer = Utilizado para controlar o número de linhas da tabela
     */
    private $rowCount;
    
    /*
     * @var $isZebrado boolean = Indica se a tabela terá um visual zebrado ao ser exibida.
     */
    private $isZebrado;
    
    /*
     * Sobrescrever o método construtor para passar o tipo de elemento table
     */
    function __construct() {
        parent::__construct('table');
        $this->isZebrado = false;
        $this->rowCount = 0;
    }

    /*
     * O método addRow adiciona linhas na tabela criada.
     * @return est_class_interface_tablerow 
     */
    public function addRow() {
        $row = Factory::interfaceElement('tablerow');
        $this->rowCount++;
        
        if($this->isZebrado) {
            //Tornar zebrado - ver comportamento posterior utilizando CSS
        }
        
        parent::add($row);
        return $row;
    }
    
    /*
     * Método que retornará uma linha (tablerow) porém com formatação específica de cabeçalho
     * @return est_class_interface_tablerow
     */
    public function addCabecalho() {
        $row = $this->addRow();
        return $row;
    }
    
    function getRowCount() {
        return $this->rowCount;
    }

    function getIsZebrado() {
        return $this->isZebrado;
    }

    function setIsZebrado($isZebrado) {
        $this->isZebrado = $isZebrado;
    }


    
}
