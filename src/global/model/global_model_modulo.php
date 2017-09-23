<?php

/**
 * Descrição da classe global_model_modulo
 *
 * @author Administrador
 * @Entity
 * @Table(name="global.tbmodulo")
*/
class global_model_modulo extends est_class_model_base {
    
    /**
    * @Id
    * @Column(type="integer", name="modcodigo")
    */
    protected $modcodigo;
    
    /**
     * @Column(type="string", name="modnome")
     */
    protected $modnome;
    
    /**
     * @Column(type="string", name="moddescricao")
     */
    protected $moddescricao;
    
    /**
     * @Column(type="string", name="modsigla")
     */
    protected $modsigla;
    
    function getModcodigo() {
        return $this->modcodigo;
    }

    function getModnome() {
        return $this->modnome;
    }

    function getModdescricao() {
        return $this->moddescricao;
    }

    function setModcodigo($modcodigo) {
        $this->modcodigo = $modcodigo;
    }

    function setModnome($modnome) {
        $this->modnome = $modnome;
    }

    function setModdescricao($moddescricao) {
        $this->moddescricao = $moddescricao;
    }
    
    function getModsigla() {
        return $this->modsigla;
    }

    function setModsigla($modsigla) {
        $this->modsigla = $modsigla;
    }

}
