<?php

/**
 * Define a classe est_class_interface_element_pagina que trata de uma página web padrão
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_pagina extends est_class_interface_element {
    
    /*
     * @var $pageTitle string = Titulo da página.
     */
    private $pageTitle;
    
    /*
     * @var $titleArea est_class_interface_element = Area da página que contém a tag título 
     */
    private $titleArea;
    
    /*
     * @var $bodyArea est_class_interface_element = Area da página que contém o body
     */
    private $bodyArea;
    
    function __construct() {
        parent::__construct('html');
        
        /* @var $head est_class_interface_element */
        $head = new est_class_interface_element('head');
        
        $this->titleArea = new est_class_interface_element('title');
        $head->add($this->titleArea);
        
        /* @var $meta est_class_interface_element */
        $meta = new est_class_interface_element('meta');
        $meta->addProperty('content', 'ISO-8859-1');
        $meta->addProperty('http-equiv', 'charset');
        $meta->addProperty('name', 'viewport');
        $meta->addProperty('content', 'width=device-width, initial-scale=1.0');
        $head->add($meta);
        
        /*
         * 
         * Gerar o arquvio de estilos - Apenas para exemplificar.
         * Posteriormente não será necessário chamar toda vez apenas para a distribuição da estrutura ou quando
         * algum outro estilo for posto no factory
         * @var $style est_class_interface_element 
         * 
        */
        $acssLoad = array(est_class_interface_factory_css::geraArqCss(TRUE), 'jAlert-v2-min.css' /*, 'jquery-ui.css'*/);
        foreach ($acssLoad as $value) {
            $style = new est_class_interface_element('style');
            $style->addProperty('type', 'text/css');
            $style->addProperty('media', 'screen, print, projection');
            $style->setConteudo('@import url("' . getBasePath(__FILE__) . '/css/' .  $value . '")');
            $head->add($style);
        }

        $ajsLoad = array('jquery-2.1.3.js', 'js_funcao.js', 'jAlert-v2-min.js', 'jquery-ui.js', 'jquery.layout-latest.js');
        /* @var $script est_class_interface_element */
        foreach ($ajsLoad as $value) {
            $script = new est_class_interface_element('script');
            $script->addProperty('type', 'text/javascript');
            $script->addProperty('load', 'true');
            $script->addProperty('src', getBasePath(__FILE__) . '/js/' . $value);
            $head->add($script);
        }

        parent::add($head);
        
        $this->bodyArea = new est_class_interface_element('body');
        parent::add($this->bodyArea);
        
    }

    function getPageTitle() {
        return $this->pageTitle;
    }

    function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
        $this->titleArea->setConteudo($this->getPageTitle());
    }

    public function add($child) {
        $this->bodyArea->add($child);
    }
    
    public function show() {
        $result = parent::show();
        return "<!DOCTYPE html>" . PHP_EOL . $result;
    }
    
}
