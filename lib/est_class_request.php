<?php

/**
 * Classe usada para recuperar e adicionar informa��es
 * dentro da vari�vel $_REQUEST. � apenas um facilitador
 * para evitar a reescrita de c�digos de verifica��o isset.
 *
 * @author Cleber Nardelli
 */
class est_class_request {

    function __construct() {
        class_alias('est_class_request', 'request');
    }

    /**
     *
     *  M�todo est�tico usado para recuperar uma informa��o de dentro da vari�vel $_GET. Ele verifica se a
     *  chave existe no array. Caso exista, retorna o valor da vari�vel. Se n�o existir, retorna uma string vazia.
     *
     *  @param string $key
     *  @return string
     */
    public static function get($key) {
 
        if (isset($_GET[$key]) && ($_GET[$key] != '')) {
            return $_GET[$key];
        }
        else {
            return '';
        }
 
    }
 
    /**
     *
     *  M�todo est�tico usado para recuperar uma informa��o de dentro da vari�vel $_POST. Ele verifica se a
     *  chave existe no array. Caso exista, retorna o valor da vari�vel. Se n�o existir, retorna uma string vazia.
     *
     *  @param string $key
     *  @return string
     */
    public static function post($key) {
 
        if (isset($_POST[$key]) && ($_POST[$key] != '')) {
            return $_POST[$key];
        }
        else {
            return '';
        }
 
    }

    /**
     *
     *  M�todo usado para adicionar um valor numa chave da vari�vel $_REQUEST, independente da vari�vel
     *  existir ou n�o.
     * 
     *  @param string $key
     *  @param mixed $val
     *  @return void
     */
    public static function set($key, $val) {
        $_REQUEST[$key] = $val;
    }
    
}
