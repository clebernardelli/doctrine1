<?php

/**
 * A interface a seguir � respons�vel por definir o comportamento de manipula��o 
 * de estilos
 * 
 * @author Administrador
 */
interface est_interface_interface_css {
    
    public function show();
    /* 
     * @param $nome string = Nome da propriedade do estilo CSS
     * @param $valor string = Valor da propriedade do estilo CSS
     */
    public function addProperty($nome, $valor);
}
