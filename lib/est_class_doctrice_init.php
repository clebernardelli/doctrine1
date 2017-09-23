<?php
/* 
 * Arquivo de inicializa��o do doctrine
 * 
 */
require_once $GLOBALS['enderecoFramework'] . "/vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/*
 * A classe est_doctrine_init ter� uma �nica inst�ncia dispon�vel para a aplica��o.
 */
class_alias('est_class_doctrine_init', 'Doctrine');
class est_class_doctrine_init {
    
    /*
     * @Var Bootstrap
     */
    public static $instance;
    
    /*
     * @Var EntityManager
     */
    private $entityManager;
    
    /**
     * @codeCoverageIgnore
     */
    function __construct() {
        //$entidades = $this->getDinamicModelPaths();
        $entidades = $this->getStaticModelPaths();
        $isDevMode = true;

        $dbParams = array('driver'   => 'pdo_pgsql',
                          'user'     => 'postgres',
                          'password' => '123456',
                          'dbname'   => 'postgres',
                         );

        //setando as configura��es definidas anteriormente
        $config = Setup::createAnnotationMetadataConfiguration($entidades, $isDevMode);

        //criando o Entity Manager com base nas configura��es de dev e banco de dados
        $this->entityManager = EntityManager::create($dbParams, $config);
    }
    
    private function getEntityManager() {
        return $this->entityManager;
    }
        
    /*
     * @return EntityManager Retorna uma inst�ncia �nica de EntityManager
     */
    public static function getEntityManagerInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new est_class_doctrine_init();
        }

        return self::$instance->getEntityManager();        
    }
    
    /**
     * Retorna um array com as pastas de modelo dispon�veis na aplica��o
     * na pasta SRC.
     * @return array;
     */
    private function getDinamicModelPaths($path = null, $aResult = null) {
        if(!$path) { 
            $path = "src/";
            $aResult = array();
        } 
        $diretorio = dir($path);
        while($content = $diretorio -> read()){
            if($content == 'model') {
                array_push($aResult, $path . '/' . $content);
            } else {
                if(($content != '.') && ($content != '..') && ($content != 'controller') && ($content != 'view')) { 
                    $aTemp = $this->getModelPaths($path . $content, $aResult);
                    $aResult = array_merge($aResult, $aTemp);
                }
            }
        }
        $diretorio -> close();
        
        return array_unique($aResult);
    }
    
    /*
     * Mesma fun��o do m�todo acima, por�m � mais r�pido.
     * @return array;
     */
    private function getStaticModelPaths() {
        return array('/src/global/model/',
                     '/src/unico/model/');
    }
    
}