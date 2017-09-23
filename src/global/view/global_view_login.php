<?php

/**
 * Classe global_view_login, define a tela de login principal da aplicação
 *
 * @author Cleber Nardelli
 */
class global_view_login extends est_class_view_manutencao_base 
{
    
    public function montaTelaManutencao() {
        $this->setRotina(6);
        $this->setTitle('Login');
        
        /* @var $object est_class_interface_element_edit_label */
        $object = $this->addCampo('Login', 'usulogin', true);
        $object->setHint('Login do usuário');
        
        /* @var $object est_class_interface_element_edit_label */
        $object = $this->addCampoSenha('Senha', 'ususenha', 12, 6);
        $object->setHint('Senha do usuário');
        $object->onGetValue('ususenhaGetValue', $this->getususenhaGetValueScript());
        
        return $this->enviaTela(); 
    }
    
    private function getususenhaGetValueScript() {

        return "function ususenhaGetValue(Sender) {
                    return MD5($(Sender).val());
                }"; 
        
    }
}