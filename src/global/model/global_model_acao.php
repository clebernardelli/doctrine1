<?php

/**
 * Descrição da classe global_model_acao
 *
 * @author Administrador
 * @Entity
 * @Table(name="global.tbacao")
*/
class global_model_acao extends est_class_model_base {
    
   const ACAO_CONFIRMAR = 5;
   const ACAO_CANCELAR = 6;
    
   /**
   * @Id
   * @Column(type="integer", name="acacodigo")
   */
   protected $acacodigo;
   
   /**
   * @Column(type="string", name="acanome")
   */
   protected $acanome;
   
   /**
   * @Column(type="string", name="acamethodname")
   */
   protected $acamethodname;
   
   /*
    * @column(type="smallint", name="acaprivilegio"}
    */
   protected $acaprivilegio;
   
   
   function getAcacodigo() {
       return $this->acacodigo;
   }

   function getAcanome() {
       return $this->acanome;
   }

   function setAcacodigo($acacodigo) {
       $this->acacodigo = $acacodigo;
   }

   function setAcanome($acanome) {
       $this->acanome = $acanome;
   }
   
   function getAcamethodname() {
       return $this->acamethodname;
   }

   function setAcamethodname($acamethodname) {
       $this->acamethodname = $acamethodname;
   }
   
   function getAcaprivilegio() {
       return $this->acaprivilegio;
   }

   function setAcaprivilegio($acaprivilegio) {
       $this->acaprivilegio = $acaprivilegio;
   }

}
