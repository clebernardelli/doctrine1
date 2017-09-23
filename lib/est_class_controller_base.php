<?php

/**
 * Implementa a classe de controller padr�o.
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
     * Este m�todo ser� respons�ve por fazer a chamada aos m�todos invocados pelo usu�rio
     * Quando uma URL for executada passando como par�metro rot&aca o principal vai automaticamente
     * instanciar o controller do formul�rio e ent�o executar� este m�todo Execute()
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
     * Retorna a sigla do m�dulo baseado no nome da classe
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
     * Este m�todo retornar� os dados a partir do filtro por�m em um novo modelo.
     * @var $queryFilter est_class_query_filter 
     */
    final function loadDadosToNewModel($queryFilter) 
    {
        /* @var $model est_class_model_base */
        $model = est_class_model_base::loadDados($this->modulo, $this->classAlias, $queryFilter); 
        return $model;        
    }

    /*
     * Evento que ser� disparado antes de gravar um registro
     */
    function onBeforeGravaDados() {
        //nada
    }

    /*
     * Evento que ser� disparado ap�s de gravar um registro
     */
    function onAfterGravaDados() {
        //nada
    }

    /* 
     * Este n�o poder� ser herdado 
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
            throw new EstException('N�o foi definida uma inst�ncia modelo para o modelDados do controller base!');
        }
        $jsonDados = Principal::getInstance()->getRequest()->post('dados');
        if(!$jsonDados) {
            throw new EstException('N�o foram retornados dados da requisi��o!');
        }    
        $aDados = json_decode($jsonDados, TRUE);
        foreach ($aDados as $key => $value) {
            if (method_exists($this->modelDados, 'set' . $key)) {
                call_user_func(array($this->modelDados, 'set' . $key), $value);
            }                    
        }
    }

}
