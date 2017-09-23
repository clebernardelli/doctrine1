<?php

/**
 * A classe est_class_session fará o controle de seção da aplicação
 *
 * @author Cleber Nardelli
 */
class_alias('est_class_session', 'Session');
class est_class_session {
    
    /*
     * @var $instance est_class_session = Instância única de seção
     */
    private static $instance;
    
    /*
     * Armazena o id da seção
     * @var $sessionID string = Id da Seção
     */
    private $sessionID;
    
    /*
     * No contrutor uma seção será inicializada automaticamente
     */
    private function __construct() {
        session_start();
        if(($this->getSessionStarted()) & (session_status() == PHP_SESSION_ACTIVE)) {
           $this->sessionID = $_COOKIE['PHPSESSID']; 
        }
    }

    /*
     * Retorna a instância do session (singleton)
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
     * Este método é responsável por setar algum valor na seção
     * @var $nome string = Nome do valor a ser atribuído na seção
     * @var $valor string = Valor a ser atribuído na seção
     */
    public function setValue($nome, $valor) {
        $_SESSION[$nome] = $valor;
    }
    
    /*
     * Este método servirá para retornar algum valor da seção
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
