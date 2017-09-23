<?php

/**
 * Esta classe implementa um elemento HTML qualquer.
 *
 * @author Administrador
 */
class est_class_interface_element implements est_interface_interface_element {
    
    /* @var $nome string */
    private $nome;
    
    /* @var $properties array */
    private $properties;
    
    /* @var $elementName string*/
    private $elementName;
    
    /* @var $children mixed */
    protected $children; 
    
    public function __construct($nome) {
        $this->nome = $nome;
    }
    
    public function __set($nome, $valor) {
        $this->addProperty($nome, $valor);
    }
    
    public function addProperty($nome, $valor = null) {
        $this->properties[$nome] = $valor;
    }
    
    public function getProperty($nome) {
        if(($this->properties) && (array_key_exists($nome, $this->properties))) {
            return $this->properties[$nome];
        } else {
            return FALSE;
        }
    }
    
    /*
     * M�todo utilizado para adi��o de conte�dos gen�ricos
     */
    public function setConteudo($conteudo) {
        $this->children = array();
        $this->add($conteudo);
    }
    
    /*
     * Adiciona um elemento filho qualquer
     */
    public function add($child) {
        $this->children[] = $child;
    }

    /*
     * O m�todo open exibe a tag de abertura na tela.
     */
    public function open() {
        $result = PHP_EOL . '<' . $this->nome;
        if($this->properties) {
            foreach ($this->properties as $nome => $valor) {
                if($valor) {
                    $result .= ' ' . $nome . '="' . $valor . '"';
                } else {
                    $result .= ' ' . $nome;
                }
            }
        }
        $result .= '>';
        return $result;
    }

    /*
     * O m�todo close exibe a tag de fechamento na tela.
     */
    public function close() {
        return PHP_EOL . '</' . $this->nome . '>';
    }
    
    /*
     * Monta a estrutura necess�ria para exibir o elemento.
     */
    public function show() {
        if ($this->elementName) {
            $this->addProperty('name', $this->elementName);
        }
        $result = $this->open();
        //Se possuir filhos, ent�o tem que percorr�-los e exib�-los tamb�m.
        if($this->children) {
            /* @var $child est_interface_interface_element */
            foreach ($this->children as $child) {
                //Se for um objeto, ent�o chama o seu m�todo show.
                if(is_object($child)) {
                    $result .= $child->show();
                } else if((is_string($child)) || (is_numeric($child))) {
                    $result .= $child;
                }
            }
        }
        //Finalizar a tag
        $result .= $this->close();
        return $result;
    }
    
    /*
     * M�todo que adicionar� um estilo para o elemento HTML
     * @param $style est_class_interface_css 
     */
    public function addCssClass($style) {
        if($this->getProperty('class')) {
           $style = $this->getProperty('class') . ' ' . $style;  
        }
        $this->addProperty('class', $style);
    }
    
    /*
     * M�todo que ir� setar o estilo para o elemento HTML
     * @param $style est_class_interface_css 
     */
    public function setCssClass($style) {
        $this->addProperty('class', $style);
    }
    
    /*
     * Este m�todo define um par�metro de estilo in-line para o elemento.
     * Caso o par�metro j� esteja setado, o mesmo ser� modificado
     * 
     * @param $styleParam string = Nome do par�metro de estilo
     * @param $styleValue string = Valor do par�metro
     */
    public function setStyleParam($styleParam, $styleValue) {
        $value = '';
        if($this->getProperty('style')) {
           $value = $this->getProperty('style') . '; ';    
        }
        $value .= $styleParam . ': ' . $styleValue;
        $this->addProperty('style', $value);
    }
    
    /*
     * Procura e caso encontre retorna um elemento adicionado como filho,
     * a partir do nome da classe de estilo
     * 
     * @param $className string = Nome da classe do elemento para buscar
     */
    public function getElementByClass($className) {
        foreach ($this->children as $child) {
            /* @var $child est_class_interface_element */
            if(is_object($child)) {
                if(strpos($child->getProperty('class'), $className) > -1) {
                    return $child;
                }                
            }            
        }        
        return null;
    }
    
    public function setEvent($eventName, $callBackFunction, $scriptFunction = null) {
        $this->addProperty($eventName, $callBackFunction);
        if($scriptFunction) {
           $this->addScript($scriptFunction);
        } 
    }
    
    public function addScript($scriptFunction) {
        $scriptTag = new est_class_interface_element('script');
        $scriptTag->addProperty('type', 'text/javascript');
        $scriptTag->add($scriptFunction);
        $this->add($scriptTag);
    }
    
    function getElementName() {
        return $this->elementName;
    }

    function setElementName($elementName) {
        $this->elementName = $elementName;
    }
   

}
