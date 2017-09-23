<?php

/**
 * A classe est_class_interface_element_panel implementa os controles necessários para um 
 * painél visual.
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_panel extends est_class_interface_element_wincontrol {

    /*
     * @var $width integer = Largura do Painel
     */
    private $width;
    
    /*
     * @var $height integer = Altura do Painel
     */
    private $height;
    
    /*
     * O método construtor já definirá detalhes do elemento painel
     */
    public function __construct() {
        parent::__construct('div');
        $this->setCssClass('panel');
    }
    
    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setWidth($width) {
        $this->width = $width;
        $this->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), $this->width.'px');
    }

    public function setHeight($height) {
        $this->height = $height;
        $this->setStyleParam(Factory::interfaceConst('css','CSSPROP_HEIGHT'), $this->height.'px');
    }
    
    /*
     * Este método serve para adicionar um objeto no painel
     * 
     * @param $widget string = Objeto a ser inserido no painel
     * @param $x integer     = Coluna em pixels;
     * @param $y integer     = Linha em pixels;
     */
    public function put($widget, $x, $y) {
        /* @var $camada est_class_interface_element */
        $camada = new est_class_interface_element('div');
        $camada->setStyleParam(Factory::interfaceConst('css','CSSPROP_POSITION'), 'absolute');
        $camada->setStyleParam(Factory::interfaceConst('css','CSSPROP_LEFT'), $x.'px');
        $camada->setStyleParam(Factory::interfaceConst('css','CSSPROP_TOP'), $y.'px');
        $camada->add($widget);
        parent::add($camada);
    }
    
    public function addSpan($conteudo) {
        /* @var $span est_class_interface_element_span */
        $span = Factory::interfaceElement('span');
        $span->setConteudo($conteudo);
        
        $this->add($span);
        
        return $span;
    }
    
}
