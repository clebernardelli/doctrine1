<?php

/**
 * Descrição da classe est_class_interface_element_edit
 *
 * @property mixed boolean $obrigatorio Indica se o elemento input é obrigatório 
 * @property mixed boolean $readonly Indica se o elemento readonly é obrigatório 
 * @property mixed int $maxLength Indica o tamanho máximo de caracteres permitidos
 * @property mixed int $minLength Indica o tamanho mínimo de caracteres permitidos
 * @property mixed boolean $isSenha Indica se o input é tipo senha mascarado
 * @property mixed mixed $minvalue Indica o valor mínimo para o campo 
 * @example Para um campo data: setMinValue('1900-01-01');
 * @property mixed mixed $maxvalue Indica o valor máximo para o campo 
 * @example Para um campo data: setMaxValue('2100-01-01');
 */
abstract class est_class_interface_element_edit_base extends est_class_interface_element_wincontrol {

    private $obrigatorio;
    private $readonly;
    private $maxLength;
    private $minLength;
    private $isSenha;
    private $minValue;
    private $maxValue;
    
    function __construct($type) {
        parent::__construct($type);
        $this->addCssClass('edit_base');
        $this->addProperty('type', 'text');
    }
    
    /*
     * Método show, retorna o input renderizado com as opções pré-definidas
     */
    public function show() {
        if ($this->obrigatorio) {
            $this->addProperty('required');
        }
        if ($this->maxLength) {
            $this->addProperty('maxlength', $this->maxLength);
        }
        if ($this->minLength) {
            $this->addProperty('minlength', $this->minLength);
        }
        if ($this->readonly) {
            $this->addProperty('readonly', $this->readonly);
        }
        if ($this->isSenha) {
            $this->addProperty('type', 'password');
        } 
        if ($this->minValue) {
            $this->addProperty('min', $this->minValue);
        }
        if ($this->maxValue) {
            $this->addProperty('max', $this->maxValue);
        }
        return parent::show();
    }

    function getObrigatorio() {
        return $this->obrigatorio;
    }

    function getMaxLength() {
        return $this->maxLength;
    }

    function getMinLength() {
        return $this->minLength;
    }

    function getIsSenha() {
        return $this->isSenha;
    }

    function setIsSenha($isSenha) {
        $this->isSenha = $isSenha;
    }
    
    function getMinValue() {
        return $this->minValue;
    }

    function getMaxValue() {
        return $this->maxValue;
    }

    function setMinValue($minValue) {
        $this->minValue = $minValue;
    }

    function setMaxValue($maxValue) {
        $this->maxValue = $maxValue;
    }
        
    /*
     * Este método serve para passar uma função de callback (em JavaScript) que será
     * executada quando for buscado o valor do campo
     * @var $callbackFunction string = Nome da função de callback (JS)
    */
    public function onGetValue($callbackFunction, $scriptFunction) {
        $this->setEvent('onGetValue', $callbackFunction, $scriptFunction);
    }
    
    /*
     * Este método serve para setar a propriedade obrigatório para true ou false.
     * @var $obrigatorio boolean = Indica se o edit é de preenchimento obrigatório ou não
     */
    public function setObrigatorio($obrigatorio) {
        $this->obrigatorio = $obrigatorio;
    }
    
    /*
     * Este método serve para setar a quantidade máxima de caracteres que campo pode ter
     * @var $maxLength integer = Número máximo de caracteres.
     */
    public function setMaxLength($maxLength) {
        $this->maxLength = $maxLength;
    }
    
    /*
     * Este método serve para setar a quantidade máxima de caracteres que campo pode ter
     * @var $minLength integer = Número mínimo de caracteres.
     */
    public function setMinLength($minLength) {
        $this->minLength = $minLength;
    }
    
    function getReadonly() {
        return $this->readonly;
    }

    function setReadonly($readonly) {
        $this->readonly = $readonly;
    }

}
