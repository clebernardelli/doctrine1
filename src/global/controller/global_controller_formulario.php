<?php

/**
 * Description of global_controller_formulario
 *
 * @author Administrador
 */
class global_controller_formulario extends est_class_controller_base
{
    
    public function execute() 
    {
        generic_application_message("Chegou no controller formulário.");
        
        /* @var $queryFilter est_class_query_filter */
        $queryFilter = factory::lib('query_filter');
        $queryFilter->addIgual('rotcodigo', $this->getRotina());
        $queryFilter->addIgual('acacodigo', $this->getAcao());
        
        /* @var $oForm global_model_formulario */
        $oForm = est_class_model_base::loadDados('global', 'formulario', $queryFilter);
        
        echo '<br>';
        echo $oForm->getModulo()->getModnome() . '<br>'; 
        echo $oForm->getAcao()->getAcanome() . '<br>';   
        echo $oForm->getRotina()->getRotnome() . '<br>';
        var_dump($this);
    }

}
