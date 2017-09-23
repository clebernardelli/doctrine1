<?php

/**
 * A classe est_class_response é responsável por organziar as respostas que serão enviadas 
 * para o cliente. 
 * O envio de respostas é feito utilizando-se o padrão de estrutura de dados JSON.
 *
 * @author Cleber Nardelli
 */
class est_class_response {
    
    /*
     * @var $aItens Array() = Lista de itens para envio.
     */
    private $aItens;
    
    function __construct() {
       $this->aItens = Array(); 
    }
    
    public function addItem($nome, $valor) {
        /* 
         * @var $result est_class_response_item 
         */
        $result = Factory::lib('response_item');
        $result->setNome($nome);
        $result->setValor($valor);
        array_push($this->aItens, $result);
                
        return $result;
    }
    
    private function getAsJson() {
        /* 
         * @var $value est_class_response_item
         */
        $result = '';
        foreach ($this->aItens as $value) {
            $result .= $value->getAsJson() . ',';
        }
        $result = '{' . substr($result, 0, strlen($result)-1) . '}';
        return $result;
    }
    
    public function sendResponse() {
        
        echo $this->getAsJson();
        
    }
     
}
