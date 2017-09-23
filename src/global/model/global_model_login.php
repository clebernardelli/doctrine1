<?php

/**
 * Classe global_model_login respons�vel pelas valida��es de login
 *
 * @author Cleber Nardelli
 */
class global_model_login {
    
    /*
     * @var $usulogin string = Login do usu�rio
     */
    private $usulogin;
    
    /*
     * @var $ususenha string = Senha do usu�rio em formato MD5
     */
    private $ususenha;
    
    /*
     * @var $oUsuarioModel global_model_usuario 
     */
    private $oUsuarioModel;
    
    function getUsulogin() {
        return $this->usulogin;
    }

    function getUsusenha() {
        return $this->ususenha;
    }

    function setUsulogin($usulogin) {
        $this->usulogin = $usulogin;
    }

    function setUsusenha($ususenha) {
        $this->ususenha = $ususenha;
    }

    /*
     * M�todo para fazer a valida��o da senha do usu�rio
     */
    private function validaSenha() {
        /* @var $oUsuarioModel global_model_usuario */
        $this->oUsuarioModel = Model::loadDadosBy('global', 'usuario', array('usulogin' => $this->getUsuLogin()));
        if($this->oUsuarioModel) {
            return $this->oUsuarioModel->getUsusenha() == $this->getUsusenha();
        }
        return false;
    }
    
    /*
     * M�todo para fazer a valida��o do login do usu�rio
     */
    function validaLogin() {
        if ($this->validaSenha()) {
            /* iniciar a se��o do usu�rio e armazenar o objeto modelo do login*/
            Principal::getInstance()->getSession()->addObject('model_login', $this);               
            
            return true;
        } else {
            throw new EstException('Usu�rio ou senha inv�lida!');
        }
    }
    
    function getOUsuarioModel() {
        return $this->oUsuarioModel;
    }

}
