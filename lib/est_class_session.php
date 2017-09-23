<?php

/**
 * A classe est_class_session far� o controle de se��o da aplica��o
 *
 * @author Cleber Nardelli
 */
class_alias('est_class_session', 'Session');
class est_class_session {
    
    /*
     * @var $instance est_class_session = Inst�ncia �nica de se��o
     */
    private static $instance;
    
    /*
     * Armazena o id da se��o
     * @var $sessionID string = Id da Se��o
     */
    private $sessionID;
    
    /*
     * No contrutor uma se��o ser� inicializada automaticamente
     */
    private function __construct() {
        session_start();
        if(($this->getSessionStarted()) & (session_status() == PHP_SESSION_ACTIVE)) {
           $this->sessionID = $_COOKIE['PHPSESSID']; 
        }
    }

    /*
     * Retorna a inst�ncia do session (singleton)
     * @return est_class_session
     */
    static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new est_class_session(); 
        }
        return self::$instance;
    }
    
    public static function getSessionStarted() {
        return isset($_COOKIE['PHPSESSID']);
    }    
    
    public function finalizeSession() {
        session_unset();
        session_write_close();
    }
            
    /*
     * Este m�todo � respons�vel por setar algum valor na se��o
     * @var $nome string = Nome do valor a ser atribu�do na se��o
     * @var $valor string = Valor a ser atribu�do na se��o
     */
    public function setValue($nome, $valor) {
        $_SESSION[$nome] = $valor;
    }
    
    /*
     * Este m�todo servir� para retornar algum valor da se��o
     * @var $nome string = Nome do valor a ser retornado.
     */
    public function getValue($nome) {
        if(isset($_SESSION[$nome])) {
            return $_SESSION[$nome];
        }
    }
    
    function getSessionID() {
        return $this->sessionID;
    }
    
    /*
     * @var $nome string = Nome do valor
     * @var $oObject stdClass = Objeto a ser serializado
     */
    public function addObject($nome, $oObject) {
        if(!$this->getValue($nome)) {
            $this->setValue($nome, serialize($oObject));
        }
    }
    
    /*
     * @return stdClass
     */
    public function getObject($nome) {
        return unserialize(getValue($nome));
    }
    
}
