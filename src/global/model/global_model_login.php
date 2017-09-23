<?php

/**
 * Classe global_model_login responsável pelas validações de login
 *
 * @author Cleber Nardelli
 */
class global_model_login {
    
    /*
     * @var $usulogin string = Login do usuário
     */
    private $usulogin;
    
    /*
     * @var $ususenha string = Senha do usuário em formato MD5
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
     * Método para fazer a validação da senha do usuário
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
     * Método para fazer a validação do login do usuário
     */
    function validaLogin() {
        if ($this->validaSenha()) {
            /* iniciar a seção do usuário e armazenar o objeto modelo do login*/
            Principal::getInstance()->getSession()->addObject('model_login', $this);               
            
            return true;
        } else {
            throw new EstException('Usuário ou senha inválida!');
        }
    }
    
    function getOUsuarioModel() {
        return $this->oUsuarioModel;
    }

}
