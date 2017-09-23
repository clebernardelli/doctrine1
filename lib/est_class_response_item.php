<?php

/**
 * A classe est_class_response_item trata de itens de resposta para o cliente de maneira individualizada.
 * A classe est_class_response é responsável por gerenciar as composições de ítens de response
 *
 * @author Cleber Nardelli
 */
class est_class_response_item {
    
    /*
     * @var $nome string = Nome do ítem de resposta
     */
    private $nome;

    /* 
     * @var $valor string = Valor do ítem de resposta
     */
    private $valor;
    
    function getNome() {
        return $this->nome;
    }

    function getValor() {
        return $this->valor;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    
    function getAsJson() {
        if($this->valor instanceof est_class_response_item) {
            return '"' . $this->nome . '" : "' . $this->valor->getAsJson() . '"';
        } else {
            return '"' . $this->nome . '" : "' . $this->valor . '"';
        }
    }
    
}
