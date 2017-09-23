<?php

/**
 * A classe est_class_controller_generic ser� executada toda vez que um determinado formul�rio
 * n�o possuir um controller espec�fico vinculado, desta forma ele dever� fazer a intera��o padr�o
 * entre a vis�o e o modelo
 *
 * @author Cleber Nardelli
 */
class est_class_controller_generic extends est_class_controller_base {
   
    /**
     * @codeCoverageIgnore
     */
    public function execute() {
        parent::execute();
    }
    
    /*
     * Implementa a fun��o base - gen�rica - para a a��o de consulta
     * O int�ito da fun��o � invocar a vis�o que criar� a tela de consulta e projet�-la ao usu�rio.
     * @codeCoverageIgnore
     */
    public function con() {
        /* @var $view est_class_view_base */
        $view = Factory::view($this->getModuloSigla(), $this->getClassAlias());
        $this->enviaTela($view->montaTelaConsulta());
    }
    
    public function inc() {
        
    }
    
    public function alt() {
        
    }
    
    public function exc() {
        
    }
    
    /*
     * ????????????????
     */
    public function grava() { 
        
    }

}
