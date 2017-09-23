<?php

/**
 * A classe est_class_interface_element_janela implementa o elemento janela b�sico do framework.
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_janela extends est_class_interface_element_dialog {
    
    /*
     * Contador de Janelas instanciadas
     * @var $counter integer = Quantidade de Janelas instanciadas
     */
    static private $counter;
    
    /*
     * @var $tableLayout est_class_interface_element_table 
     */
    private $tableLayout;
    
    /*
     * @var $rotina integer = C�digo da rotina relacionada na janela
     */
    private $rotina;
    
    /*
     * O m�todo construdor dever� incrementar o contador e iniciar a janela
     */
    public function __construct() {
        parent::__construct();
        self::$counter ++;  
        /* O id da janela � necess�rio para pode localiz�-la posteriormente */
        $this->setId('janela'.self::$counter);
        $this->setDialogCssClass('janela');
    }
    
    /*
     * O m�todo add serve para adicionar um conte�do (outro objeto) � janela
     * @param $content est_class_interface_element = Objeto a ser adiconado
     * @param $x integer = Posi��o x (coluna) em pixels do conte�do � adicionar.
     * @param $y integer = Posi��o x (linha) em pixels do conte�do � adicionar.
     */
    public function add($content, $x = 0, $y = 0) {
        $this->addConteudoDialogo($content, $x, $y);
    }
    
    /*
     * O m�todo show ir� de fato definir os detalhes de apresenta��o da janela
     */
    public function show() {
        return parent::show();
    }
    
    /*
     * M�todo que retorna o table layout definidp para receber os objetos de interface na janela
     * @return est_class_interface_element_table
     */
    function getTableLayout() {
        return $this->tableLayout;
    }

    /*
     * Este m�todo serve para adicioar um elemento na janela por�m sem posicionamento global 
     * ou tabela
     * @var $element est_class_interface_element 
     */
    public function addElement($oElement) {
        $this->add($oElement);
    }
    
    public function addElementOnLayout($oElement) {
        if(!isset($this->tableLayout)) {
            /* @var $this->tableLayout est_class_interface_element_table */
            $this->tableLayout = Factory::interfaceElement('table');
            $this->tableLayout->addCssClass('table_layout');
            $this->add($this->tableLayout);
        }
        
        if(is_a($oElement, 'est_class_interface_element_tablerow')) {
            $this->tableLayout->add($oElement);  
        } else {
            /* @var $row est_class_interface_element_tablerow */
            $row = $this->tableLayout->addRow();
            if(is_array($oElement)) {
                foreach ($oElement as $oel) {
                    $row->addCell($oel);
                }
            } else {
                $row->addCell($oElement);
            }
        } 
    }
    
    function getRotina() {
        return $this->rotina;
    }

    function setRotina($rotina) {
        $this->rotina = $rotina;
        $this->getPanelBase()->addProperty('rot', $this->getRotina());
    }
    
}
