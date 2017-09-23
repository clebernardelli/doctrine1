<?php

/**
 * Classe de inicializa��o padr�o da aplica��o.
 * A classe appinit uma vez implementada � a que ser� chamada automaticamente pelo est_class_principal.
 * 
 * @author Cleber Nardelli
 */
class appinit implements est_interface_init {
    
    public function run() {
        $this->showMenuPrincipal();
    }
    
    private function showMenuPrincipal() {
        /* @var $pagina est_class_interface_element_pagina */
        $pagina = Factory::interfaceElement('pagina');
        $pagina->setPageTitle('Aplica��o do Cleber');
        
        $login = Factory::controller('global', 'login');
        $pagina->add($login->execute());
                
        $pagina->add("TODO <br>
                4 - Montar a p�gina da aplica��o - �rea de trabalho padr�o <br>
                5 - Montar estrutura de menu padr�o");
        
        echo $pagina->show();
    }

}
