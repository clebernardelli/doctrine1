<?php
/* 
 * Arquivo de inicialização do doctrine
 * 
 */
require_once $GLOBALS['enderecoFramework'] . "/vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/*
 * A classe est_doctrine_init terá uma única instância disponível para a aplicação.
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

        //setando as configurações definidas anteriormente
        $config = Setup::createAnnotationMetadataConfiguration($entidades, $isDevMode);

        //criando o Entity Manager com base nas configurações de dev e banco de dados
        $this->entityManager = EntityManager::create($dbParams, $config);
    }
    
    private function getEntityManager() {
        return $this->entityManager;
    }
        
    /*
     * @return EntityManager Retorna uma instância única de EntityManager
     */
    public static function getEntityManagerInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new est_class_doctrine_init();
        }

        return self::$instance->getEntityManager();        
    }
    
    /**
     * Retorna um array com as pastas de modelo disponíveis na aplicação
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
     * Mesma função do método acima, porém é mais rápido.
     * @return array;
     */
    private function getStaticModelPaths() {
        return array('/src/global/model/',
                     '/src/unico/model/');
    }
    
}