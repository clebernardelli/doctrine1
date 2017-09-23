<?php

/**
 * Descrição da classe est_class_interface_element_area_trabalho
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_area_trabalho extends est_class_interface_element {
    
    /* @property mixed est_class_interface_element_pagina $pagina */
    private $pagina;
    
    /* @property mixed est_class_interface_element_panel $areaCabecalho */
    private $areaCabecalho;

    /* @property mixed est_class_interface_element_panel $areaDireita */
    private $areaDireita;

    /* @property mixed est_class_interface_element_panel $areaEsquerda */
    private $areaEsquerda;
    
    /* @property mixed est_class_interface_element_panel $areaRodape */
    private $areaRodape;

    /* @property mixed est_class_interface_element_panel $areaCentro */
    private $areaCentro;

    function __construct() {
        $this->pagina = Factory::interfaceElement('pagina');
        $this->add($this->pagina);
        
        //Definir o body como um layout.
        $this->pagina->addScript(
                 '$(document).ready(function () {
                    $(\'body\').layout({ applyDefaultStyles: true });
                  });');
    }
    
    public function show() {
        if(isset($this->areaCabecalho)) {
            $this->pagina->add($this->areaCabecalho);
        }
        if(isset($this->areaEsquerda)) {
            $this->pagina->add($this->areaEsquerda);
        }
        if(isset($this->areaDireita)) {
            $this->pagina->add($this->areaDireita);
        }
        if(isset($this->areaRodape)) {
            $this->pagina->add($this->areaRodape);
        }
        if(isset($this->areaCentro)) {
            $this->pagina->add($this->areaCentro);
        }        
                
        return parent::show();
    }
    
    public function addAreaCabecalho() {
        $this->areaCabecalho = Factory::interfaceElement('panel');
        $this->areaCabecalho->addProperty('id', 'cabecalho_menu_principal');
        $this->areaCabecalho->addCssClass('ui-layout-north');
    }

    public function addAreaEsquerda() {
        $this->areaEsquerda = Factory::interfaceElement('panel');
        $this->areaEsquerda->addCssClass('ui-layout-west');
    }

    public function addAreaDireita() {
        $this->areaDireita = Factory::interfaceElement('panel');
        $this->areaDireita->addCssClass('ui-layout-east');
    }

    public function addAreaRodape() {
        $this->areaRodape = Factory::interfaceElement('panel');
        $this->areaRodape->addCssClass('ui-layout-south');
    }

    public function addAreaCentro() {
        $this->areaCentro = Factory::interfaceElement('panel');
        $this->areaCentro->addCssClass('ui-layout-center');
    }
    
    /*
     * @return est_class_interface_element_panel
     */
    function getAreaCabecalho() {
        return $this->areaCabecalho;
    }

    /*
     * @return est_class_interface_element_panel
     */
    function getAreaDireita() {
        return $this->areaDireita;
    }

    /*
     * @return est_class_interface_element_panel
     */
    function getAreaEsquerda() {
        return $this->areaEsquerda;
    }

    /*
     * @return est_class_interface_element_panel
     */
    function getAreaRodape() {
        return $this->areaRodape;
    }

    /*
     * @return est_class_interface_element_panel
     */
    function getAreaCentro() {
        return $this->areaCentro;
    }
    
}
