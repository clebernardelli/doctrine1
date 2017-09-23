<?php

/* 
 * Esta unit implementa as funções genéricas de maneira estruturada do framework.
 * Todas as funções aqui são declaradas com o pré-nome: GENERIC
 */

/*
 * Esta função é utilizada para registrar o handler de erros disparados pela aplicação
 * 
 * @param integer $codigo Código da Mensagem (E_USER_WARNING, E_USER_ERROR, E_USER_NOTICE)
 * @param string $mensagem String de texto da mensagem
 * @param string $arquivo Nome do arquivo que lançou a mensagem (trace)
 * @param integer $linha Número da linha de onde o erro foi lançado
 */
function generic_error_handler($codigo, $mensagem, $arquivo, $linha) {
    
    $mensagem = 'ERRO [' . $mensagem . ']<br>[' . $arquivo . ', linha: ' . $linha . '. Código: ' . $codigo. ']\n';
    
    /* 
     * Poderá no futuro armazenar em log.
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