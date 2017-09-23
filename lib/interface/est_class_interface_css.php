<?php

/**
 * Classe utilizada na definição de uma estrutura de estilos CSS
 *
 * @author Cleber Nardelli
 */
class est_class_interface_css implements est_interface_interface_css {
    
    /*
     * @var $nome string = Nome do estilo
     */
    private $nome;
    
    /*
     * @var $properties array = Propriedades do estilo 
     */
    private $properties;
    
    /*
     * @var $inherited array = Array de heranças que o estilo deve ter
     */
    private $inherited;
    
    /*
     * @var $selectors array = Array de selectors do estilo;
     */
    private $selectors;
    
    /*
     * @var $loaded array = array de estilos carregados 
     */
    static private $loaded;
    
    public function __construct($nome) {
        $this->nome = $nome;
        $this->inherited = array();
        $this->selectors = array();
    }

    public function __set($nome, $valor) {
        $this->addProperty($nome, $valor);
    }

    public function addProperty($nome, $valor) {
        $nome = str_replace('_', '-', $nome);
        $this->properties[$nome] = $valor;
    }
    
    public function addPropertySelector($selector, $property, $valor) {
        $oSelector = array_search($selector, $this->selectors);
        if(!$oSelector) {
           $oSelector = new est_class_interface_css($this->nome . $selector);
           array_push($this->selectors, $oSelector);
        }
        $oSelector->addProperty($property, $valor);
    }
    
    public function addInherited($nome) {
        array_push($this->inherited, $nome);
    }

    public function show($bForCssFile = FALSE) {
        $result = '';
        if((!$bForCssFile) && ((!self::$loaded) || (!array_key_exists($this->nome, self::$loaded)))) {
            $result = "<style type='text/css' media='screen'>" . PHP_EOL;
        }
        $heranca = FALSE;
        if($this->inherited) {
            foreach ($this->inherited as $value) {
                $heranca .= ".{$value}";
            }
        }
        $result .= '.' . $this->nome . " {$heranca}{" . PHP_EOL;
        //Se tem propriedades, então deve exibí-las.
        if($this->properties) {
            foreach ($this->properties as $key => $value) {
                $result .= "\t {$key}: {$value};" . PHP_EOL;                       
            }
        }
        $result .= "}" . PHP_EOL;
        if(!$bForCssFile) {
            $result .= "</style>" . PHP_EOL;
        }
        //Agora definí-lo como já carregado
        self::$loaded[$this->nome] = TRUE;
        
        //Montar a lista de seletores específicos do estilo
        /* @var $oSelector est_class_interface_css */
        foreach ($this->selectors as $oSelector) {
            $result .= $oSelector->show($bForCssFile);
        }
        
        return $result;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function loaded() {
        if((self::$loaded) && (array_key_exists($this->nome, self::$loaded))) {
            return self::$loaded[$this->nome]; 
        } else {
            return FALSE;
        }
        
    }

}
