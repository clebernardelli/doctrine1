<?php
/*
 * N�o faz parte do framework ou da aplica��o, apenas utilizado para documenta��o.
 */
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

return ConsoleRunner::createHelperSet(Boostrap::getEntityManagerInstance());