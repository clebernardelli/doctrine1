<?php

/**
 * Descri��o da classe est_class_interface_element_edit
 *
 * @property mixed boolean $obrigatorio Indica se o elemento input � obrigat�rio 
 * @property mixed boolean $readonly Indica se o elemento readonly � obrigat�rio 
 * @property mixed int $maxLength Indica o tamanho m�ximo de caracteres permitidos
 * @property mixed int $minLength Indica o tamanho m�nimo de caracteres permitidos
 * @property mixed boolean $isSenha Indica se o input � tipo senha mascarado
 * @property mixed mixed $minvalue Indica o valor m�nimo para o campo 
 * @example Para um campo data: setMinValue('1900-01-01');
 * @property mixed mixed $maxvalue Indica o valor m�ximo para o campo 
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
     * M�todo show, retorna o input renderizado com as op��es pr�-definidas
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
     * Este m�todo serve para passar uma fun��o de callback (em JavaScript) que ser�
     * executada quando for buscado o valor do campo
     * @var $callbackFunction string = Nome da fun��o de callback (JS)
    */
    public function onGetValue($callbackFunction, $scriptFunction) {
        $this->setEvent('onGetValue', $callbackFunction, $scriptFunction);
    }
    
    /*
     * Este m�todo serve para setar a propriedade obrigat�rio para true ou false.
     * @var $obrigatorio boolean = Indica se o edit � de preenchimento obrigat�rio ou n�o
     */
    public function setObrigatorio($obrigatorio) {
        $this->obrigatorio = $obrigatorio;
    }
    
    /*
     * Este m�todo serve para setar a quantidade m�xima de caracteres que campo pode ter
     * @var $maxLength integer = N�mero m�ximo de caracteres.
     */
    public function setMaxLength($maxLength) {
        $this->maxLength = $maxLength;
    }
    
    /*
     * Este m�todo serve para setar a quantidade m�xima de caracteres que campo pode ter
     * @var $minLength integer = N�mero m�nimo de caracteres.
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
