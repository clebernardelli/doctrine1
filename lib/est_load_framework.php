<?php

/* 
 * Os arquivos de inicilaiza��o necess�rios para o framework devem ser lan�ados daqui.
 * A ordem das inclus�es deve ser respeitada.
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