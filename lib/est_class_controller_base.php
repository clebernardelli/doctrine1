<?php

/**
 * Implementa a classe de controller padrão.
 *
 * @author Administrador
 */
abstract class est_class_controller_base {
    
    /* @var $acao string */
    private $acao;
    /* @var $rotina string */
    private $rotina;
    /* @var $activeRecord est_class_model_base */
    private $activeRecord;
    /* @var $entityManager \Doctrine\ORM\EntityManager */
    private $entityManager;
    /* Para uso interno */
    private $modulo;
    private $classAlias;
    private $methodAlias;
    
    /* @var $modelDados est_class_model_base */
    protected $modelDados;
    
    public function __construct($sModulo, $sClassAlias) {
        $this->entityManager = Doctrine::getEntityManagerInstance();
        $this->modulo = $sModulo;
        $this->classAlias = $sClassAlias;
    }

    /*
     * Este método será responsáve por fazer a chamada aos métodos invocados pelo usuário
     * Quando uma URL for executada passando como parâmetro rot&aca o principal vai automaticamente
     * instanciar o controller do formulário e então executará este método Execute()
     */
    public function execute() {
        if(method_exists($this, $this->methodAlias)) {
            call_user_func(array($this, $this->methodAlias));
        }
    }
    
    protected function getResponse() {
        return Principal::getInstance()->getResponse();
    }

    public function getAcao() 
    {
        return $this->acao;
    }

    function getRotina() {
        return $this->rotina;
    }

    function setRotina($rotina) {
        $this->rotina = $rotina;
    }

    public function setAcao($acao) 
    {
        $this->acao = $acao;
    }
    
    function getActiveRecord() {
        return $this->activeRecord;
    }

    function setActiveRecord($activeRecord) {
        $this->activeRecord = $activeRecord;
    }

    function getModulo() {
        return $this->modulo;
    }

    function getClassAlias() {
        return $this->classAlias;
    }

    function setModulo($modulo) {
        $this->modulo = $modulo;
    }

    function setClassAlias($classAlias) {
        $this->classAlias = $classAlias;
    }

    function getMethodAlias() {
        return $this->methodAlias;
    }

    function setMethodAlias($methodAlias) {
        $this->methodAlias = $methodAlias;
    }
    
    /*
     * Retorna a sigla do módulo baseado no nome da classe
     * @return String
     */
    public function getModuloSigla() { 
        return substr(get_class($this), 0, stripos(get_class($this), '_'));
    }    
    
    /*
     * Retorna um novo modelo baseado no controller setado ($this->getModuloSigla(), $this->getClassAlias())
     */
    private function newModel() {
        return Factory::model($this->getModuloSigla(), $this->getClassAlias());
    }
    
    /*
     * @var $model est_class_model_base
     * @var $filter est_class_query_filter
     */
    final function loadDadosToModel($model, $queryFilter) 
    {
        $model->loadDados($queryFilter);
    }
    
    /* 
     * Este método retornará os dados a partir do filtro porém em um novo modelo.
     * @var $queryFilter est_class_query_filter 
     */
    final function loadDadosToNewModel($queryFilter) 
    {
        /* @var $model est_class_model_base */
        $model = est_class_model_base::loadDados($this->modulo, $this->classAlias, $queryFilter); 
        return $model;        
    }

    /*
     * Evento que será disparado antes de gravar um registro
     */
    function onBeforeGravaDados() {
        //nada
    }

    /*
     * Evento que será disparado após de gravar um registro
     */
    function onAfterGravaDados() {
        //nada
    }

    /* 
     * Este não poderá ser herdado 
     */
    final function gravaDados() 
    {
        $this->onBeforeGravaDados(); 
        
        /* @var est_class_doctrine_init Doctrine */
        $entityManager->persist($this->getActiveRecord());
        
        $this->onAfterGravaDados();
    }
    
    protected function loadModelDadosFromView() {
        if(!$this->modelDados) {
            throw new EstException('Não foi definida uma instância modelo para o modelDados do controller base!');
        }
        $jsonDados = Principal::getInstance()->getRequest()->post('dados');
        if(!$jsonDados) {
            throw new EstException('Não foram retornados dados da requisição!');
        }    
        $aDados = json_decode($jsonDados, TRUE);
        foreach ($aDados as $key => $value) {
            if (method_exists($this->modelDados, 'set' . $key)) {
                call_user_func(array($this->modelDados, 'set' . $key), $value);
            }                    
        }
    }

}
