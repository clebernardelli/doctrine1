<?php

/**
 * Descrição da classe global_view_menu_principal
 *
 * @author Cleber Nardelli
 */
class global_view_menuPrincipal extends est_class_view_generic_base {
    
    /* @property mixed est_class_interface_element_area_trabalho $areaTrabalho */
    private $areaTrabalho;
    
    function __construct() {
        $this->areaTrabalho = Factory::interfaceElement('area_trabalho');
        $this->areaTrabalho->addAreaCabecalho();
        $this->areaTrabalho->addAreaDireita();
        $this->areaTrabalho->addAreaCentro();
    }

    public function montaTela() {
        echo $this->areaTrabalho->show();
    }

}
