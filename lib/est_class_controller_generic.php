<?php

/**
 * A classe est_class_controller_generic será executada toda vez que um determinado formulário
 * não possuir um controller específico vinculado, desta forma ele deverá fazer a interação padrão
 * entre a visão e o modelo
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
     * Implementa a função base - genérica - para a ação de consulta
     * O intúito da função é invocar a visão que criará a tela de consulta e projetá-la ao usuário.
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
