<?php
/*
 * Este index � padr�o, nada precisa ser alterado nele para que a aplica��o funcione.
 * 
 * Inicializar o framwork.
 */
$GLOBALS['enderecoFramework'] = __DIR__ . '/..';
$GLOBALS['unittest'] = TRUE;

require_once $GLOBALS['enderecoFramework'] . '/lib/est_generic_function.php';
require_once $GLOBALS['enderecoFramework'] . '/lib/est_load_framework.php';

/*
 * Inicializar a aplica��o. 
 */
/* @var $oPrincipal est_class_principal */
$oPrincipal->run();
