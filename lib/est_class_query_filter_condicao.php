<?php

/**
 * Descrição da classe est_class_query_filter_condicao
 *
 * @author Administrador
 */
class est_class_query_filter_condicao {
    
    private $campo;
    private $valor;
    
    function __construct() {
        $this->campo = '';
        $this->valor = '';
    }
    
    function getCampo() {
        return $this->campo;
    }

    function getValor() {
        return $this->valor;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    
    function getQueryDoctrine() {
        return array($this->campo => $this->valor);
    }
    
}
