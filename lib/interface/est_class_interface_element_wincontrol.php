<?php

/**
 * Descrição da classe est_class_interface_element_wincontrol
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_wincontrol extends est_class_interface_element {
    
    /* @var $hint string */
    private $hint;
    
    /* @var $enabled boolean */
    private $enabled;
    
    function __construct($type) {
        parent::__construct($type);
        $this->enabled = true;
    }
     
    /*
     * Monta a estrutura necessária para exibir o elemento.
     */
    public function show() {
        if ($this->hint) {
            $this->addProperty('title', $this->hint);
        }
        if (!$this->enabled) {
            $this->addCssClass('disabled');
        }
        return parent::show();
    }    
    
    function getHint() {
        return $this->hint;
    }

    function setHint($hint) {
        $this->hint = $hint;
    }
    
    function getEnabled() {
        return $this->enabled;
    }

    function setEnabled($enabled) {
        $this->enabled = $enabled;
    }


}
