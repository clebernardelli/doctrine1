<?php

/**
 * A classe est_class_interface_element_janela implementa o elemento janela básico do framework.
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
     * @var $rotina integer = Código da rotina relacionada na janela
     */
    private $rotina;
    
    /*
     * O método construdor deverá incrementar o contador e iniciar a janela
     */
    public function __construct() {
        parent::__construct();
        self::$counter ++;  
        /* O id da janela é necessário para pode localizá-la posteriormente */
        $this->setId('janela'.self::$counter);
        $this->setDialogCssClass('janela');
    }
    
    /*
     * O método add serve para adicionar um conteúdo (outro objeto) à janela
     * @param $content est_class_interface_element = Objeto a ser adiconado
     * @param $x integer = Posição x (coluna) em pixels do conteúdo á adicionar.
     * @param $y integer = Posição x (linha) em pixels do conteúdo á adicionar.
     */
    public function add($content, $x = 0, $y = 0) {
        $this->addConteudoDialogo($content, $x, $y);
    }
    
    /*
     * O método show irá de fato definir os detalhes de apresentação da janela
     */
    public function show() {
        return parent::show();
    }
    
    /*
     * Método que retorna o table layout definidp para receber os objetos de interface na janela
     * @return est_class_interface_element_table
     */
    function getTableLayout() {
        return $this->tableLayout;
    }

    /*
     * Este método serve para adicioar um elemento na janela porém sem posicionamento global 
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
