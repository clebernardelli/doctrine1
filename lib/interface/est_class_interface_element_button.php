<?php

/**
 * Descri��o da classe est_class_interface_button
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_button extends est_class_interface_element {
    
    /*
     * @var $title string = T�tulo do bot�o
     */
    private $title;
    
    /*
     * @var $acao integer = A��o que o bot�o ir� executar.
     */
    private $acao;
    
    function __construct() {
        parent::__construct('button');
        $this->addCssClass('botao_acao_base');
    }
    
    function setTitle($title) {
        $this->title = $title;
    }
    
    /*
     * Este m�todo serve para vincular uma imagem ao link
     * @param $bgpX integer = Posi��o da imagem em background-position X
     * @param $bgpY integer = Posi��o da imagem em background-position Y
     */
    public function setImage($bgpX, $bgpY) {
        $this->setStyleParam(Factory::interfaceConst('css','CSSPROP_BACKGROUND_POSITION'), '-' . $bgpX . 'px -' . $bgpY . 'px');
    }
    
    public function setSpriteImageByPosition($imagePosition) {
        $imagePosition = $imagePosition + 0.125;
        $this->setImage(0, ($imagePosition * 16));
    }
    
    /*
     * Este m�todo serve para passar um m�todo (script) para ser acionado no onClick
     * @var $script string = Script a ser executado no onClick
     */
    function setOnClick($callbackFunction, $scriptFunction = null) {
        $this->setEvent('onClick', $callbackFunction, $scriptFunction);
    }
    
    public function show() {
        $this->add($this->title);
        if($this->getAcao()) {
            $this->addProperty('aca', $this->getAcao());
        }
        return parent::show();
    }

    function getAcao() {
        return $this->acao;
    }

    function setAcao($acao) {
        $this->acao = $acao;
    }
    
}
