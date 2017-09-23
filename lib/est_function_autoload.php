<?php
/* 
 * Implementa o autoload padr�o da aplica��o.
 * Padr�o PSR-0
 */
function autoload($className) {
    
    $className = ltrim($className, '\\');
    /*
     * Lib � a pasta da estrutura 
     * Se possuir est no nome ent�o
     */    
    if(substr($className, 0, 4) == 'est_') {
        $fileName = $GLOBALS['enderecoFramework'] . '/lib' . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($fileName)) {
           require_once $fileName;
        } else {
            $fileName = 'lib/interface' . DIRECTORY_SEPARATOR . $className . '.php';
            if (file_exists($fileName)) {
               require_once $fileName;
            } else {
               /* @var est_class_exception_base EstException */ 
               throw new EstException('O arquivo de estrutura ' . $fileName . ' n�o foi encontrado para carregar!');
            }   
        }        
    } else {
       /*
       * Src � a pasta dos m�dulos e demais classes da aplica��o.
       */ 
       $aclassName = str_getcsv($className, '_');
       $path = '';
       for ($index = 0; $index < (count($aclassName)-1); $index++) {
           $path .= $aclassName[$index] . DIRECTORY_SEPARATOR;
       }

       $fileName = 'src' . DIRECTORY_SEPARATOR . $path . $className . '.php';
       if (file_exists($fileName)) {
          require_once $fileName;
       } else {
          if((strtolower($className) == 'appInit') && (file_exists('src/appinit.php'))) {
             require_once('src/appinit.php');  
          } else           
          if(strpos($className, '.') > 0) {
             autoload_orm_class($className);              
          } else {            
             /* @var est_class_exception_base EstException */ 
             if(!isset($GLOBALS['unittest'])) {
                throw new EstException('O arquivo ' . $fileName . ' n�o foi encontrado para carregar!');                 
             }
          }
       }
    }    
    
}

function autoload_orm_class($className) {
    
    $aClassName = explode('.', $className);
    $sModulo = $aClassName[0];
    $sEntidade = substr($aClassName[1], 2, strlen($aClassName[1]));
    
    $aClassName = $sModulo . '_model_' . $sEntidade;
    return class_exists($aClassName);
    
}

spl_autoload_register('autoload');