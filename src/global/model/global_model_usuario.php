<?php

/**
 * Descrição da classe global_model_usuario
 *
 * @author Cleber Nardelli
 * @Entity
 * @Table(name="global.tbusuario")
 */
class global_model_usuario extends est_class_model_base {
    
    /**
    * @Id
    * @Column(type="integer", name="usucodigo")
    */
    protected $usucodigo;
    
    /**
    * @Column(type="string", name="usunome")
    */
    protected $usunome;
    
    /**
    * @Id
    * @Column(type="string", name="usulogin")
    */
    protected $usulogin;
    
    /**
    * @Column(type="string", name="ususenha")
    */
    protected $ususenha;
    
    function getUsucodigo() {
        return $this->usucodigo;
    }

    function getUsunome() {
        return $this->usunome;
    }

    function getUsulogin() {
        return $this->usulogin;
    }

    function getUsusenha() {
        return $this->ususenha;
    }

    function setUsucodigo($usucodigo) {
        $this->usucodigo = $usucodigo;
    }

    function setUsunome($usunome) {
        $this->usunome = $usunome;
    }

    function setUsulogin($usulogin) {
        $this->usulogin = $usulogin;
    }

    function setUsusenha($ususenha) {
        $this->ususenha = $ususenha;
    }

}
