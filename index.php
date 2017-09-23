<?php
/*
 * Este index é padrão, nada precisa ser alterado nele para que a aplicação funcione.
 * 
 * Inicializar o framwork.
 */
$GLOBALS['enderecoFramework'] = __DIR__;
require_once $GLOBALS['enderecoFramework'] . '/lib/est_load_framework.php';

/*
 * Inicializar a aplicação. 
 */
/* @var $oPrincipal est_class_principal */
$oPrincipal->run();