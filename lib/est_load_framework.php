<?php

/* 
 * Os arquivos de inicilaização necessários para o framework devem ser lançados daqui.
 * A ordem das inclusões deve ser respeitada.
 */
require_once $GLOBALS['enderecoFramework'] . '/lib/est_function_autoload.php';
require_once $GLOBALS['enderecoFramework'] . '/lib/est_class_exception_base.php';
require_once $GLOBALS['enderecoFramework'] . '/lib/est_class_doctrice_init.php';
require_once $GLOBALS['enderecoFramework'] . '/lib/est_class_factory.php';
require_once $GLOBALS['enderecoFramework'] . '/lib/est_generic_function.php';
require_once $GLOBALS['enderecoFramework'] . '/lib/est_class_principal.php';

/* @var $oPrincipal est_class_principal*/
global $oPrincipal;
$oPrincipal = principal::getInstance();