<?php

/**
 * A classe est_class_interface_element_edit_label devolve um label e um edit dentro de uma linha de 
 * tabela
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_edit_label extends est_class_interface_element_tablerow {
    
    /* @var $label est_class_interface_element_label */
    private $label;

    /* @var $edit est_class_interface_element_edit */
    private $edit;
    
    function __construct() {
        parent::__construct();
                
        //Criar um label
        $this->label = Factory::interfaceElement('label');
        $this->label->addCssClass('label_edit_base');
        $this->addCell($this->label);
        
        //Criar um edit
        $this->edit = Factory::interfaceElement('edit');
        $this->addCell($this->edit);
    }
    
    public function setDescricao($descricao) {
        $this->label->setConteudo($descricao);
    }
    
    public function setNome($nome) {
        $this->edit->setElementName($nome);
    }
    
    public function setObrigatorio($obrigatorio) {
        $this->edit->setObrigatorio($obrigatorio);
    }
    
    public function setMaxLength($maxLength) {
        $this->edit->setMaxLength($maxLength);
    }
    
    public function setMinLength($minLength) {
        $this->edit->setMinLength($minLength);
    }
    
    public function setReadOnly($readOnly) {
        $this->edit->setReadOnly($readOnly);
    }
    
    public function setHint($hint) {
        $this->edit->setHint($hint);
    }
    
    public function onGetValue($scriptName, $script) {
        $this->edit->onGetValue($scriptName, $script);
    }
    
    public function setIsSenha($isSenha) {
        $this->edit->setIsSenha($isSenha);
    }
    
    public function getIsSenha() {
        return $this->edit->getIsSenha();
    }
}
