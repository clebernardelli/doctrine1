<?php

/**
 * Implementa a classe base de modelos
 *
 * @author Administrador
 */
class_alias('est_class_model_base', 'Model');
abstract class est_class_model_base {
    
    /**
     * @param est_class_query_filter $queryFilter
     */
    static public function loadDados($sModulo, $sClassAlias, $queryFilter) {

       /* @var est_class_doctrine_init Doctrine */
       return Doctrine::getEntityManagerInstance()->find($sModulo . '_model_' . $sClassAlias, $queryFilter->getQueryDoctrine());
    }
    
    /*
     * Este método retonará uma instância de modelo da entidade passada através do array de filtros
     * @param $sModulo String = Módulo
     * @param $sClassAlias String = Alias da classe
     * @param $aFilter array = Lista de campos para filtro.
     */
    static public function loadDadosBy($sModulo, $sClassAlias, $aFilter) {

       /* @var Doctrine::getEntityManagerInstance() \Doctrine\ORM\EntityManager */
       return Doctrine::getEntityManagerInstance()->getRepository($sModulo . '_model_' . $sClassAlias)->findOneBy($aFilter);
    }
    
}
