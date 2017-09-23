<?php

/**
 * Implementa o factory de classes padr�o para toda a aplica��o
 *
 * @author Cleber Nardelli
 */
class_alias('est_class_factory', 'factory');
class est_class_factory 
{
    
    /*
     * @var est_class_factory
     */
    private $instance;
    
    /*
     * Retorna uma inst�ncia de uma classe da pasta lib.
     * O pr�-nome das classes deve ser sempre "est_class"
     * 
     * @param $classAlias string = Indica o p�s nome da classe.
     */
    static function lib($classAlias) 
    {
        $classFactory = 'est_class_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe ' . $classFactory . ' n�o foi encontrada!');
        }
    }
    
    /*
     * Este m�todo retornar� uma inst�ncia de classe da pasta lib/interface (framework)
     * Todas as classes contidas nesta pasta referem-se ao tratamento de interface da aplica��o
     * 
     * @param $classAlias string = Nome da Classe, ap�s o est_class_interface.
     */
    static function libInterface($classAlias) {
        $classFactory = 'est_class_interface_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe ' . $classFactory . ' n�o foi encontrada!');
        }
    }
    
    /*
     * Retorna uma inst�ncia de uma classe de modelo.
     * Para este caso deve-se passar o m�dulo
     * 
     * @param $modulo string = Indica o m�dulo em quest�o.
     * @param $classAlias string = Indica o p�s nome da classe.
     */
    static function model($modulo, $classAlias) 
    {
        $classFactory = $modulo . '_model_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe modelo ' . $classFactory . ' n�o foi encontrada!');
        }
        
    }
    
    /*
     * Retorna uma inst�ncia de uma classe de view (vis�o).
     * Para este caso deve-se passar o m�dulo
     * 
     * @param $modulo string = Indica o m�dulo em quest�o.
     * @param $classAlias string = Indica o p�s nome da classe.
     */
    static function view($modulo, $classAlias) 
    {
        $classFactory = $modulo . '_view_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe vis�o ' . $classFactory . ' n�o foi encontrada!');
        }
        
    }
    
    /*
    * Retorna uma inst�ncia de uma classe de controller.
    * Para este caso deve-se passar o m�dulo
    * 
    * @param $modulo string = Indica o m�dulo em quest�o.
    * @param $classAlias string = Indica o p�s nome da classe.
    */
    static function controller($modulo, $classAlias) 
    {
        $classFactory = $modulo . '_controller_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory($modulo, $classAlias);
        } else {
            throw new EstException('A classe controle ' . $classFactory . ' n�o foi encontrada!');
        }
    }
    
    /*
    * Retorna uma inst�ncia de uma classe de controller.
    * Para este caso deve-se passar a rotina e a��o a ser executada. A combina��o dos
    * dois � o formul�rio.
    * 
    * @param $rotina string = Indica a rotina.
    * @param $acao string = Indica a rotina.
    */
    static function formulario($rotina, $acao) 
    {
        /* 
         * Criar o filtro a ser aplicado para carregar os dados
         * @var $queryFilter est_class_query_filter 
         */
        $queryFilter = Factory::lib('query_filter');
        $queryFilter->addIgual('rotcodigo', $rotina);
        $queryFilter->addIgual('acacodigo', $acao);        
        
        /* @var $oFormularioModel global_model_formulario */
        $oFormularioModel = est_class_model_base::loadDados('global', 'formulario', $queryFilter);
        
        /*
         * Se foi definido um controller espec�fico para o formul�rio, ent�o inicia este.
         * Caso contr�rio vai retornar o controller base.
         */
        if(($oFormularioModel) && ($oFormularioModel->getFrmclassbase())) { 
            $classFactory = $oFormularioModel->getModulo()->getmodsigla() . '_controller_' . $oFormularioModel->getFrmclassbase();
        } else {
            $classFactory = 'lib/est_class_controller_generic.php'; 
        }
        if (class_exists($classFactory)) {
            /* @var $oController est_class_controller_base */
            $oController = new $classFactory($oFormularioModel->getModulo()->getmodsigla(), $oFormularioModel->getFrmclassbase());
            $oController->setAcao($acao);
            $oController->setRotina($rotina);
            $oController->setMethodAlias($oFormularioModel->getAcao()->getAcamethodname());
            $oController->setModulo(strtolower($oFormularioModel->getModulo()->getmodnome()));

            return $oController;
        } else {
            throw new EstException('A classe ' . $classFactory . ' n�o foi encontrada!');
        }
    }
    
    /*
     * M�todo est�tico que ir� devolver uma inst�ncia de inicializa��o da aplica��o.
     */
    static function appInit() {
        return new AppInit();
    }

    /*
     * Este m�todo est�tico serve para carregar e incluir o conte�do de algum arquivo HTML 
     * existente na camada de aplica��o.
     * 
     * @var $html_file string = Nome do arquivo html a ser inclu�do.
     */
    static function interfaceContents($html_file) {
        $fileName = 'src/interface/' . $html_file;
        if(file_exists($fileName)) {
            return file_get_contents($fileName);
        } else {
            throw new EstException('O arquivo de conte�do HTML ' . $fileName . ' n�o existe.');
        }
    }
    
    /*
     * Este m�todo est�tico serve para devolver uma inst�ncia de um elemento de interface
     * 
     * @param $element string = Nome da classe base do elemento.
     */
    static function interfaceElement($element) {
        $classElement = 'est_class_interface_element_' . $element;
        if (class_exists($classElement)) {
            return new $classElement(); 
        } else {
            throw new EstException('A classe ' . $classElement . ' n�o foi encontrada!');
        }
    }
    
    
    /*
     * Este m�todo devolve uma inst�ncia 
     */
    static function css($style) {
        $classCssFactory = 'est_class_interface_factory_css';
        if (class_exists($classCssFactory)) {
            $oclassCssFactory = new $classCssFactory;
            $method_name = 'css_' . $style;
            if(method_exists($oclassCssFactory, $method_name)) {
                return call_user_func($classCssFactory . '::' . $method_name);
            } else {
                throw new EstException('O m�todo ' . $method_name . ' n�o foi encontrado na class ' . $classCssFactory . '!');
            }
        } else {
            throw new EstException('A classe ' . $classCssFactory . ' n�o foi encontrada!');
        }        
    }
    
    /*
     * Este m�todo retorna uma constante de interface de acordo com o seu tipo
     * Tipos dispon�veis at� o momento: html e css
     * 
     * @param $tipo string = Tipo da constante de interface
     * @param $constName string = Nome da constante.
     */
    static function interfaceConst($tipo, $constName) {
        $fileName = 'lib/interface/est_const_interface_' . $tipo . '.php';
        if(file_exists($fileName)) { 
            require_once($fileName);
            if(defined($constName)) {
                return constant($constName);
            } else {
                throw new EstException('A constante ' . $constName . ' n�o foi encontrada no arquivo ' . $fileName . '!');
            }
        } else {
            throw new EstException('O arquivo de constantes ' . $fileName . ' n�o foi encontrado!');
        }
    }
    
    /*
     * Este m�todo retorna uma constante de modelo de acordo com a classe passada
     * 
     * @param $modulo string = Nome do m�dulo conforme estrutura de pastas e arquivos
     * @param $class string = Nome da classe conforme defini��o final (modulo_model) n�o precisa
     * @param $constName string = Nome da constante a ser localizada.
     */
    static function modelConst($modulo, $classe, $constName) {
        $fileName = 'src/' . $modulo . '/model/' . $modulo . '_model_' . $classe . '.php';
        if(file_exists($fileName)) { 
            require_once($fileName);
            $constName = $modulo . '_model_' . $classe . '::' . $constName;            
            if(constant($constName)) {
                return constant($constName);
            } else {
                throw new EstException('A constante ' . $constName . ' n�o foi encontrada no arquivo ' . $fileName . '!');
            }
        } else {
            throw new EstException('O arquivo modelo ' . $fileName . ' n�o foi encontrado!');
        }
    }
}
