<?php

/**
 * Descrição da classe est_class_interface_element_janela_manutencao
 *
 * @author Cleber Nardelli
 */
class est_class_interface_element_janela_manutencao extends est_class_interface_element_janela {
    
    function __construct() {
       parent::__construct();
    }
    
    /*
     * O método show irá de fato definir os detalhes de apresentação da janela
     */
    public function show() {
        /* O id da janela é necessário para pode localizá-la posteriormente */
        $this->setDialogCssClass('janela_manutencao');

        /* @var $button est_class_interface_element_button */
        $button = Factory::interfaceElement('button');
        $button->setTitle('Cancelar');
        $button->setAcao(Factory::modelConst('global', 'acao', 'ACAO_CANCELAR'));
        $this->getPanelRodapeDialog()->add($button);

        $button = Factory::interfaceElement('button');
        $button->setTitle('Confirmar');
        $button->setAcao(Factory::modelConst('global', 'acao', 'ACAO_CONFIRMAR'));
        $button->setOnClick("ajaxSendData(janelaManutencao2AjaxData($(this).parents('#". $this->getId() ."'), $(this)))");
        $this->getPanelRodapeDialog()->add($button);      
        
        return parent::show();
    }
     
    
}
