<?php

/**
 * Define a class classe est_class_interface_element_link que serve para controle dos links
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_link extends est_class_interface_element {
    
    function __construct() {
        parent::__construct('a');
    }
    
    /*
     * Este método serve para vincular uma imagem ao link
     * @param $source string = Caminho do arquivo de imagem
     */
    function setImage($source) {
        /* @var $image est_class_interface_element_image */
        $image = Factory::interfaceElement('image');
        $image->setSource($source);
        $this->add($image);
    }
    
    /*
     * Este método serve para passar um método (script) para ser acionado no onClick
     * @var $script string = Script a ser executado no onClick
     */
    function setOnClick($script) {
        $this->addProperty('onClick', $script);
    }

    
}
