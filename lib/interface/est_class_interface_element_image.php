<?php

/**
 * Descrição da classe est_class_interface_image_element
 *
 * @author Administrador
 */
class est_class_interface_element_image extends est_class_interface_element_wincontrol {
    
    /*
     * @var $source string = Indica o local da imagem
     */
    private $source;
    
    function __construct() {
        parent::__construct('img');
    }
    
    /*
     * Este método serve para definir a imagem (arquivo) a ser exibido.
     * @param $source string = Arquivo a ser exibido pelo elemento image.
     */
    public function setSource($source) {
        $this->source = $source;
        $this->addProperty('src', $source);
        $this->addProperty('border', '0');
    }

}
