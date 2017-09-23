<?php

/**
 * Classe est_class_interface_element_dialog é base para qualquer tela a ser exibida pela aplicação.
 *
 * @author Cleber Nardelli
 */
abstract class est_class_interface_element_dialog extends est_class_interface_element {
    
    /*
     * Conteúdo do diálogo
     * @var $content stdClass = Conteúdo do diálogo
     */
    private $content;    
    /*
     * @var $id string = Id do diálogo. Não será montado por ele mas sim pela classe concreta
     */
    private $id;
    /*
     * Posição x do diálogo (coluna)
     * @var $x integer = Coluna
     */    
    private $x;
    /*
     * Posição y do diálogo (linha)
     * @var $y integer = Linha
     */
    private $y;
    /*
     * Tamanho da janela - Largura
     * @var $width integer = Largura 
     */
    private $width;
    /*
     * Tamaho da janela - Altura
     * @var $height integer = Altura
     */
    private $height;
    /*
     * Titulo da janela - caption
     * @var $title string = Título do diálogo
     */
    private $title;
    
    /*
     * @var $panelBase est_class_interface_element_panel
     */
    private $panelBase;
    
    /*
     * @var $rowTitulo est_class_interface_element_panel 
     */
    private $panelTituloDialog;
            
    /*
     * @var $spanTitulo est_class_interface_element_span 
     */
    private $spanTitulo;
    
    /*
     * Este objeto é o panel que define os ítens do rodapé do diálogo
     * @var $panelRodapeDialog est_class_interface_element_panel 
     */
    private $panelRodapeDialog;

    /*
     * @var $cellConteudo est_class_interface_element_panel 
     */
    private $panelConteudo;

    function __construct() {
        /* Este é a área base onde todo o conteúdo do diálogo estará*/
        $this->panelBase = Factory::interfaceElement('panel');
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), $this->width . 'px');
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_HEIGHT'), $this->height . 'px');
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), (int)(($this->height / 2) * -1). 'px');
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_MARGIN_LEFT'), (int)(($this->width / 2) * -1). 'px');
        
        /* Definindo a classe css padrão para o diálogo */
        $this->panelBase->setCssClass('dialog');
        
        /* Agora adicionar um panel para poder organizar os objetos do diálogo */
        /* @var $panelAreaDialog est_class_interface_element_panel */
        $panelAreaDialog = Factory::interfaceElement('panel');
        $panelAreaDialog->setCssClass('area_dialog');
        
        /* Adicionar a linha que conterá o título do diálogo */
        $this->panelTituloDialog = Factory::interfaceElement('panel');
        $this->panelTituloDialog->setHeight(24);
        $this->panelTituloDialog->setCssClass('area_cabecalho_dialog');
        
        /* Adicionar uma área para poder setar o título do diálogo */
        $this->spanTitulo = $this->panelTituloDialog->addSpan('Diálogo Padrão');
        $this->spanTitulo->setCssClass('fundo_titulo_dialog titulo_dialog');
        
        /* Adicionar uma área para adicionar posteriormente os botões da ação do diálogo */ 
        $panelAreaBotoes = Factory::interfaceElement('panel');
        $panelAreaBotoes->setCssClass('fundo_titulo_dialog titulo_area_botoes');
        $this->panelTituloDialog->add($panelAreaBotoes);
        
        /* Adicionar uma área que será o rodapé do dialogo */
        $this->panelRodapeDialog = Factory::interfaceElement('panel');
        $this->panelRodapeDialog->setHeight(30);
        $this->panelRodapeDialog->setCssClass('area_rodape_dialog');
        
        /* O panelConteúdo serve apenas para armazenar o conteúdo do diálogo que 
         * será específico de cada tela descendente */
        $this->panelConteudo = Factory::interfaceElement('panel');
        $this->panelConteudo->setCssClass('area_conteudo_dialog');
        $panelAreaDialog->add($this->panelTituloDialog);
        $panelAreaDialog->add($this->panelConteudo);
        $panelAreaDialog->add($this->panelRodapeDialog);
        $this->panelBase->add($panelAreaDialog);        
    }
    
    public function setDialogCssClass($cssClass) {
        $this->panelBase->addCssClass($cssClass . " dialog");
    }
    
    /*
     * Este método é responsável por setar a posição da janela (x, y)
     * @param $x integer = Posição coluna (em pixels)
     * @param $y integer = Posição linha (em pixels)
     */
    public function setPosition($x, $y) {
        $this->setX($x);
        $this->setY($y);        
    }
    
    /*
     * Este método é reponsável por definir o tamanho da janela (width, height)
     * @param $width integer = Largura da Janela
     * @param $height integer = Altura da Janela
     */
    public function setSize($width, $height) {
        $this->setWidth($width);
        $this->setHeight($height);
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function setWidth($width) {
        $this->width = $width;
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), $this->width . 'px');
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_MARGIN_LEFT'), (int)(($this->width / 2) * -1). 'px');
        $this->spanTitulo->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), ($this->width - 50) . 'px');
        $this->panelTituloDialog->getElementByClass('titulo_area_botoes')->setStyleParam(Factory::interfaceConst('css','CSSPROP_WIDTH'), 50 . 'px');
    }

    public function setHeight($height) {
        $this->height = $height;
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_HEIGHT'), $this->height . 'px');
        $this->panelBase->setStyleParam(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), (int)(($this->height / 2) * -1). 'px');
        $this->panelConteudo->setHeight($this->height - ($this->panelRodapeDialog->getHeight() + $this->panelTituloDialog->getHeight()) );
    }

    public function setTitle($title) {
        $this->title = $title;
        $this->spanTitulo->setConteudo($title);
    }

    public function show(){
        return $this->panelBase->show();
    }
    
    function getId() {
        return $this->id;
    }

    function getPanelBase() {
        return $this->panelBase;
    }
    
    function getPanelConteudo() {
        return $this->panelConteudo;
    }
    
    function getPanelRodapeDialog() {
        return $this->panelRodapeDialog;
    }

    function setConteudoDialogo($content) {
        $this->panelConteudo->setConteudo($content);
    }
    
    /*
     * Método para adicionar algo (como um objeto) ao conteúdo do diálogo
     * 
     * @param $content est_class_interface_element = Objeto a ser adiconado
     * @param $x integer = Posição x (coluna) em pixels do conteúdo á adicionar.
     * @param $y integer = Posição x (linha) em pixels do conteúdo á adicionar.
     */
    function putConteudoDialogo($content, $x = 0, $y = 0) {
        $this->panelConteudo->put($content, $x, $y);
    }

    /*
     * Método para adicionar algo (como um objeto) ao conteúdo do diálogo.
     * A diferença para putConteudoDialogo é que o put irá criar um div e poderá 
     * ser posicionado na tela
     * 
     * @param $content est_class_interface_element = Objeto a ser adiconado
     */
    function addConteudoDialogo($content) {
        $this->panelConteudo->add($content);
    }

    function setId($id) {
        $this->id = $id;
        $this->panelBase->addProperty('id', $id);
    }
    
    function addBotaoFechar() {
        /* @var $btn est_class_interface_element_button_acao_dialog */
        $btn = Factory::interfaceElement('button_acao_dialog');
        $btn->setSpriteImageByPosition(4);
        $btn->setOnClick("fechaDialog('" . $this->getId() . "')");        
        
        $this->panelTituloDialog->getElementByClass('titulo_area_botoes')->add($btn);
    }
    
    function addBotaoMaximizar() {
        /* @var $btn est_class_interface_element_button_acao_dialog */
        $btn = Factory::interfaceElement('button_acao_dialog');
        $btn->setSpriteImageByPosition(5);
        $btn->setOnClick("maximizaDialog('" . $this->getId() . "')");        
        
        $this->panelTituloDialog->getElementByClass('titulo_area_botoes')->add($btn);
    }

    function addBotaoMinimizar() {
        /* @var $btn est_class_interface_element_button_acao_dialog */
        $btn = Factory::interfaceElement('button_acao_dialog');
        $btn->setSpriteImageByPosition(7);
        $btn->setOnClick("minimizaDialog('" . $this->getId() . "')");        
        
        $this->panelTituloDialog->getElementByClass('titulo_area_botoes')->add($btn);
    }

    function addBotaoRestaurar() {
        /* @var $btn est_class_interface_element_button_acao_dialog */
        $btn = Factory::interfaceElement('button_acao_dialog');
        $btn->setSpriteImageByPosition(6);
        $btn->setOnClick("minimizaDialog('" . $this->getId() . "')");        
        
        $this->panelTituloDialog->getElementByClass('titulo_area_botoes')->add($btn);
    }
}
