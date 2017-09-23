<?php

/**
 * Classe de inicialização padrão da aplicação.
 * A classe appinit uma vez implementada é a que será chamada automaticamente pelo est_class_principal.
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
        $pagina->setPageTitle('Aplicação do Cleber');
        
        $login = Factory::controller('global', 'login');
        $pagina->add($login->execute());
                
        $pagina->add("TODO <br>
                4 - Montar a página da aplicação - área de trabalho padrão <br>
                5 - Montar estrutura de menu padrão");
        
        echo $pagina->show();
    }

}
