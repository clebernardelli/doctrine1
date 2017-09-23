<?php

/**
 * Description of persistencia_pessoa
 *
 * @author Administrador
 * @Entity
 * @Table(name="unico.tbpessoa")
 */
class unico_model_pessoa extends est_model_base 
{

    /**
     * @Id
     * @GeneratedValue(strategy="AUTO")
     * @Column(type="integer", name="pescodigo")
     */
    protected $codigo;
    
    /**
     * @Column(type="string", name="pesnome")
     */
    protected $nome;
    
    /**
     * @Column(type="string", name="pescpfcnpj")
     */
    protected $cpfcnpj;
    
    /**
     * @Column(type="smallint", name="pestipo")
     */
    protected $tipo;

    function getCodigo() 
    {
        return $this->codigo;
    }

    function getNome() 
    {
        return $this->nome;
    }

    function getCpfcnpj() 
    {
        return $this->cpfcnpj;
    }

    function getTipo() 
    {
        return $this->tipo;
    }

    function setNome($nome) 
    {
        $this->nome = $nome;
    }

    function setCpfcnpj($cpfcnpj) 
    {
        $this->cpfcnpj = $cpfcnpj;
    }

    function setTipo($tipo) 
    {
        $this->tipo = $tipo;
    }


    
}
