<?php

/**
 * Interface de qualquer elemento HTML para ser desenvolvido
 * 
 * @author Administrador
 */
interface est_interface_interface_element {
    
    public function add($child);
    public function open();
    public function close();
    public function show(); 
    
}
