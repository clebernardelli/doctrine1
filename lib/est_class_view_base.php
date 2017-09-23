<?php

/**
 * Classe base est_class_view_base da visão 
 *
 * @author Administrador
 */
abstract class est_class_view_base {
    
    /* @var $rotina integer = Código da Rotina base*/
    private $rotina;
    
    /* @var $title string = Título da view (janela) */
    private $title;
    
    /* @var $janela est_class_interface_element_janela_manutencao */
    private $janela;

    protected function montaTelaConsulta(){}    
    protected function montaTelaDados() {}
    protected function montaTelaInclusao() {}
    protected function montaTelaAlteracao() {}
    
    function __construct() {
        $this->janela = Factory::interfaceElement('janela_manutencao');
        $this->janela->addBotaoFechar();
        $this->janela->setSize(500, 200);
    }
    
    function getJanela() {
        return $this->janela;
    }

    function setJanela($janela) {
        $this->janela = $janela;
    }
    
    function getRotina() {
        return $this->rotina;
    }

    function setRotina($rotina) {
        $this->rotina = $rotina;
        $this->janela->setRotina($rotina);
    }
    
    function getTitle() {
        return $this->title;
    }

    function setTitle($title) {
        $this->title = $title;
        $this->janela->setTitle($title);
    }
    
    /*
     * Retornará os dados da tela em formato JSON
     */
    protected function getJsonDados() {
        
    }
    
    /*
     * Este método será responsável por enviar a tela ao usuário
     */
    public function enviaTela() {
        return $this->getJanela()->show();
    }
    
    /*
     * Este método retorna um campo edit label normal.
     * @var $descricao string = Descrição - Nome que vai no label
     * @var $nome string = Nome do campo mapeado
     * @var $obrigatorio boolean = Indica se o campo será obrigatório ou não
     * @var $readOnly boolean = Indica se o campo será readOnly ou não
     * @var $maxLength integer = Indica o tamamho máximo de caracteres aceitos pelo campo. Se null, indica que não tem limite máximo
     * @var $minLength integer = Indica o tamanho mínimo de caracteres aceitos pelo campo. Se null, indica que não tem limite mínimo
     */
    protected function addCampo($descricao, $nome, $obrigatorio, $readOnly = null, $maxLength = null, $minLength = null) {
        /* @var $result est_class_interface_element_edit_label */
        $result = Factory::interfaceElement('edit_label');
        $result->setDescricao($descricao);
        $result->setNome($nome);
        $result->setObrigatorio($obrigatorio);
        if($readOnly) {
           $result->setReadOnly($readOnly);
        }
        if($maxLength) {
           $result->setMaxLength($maxLength);
        }
        if ($minLength) {
           $result->setMinLength($minLength);
        }
        
        /*Apenas adicionar o elemento na janela, ele já está tabulado*/
        $this->janela->addElementOnLayout($result);
        
        return $result;
    }
    
    /*
     * Este método retorna um campo edit label normal.
     * @var $descricao string = Descrição - Nome que vai no label
     * @var $nome string = Nome do campo mapeado
     * @var $obrigatorio boolean = Indica se o campo será obrigatório ou não
     * @var $readOnly boolean = Indica se o campo será readOnly ou não
     * @var $maxLength integer = Indica o tamamho máximo de caracteres aceitos pelo campo. Se null, indica que não tem limite máximo
     * @var $minLength integer = Indica o tamanho mínimo de caracteres aceitos pelo campo. Se null, indica que não tem limite mínimo
     */
    protected function addCampoSenha($descricao, $nome, $maxLength = null, $minLength = null) {
        $result = $this->addCampo($descricao, $nome, TRUE, FALSE, $maxLength, $minLength);
        $result->setIsSenha(TRUE);
        
        return $result;        
    }
    
}
