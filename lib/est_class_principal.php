<?php

/* 
 * Classe principal da aplicação, terá apenas uma instância.
 */

class_alias('est_class_principal', 'Principal');
class est_class_principal {
    
    /*
     * @var est_class_principal Instância única da aplicação
     */
    private static $instance;
    
    /* @var $request est_class_request*/
    private $request;
    
    /* @var $response est_class_response */
    private $response;
            
    private function __construct() {
        $this->request = Factory::lib('request');
        $this->response = Factory::lib('response');
        $this->setHeaderConfig();
    }
    
    private function setHeaderConfig() {
        header("Content-Type: text/html; charset=ISO-8859-1", true);
    }
    
    /*
     * @return est_class_principal
     */
    static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new est_class_principal(); 
        }
        return self::$instance;
    }
    
    /*
     * @return est_class_request
     */
    public function getRequest() {
        return $this->request;
    }
    
    /*
     * @return est_class_response
     */
    public function getResponse() {
        return $this->response;
    }
    
    /*
     * Ao iniciar a aplicação sempre passará por aqui para pegar a partir da requisição
     * o que deve ser carregado.
     */
    public function run() {
        /* Inicia ou continua uma seção */
        if(est_class_session::getSessionStarted()) {
           $this->initSession();
        }
        
        if(($this->getRequest()->post('rot')) && ($this->getRequest()->post('aca'))) {
            $this->runAsForm($this->getRequest()->post('rot'), $this->getRequest()->post('aca'));
        } else {
            if(($this->getRequest()->get('rot')) && ($this->getRequest()->get('aca'))) {
                $this->runAsForm($this->getRequest()->get('rot'), $this->getRequest()->get('aca'));
            } else {
                if ($this->getRequest()->get('action')) {
                    $this->runAsAction($this->getRequest()->post('action'));
                } else {
                    if(isset($GLOBALS['unittest'])) {
                       //nothing  
                    } else {
                        if(class_exists('appinit')) {
                            /* @var $oappInit est_interface_init */
                            $oappInit = Factory::appInit();
                            $oappInit->run();
                        } else {
                            generic_application_message("O método de execução da aplicação não foi definido!" . '<br>' .
                                                        "Deve-se implementar a classe appinit!", E_USER_ERROR);
                        }                       
                    } 
                }
            }
        }
    }
    
    /*
     * Este método é responsável por rodar a aplicação quando uma requisição que solicite uma 
     * rotina e ação
     * @param string $rotina = Código da rotina
     * @param string $acao = Código da ação
     */
    private function runAsForm($rotina, $acao) {
        /* @var $oControle est_class_controller_base */
        $oControle = Factory::formulario($rotina, $acao);
        if($oControle) {
            if($oControle->getMethodAlias()) {
                if(method_exists($oControle, $oControle->getMethodAlias())) {
                    return call_user_func(array($oControle, $oControle->getMethodAlias()));
                } else {
                    throw new EstException('O método ' . $oControle->getMethodAlias() . ' não foi encontrado na class ' . $oControle->getClassAlias() . '!');
                }
            }
            
            $oControle->execute();
        } else {
            /* @var est_class_exception_base */
            throw new EstException('Formulário não encontrado. Rotina: ' . $rotina . ', ação: ' . $acao);
        }
    }
    
    /*
     * Este método é utilizado para executar a aplicação a partir de um action solicitado.
     */
    private function runAsAction($action) {
        throw new EstException('Ainda não programado');
    }
    
    /*
     * Retorna a intância da seção. 
     * Ao acionar este método caso uma seção ainda não esteja iniciada ela será
     */
    public function getSession() {
       return est_class_session::getInstance();
    }
    
    /*
     * Este método serve apenas para inicializar uma seção.
     */
    private function initSession() {
       est_class_session::getInstance(); 
    }
    
}

