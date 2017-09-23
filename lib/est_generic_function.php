<?php

/* 
 * Esta unit implementa as fun��es gen�ricas de maneira estruturada do framework.
 * Todas as fun��es aqui s�o declaradas com o pr�-nome: GENERIC
 */

/*
 * Esta fun��o � utilizada para registrar o handler de erros disparados pela aplica��o
 * 
 * @param integer $codigo C�digo da Mensagem (E_USER_WARNING, E_USER_ERROR, E_USER_NOTICE)
 * @param string $mensagem String de texto da mensagem
 * @param string $arquivo Nome do arquivo que lan�ou a mensagem (trace)
 * @param integer $linha N�mero da linha de onde o erro foi lan�ado
 */
function generic_error_handler($codigo, $mensagem, $arquivo, $linha) {
    
    $mensagem = 'ERRO [' . $mensagem . ']<br>[' . $arquivo . ', linha: ' . $linha . '. C�digo: ' . $codigo. ']\n';
    
    /* 
     * Poder� no futuro armazenar em log.
     */
    $logHandle = fopen('erros.log', 'a');
    fwrite($logHandle, $mensagem);
    fclose($logHandle);
    
    /*
     * Se for uma warning, joga pra cima.
     */
    if(($codigo == E_USER_WARNING) || ($codigo == E_USER_NOTICE)) {
        echo $mensagem;
    }
    else if ($codigo == E_USER_ERROR) {
        echo $mensagem;
        die;
    } else {
        echo $mensagem;
        die;
    }
}
set_error_handler('generic_error_handler');

function generic_application_message($mensagem, $tipoMensagem = E_USER_NOTICE) {
    
    trigger_error($mensagem, $tipoMensagem);
    
}

function getBasePath($file) {
    return substr(str_replace('\\', '/', realpath(dirname($file))), strlen(str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']))));
}

function getUrl() {
    return $_SERVER['REQUEST_URI'];
}