<?php

/**
 * Descrição da classe global_controller_login
 *
 * @author Cleber Nardelli
 */
class global_controller_login extends est_class_controller_base
{
        const ROTINA = 6;
    
        /*
         * @var $modelDados global_model_login 
         */
        protected $modelDados;
    
        public function execute() {
           $this->setRotina(self::ROTINA); 
            
           /* @var $view global_view_login */
           $view = Factory::view('global', 'login');
           return $view->montaTelaManutencao();
        }
        
        /*
         * Método para validar o login
         */
        public function confirmar() {
            $this->modelDados = Factory::model('global', 'login');
            $this->loadModelDadosFromView();
            if($this->modelDados->validaLogin()) {
                $this->getResponse()->addItem('login', 'ok');
                $this->getResponse()->addItem('request_form', getUrl() . '/?rot=7&aca=7');
                $this->getResponse()->sendResponse();
            }            
        }
        
}