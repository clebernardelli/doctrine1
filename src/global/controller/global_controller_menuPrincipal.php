<?php

/**
 * Descrição da classe global_controller_menu
 *
 * @author Cleber Nardelli
 */
class global_controller_menuPrincipal extends est_class_controller_base {
    
    const ROTINA = 7;
    
    public function execute() {
       $this->setRotina(self::ROTINA); 

       /* @var $view global_view_menu_principal */
       $view = Factory::view('global', 'menuPrincipal');
       return $view->montaTela();
    }
    
}
