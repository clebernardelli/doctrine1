<?php

/* 
 * Classe principal da aplica��o, ter� apenas uma inst�ncia.
 */

class_alias('est_class_principal', 'Principal');
class est_class_principal {
    
    /*
     * @var est_class_principal Inst�ncia �nica da aplica��o
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
     * Ao iniciar a aplica��o sempre passar� por aqui para pegar a partir da requisi��o
     * o que deve ser carregado.
     */
    public function run() {
        /* Inicia ou continua uma se��o */
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
                            generic_application_message("O m�todo de execu��o da aplica��o n�o foi definido!" . '<br>' .
                                                        "Deve-se implementar a classe appinit!", E_USER_ERROR);
                        }                       
                    } 
                }
            }
        }
    }
    
    /*
     * Este m�todo � respons�vel por rodar a aplica��o quando uma requisi��o que solicite uma 
     * rotina e a��o
     * @param string $rotina = C�digo da rotina
     * @param string $acao = C�digo da a��o
     */
    private function runAsForm($rotina, $acao) {
        /* @var $oControle est_class_controller_base */
        $oControle = Factory::formulario($rotina, $acao);
        if($oControle) {
            if($oControle->getMethodAlias()) {
                if(method_exists($oControle, $oControle->getMethodAlias())) {
                    return call_user_func(array($oControle, $oControle->getMethodAlias()));
                } else {
                    throw new EstException('O m�todo ' . $oControle->getMethodAlias() . ' n�o foi encontrado na class ' . $oControle->getClassAlias() . '!');
                }
            }
            
            $oControle->execute();
        } else {
            /* @var est_class_exception_base */
            throw new EstException('Formul�rio n�o encontrado. Rotina: ' . $rotina . ', a��o: ' . $acao);
        }
    }
    
    /*
     * Este m�todo � utilizado para executar a aplica��o a partir de um action solicitado.
     */
    private function runAsAction($action) {
        throw new EstException('Ainda n�o programado');
    }
    
    /*
     * Retorna a int�ncia da se��o. 
     * Ao acionar este m�todo caso uma se��o ainda n�o esteja iniciada ela ser�
     */
    public function getSession() {
       return est_class_session::getInstance();
    }
    
    /*
     * Este m�todo serve apenas para inicializar uma se��o.
     */
    private function initSession() {
       est_class_session::getInstance(); 
    }
    
}

