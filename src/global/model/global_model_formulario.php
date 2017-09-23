<?php

/**
 * Description of global_model_formulario
 *
 * @author Administrador
 * @Entity
 * @Table(name="global.tbformulario")
 */
class global_model_formulario extends est_class_model_base
{
    
    /**
    * @Id
    * @Column(type="integer", name="rotcodigo")
    */
    protected $rotcodigo;
    
    /**
    * @Id
    * @Column(type="integer", name="acacodigo")
    */
    protected $acacodigo;
    
    /**
    * @Column(type="string", name="frmnome")
    */
    protected $frmnome;

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
    
    /**
     * @var global_model_rotina $rotina;
     * @ManyToOne(targetEntity="global_model_rotina")
     * @JoinColumn(name="rotcodigo", referencedColumnName="rotcodigo")
    **/
    protected $rotina;
 
    /**
     * @var global_model_acao $acao;
     * @ManyToOne(targetEntity="global_model_acao")
     * @JoinColumn(name="acacodigo", referencedColumnName="acacodigo")
    **/
    protected $acao;
    
    /**
     * @Column(type="string", name="frmclassbase")
     */
    protected $frmclassbase;

    /**
     * @Column(type="smallint", name="frmincludecontroller")
     */
    protected $frmincludecontroller;


    function getRotcodigo() {
        return $this->rotcodigo;
    }

    function getAcacodigo() {
        return $this->acacodigo;
    }

    function getFrmnome() {
        return $this->frmnome;
    }

    function getModcodigo() {
        return $this->modcodigo;
    }

    function setRotcodigo($rotcodigo) {
        $this->rotcodigo = $rotcodigo;
    }

    function setAcacodigo($acacodigo) {
        $this->acacodigo = $acacodigo;
    }

    function setFrmnome($frmnome) {
        $this->frmnome = $frmnome;
    }

    function setModcodigo($modcodigo) {
        $this->modcodigo = $modcodigo;
    }

    function getFrmclassbase() {
        return $this->frmclassbase;
    }

    function getFrmincludecontroller() {
        return $this->frmincludecontroller;
    }

    function setFrmclassbase($frmclassbase) {
        $this->frmclassbase = $frmclassbase;
    }

    function setFrmincludecontroller($frmincludecontroller) {
        $this->frmincludecontroller = $frmincludecontroller;
    }

    function getModulo() {
        return $this->modulo;
    }
    
    function getRotina() {
        return $this->rotina;
    }

    function getAcao() {
        return $this->acao;
    }

}
