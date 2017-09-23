<?php

/**
 * Esta classe implementa um conjunto de funcionalidades para criar critérios de seleção
 * de dados.
 *
 * @author Administrador
 */
class est_class_query_filter {

   /* @var array $ListaCondicoes (est_class_query_filter_condicao) */
   private $ListaCondicoes;
   
   function __construct() {
       $this->ListaCondicoes = array();
   }

   /*
    * Este método adiciona uma condição de igualdade de valores na query filter atual.
    * 
    * @param $campo string
    * @param $valor string
    */
   public function addIgual($campo, $valor) {
      $oCondicao = Factory::lib('query_filter_condicao'); 
      $oCondicao->setCampo($campo);
      $oCondicao->setValor($valor);
      $this->ListaCondicoes[] = $oCondicao; 
   }
   
   /*
    * Este método retorna o filtro a ser adicionado na pesquisa quando utilizado
    * o método find() do doctrine
    * 
    * @return array
    */
   public function getQueryDoctrine() {
       $result = array();
       foreach ($this->ListaCondicoes as $condicao) {
          /* @var array $condicao */
          $result = array_merge($result, $condicao->getQueryDoctrine()); 
       }
       return $result;
   }
    
}
