<?php
/*
 * Nуo faz parte do framework ou da aplicaчуo, apenas utilizado para documentaчуo.
 */
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

return ConsoleRunner::createHelperSet(Boostrap::getEntityManagerInstance());