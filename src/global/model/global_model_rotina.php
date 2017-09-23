<?php

/**
 * Descrição da classe global_model_rotina
 *
 * @author Cleber Nardelli
 * @Entity
 * @Table(name="global.tbrotina")
*/
class global_model_rotina extends est_class_model_base {
    
    /**
    * @Id
    * @Column(type="integer", name="rotcodigo")
    */
    protected $rotcodigo;
    
    /**
    * @Column(type="string", name="rotnome")
    */
    protected $rotnome;
    
    /**
    * @Column(type="string", name="rotdescricao")
    */
    protected $rotdescricao;
   
    /**
    * @Column(type="string", name="modcodigo")
    */
    protected $modcodigo;
    
    /**
     * @var global_model_modulo $modulo_instance;
     * @ManyToOne(targetEntity="global_model_modulo")
     * @JoinColumn(name="modcodigo", referencedColumnName="modcodigo")
    **/
    protected $modulo;
   
    
    function getRotcodigo() {
        return $this->rotcodigo;
    }

    function getRotnome() {
        return $this->rotnome;
    }

    function getRotdescricao() {
        return $this->rotdescricao;
    }

    function getModcodigo() {
        return $this->modcodigo;
    }

    function getModulo() {
        return $this->modulo;
    }

    function setRotcodigo($rotcodigo) {
        $this->rotcodigo = $rotcodigo;
    }

    function setRotnome($rotnome) {
        $this->rotnome = $rotnome;
    }

    function setRotdescricao($rotdescricao) {
        $this->rotdescricao = $rotdescricao;
    }

    function setModcodigo($modcodigo) {
        $this->modcodigo = $modcodigo;
    }

    function setModulo(global_model_modulo $modulo) {
        $this->modulo = $modulo;
    }
    
}
