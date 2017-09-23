<?php

/**
 * Classe usada para recuperar e adicionar informaчѕes
 * dentro da variсvel $_REQUEST. Щ apenas um facilitador
 * para evitar a reescrita de cѓdigos de verificaчуo isset.
 *
 * @author Cleber Nardelli
 */
class est_class_request {

    function __construct() {
        class_alias('est_class_request', 'request');
    }

    /**
     *
     *  Mщtodo estсtico usado para recuperar uma informaчуo de dentro da variсvel $_GET. Ele verifica se a
     *  chave existe no array. Caso exista, retorna o valor da variсvel. Se nуo existir, retorna uma string vazia.
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
     *  Mщtodo estсtico usado para recuperar uma informaчуo de dentro da variсvel $_POST. Ele verifica se a
     *  chave existe no array. Caso exista, retorna o valor da variсvel. Se nуo existir, retorna uma string vazia.
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
     *  Mщtodo usado para adicionar um valor numa chave da variсvel $_REQUEST, independente da variсvel
     *  existir ou nуo.
     * 
     *  @param string $key
     *  @param mixed $val
     *  @return void
     */
    public static function set($key, $val) {
        $_REQUEST[$key] = $val;
    }
    
}
