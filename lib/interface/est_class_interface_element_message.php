<?php

/**
 * Define a classe est_class_interface_element_message que é a classe base para mensagens 
 * a enviar ao usuário
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_message extends est_class_interface_element_dialog {
    
    const TAMANHO_WIDTH = 400;
    const TAMANHO_HEIGHT = 200;
    
    /*
     * Contador de Mensagens instanciadas
     * @var $counter integer = Quantidade de mensagens instanciadas
     */
    static private $counter;
    
    /*
     * @var $type integer = Tipo da Mensagem
     */
    private $type;
    
    /*
     * @var $mensagem string = Texto do corpo da mensagem
     */
    private $mensagem;
    
    function __construct() {
        parent::__construct();
        self::$counter ++;
    }
    
    public function show() {
        /* O id da janela é necessário para pode localizá-la posteriormente */
        $this->setId('message'.self::$counter);
        $this->setTitle('Mensagem');
        $this->setSize(self::TAMANHO_WIDTH, self::TAMANHO_HEIGHT);
        $this->setDialogCssClass('message_base');

        /* @var $tabela est_class_interface_element_table */
        $tabela = Factory::interfaceElement('table');
        $tabela->setStyleParam(Factory::interfaceConst('css','CSSPROP_ALIGN'), 'center');
        $tabela->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $tabela->setStyleParam(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '100%');
        /* @var $row est_class_interface_element_tablerow */
        $row = $tabela->addRow();
        $row->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $row->addCell('imagem');
        /* @var $messageCell est_class_interface_element_tablecell */
        $messageCell = $row->addCell($this->getMensagem());
        $messageCell->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $messageCell->setStyleParam(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '100%');
        $messageCell->setStyleParam(Factory::interfaceConst('css','CSSPROP_TEXT_ALIGN'), 'center');
        
        /* @var $button est_class_interface_element_button */
        $button = Factory::interfaceElement('button');
        $button->setTitle('Fechar');
        $button->setOnClick("fechaDialog('". $this->getId() . "')");
        
        $row = $tabela->addRow();
        
        $buttonCell = $row->addCell($button);
        $buttonCell->addProperty('colspan',2);
        $buttonCell->setStyleParam(Factory::interfaceConst('css','CSSPROP_TEXT_ALIGN'), 'center');

        $this->setConteudoDialogo($tabela);
        return parent::show();
    }

    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }

    function getMensagem() {
        return $this->mensagem;
    }

    function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

}
