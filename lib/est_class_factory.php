<?php

/**
 * Implementa o factory de classes padrão para toda a aplicação
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
     * Retorna uma instância de uma classe da pasta lib.
     * O pré-nome das classes deve ser sempre "est_class"
     * 
     * @param $classAlias string = Indica o pós nome da classe.
     */
    static function lib($classAlias) 
    {
        $classFactory = 'est_class_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe ' . $classFactory . ' não foi encontrada!');
        }
    }
    
    /*
     * Este método retornará uma instância de classe da pasta lib/interface (framework)
     * Todas as classes contidas nesta pasta referem-se ao tratamento de interface da aplicação
     * 
     * @param $classAlias string = Nome da Classe, após o est_class_interface.
     */
    static function libInterface($classAlias) {
        $classFactory = 'est_class_interface_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe ' . $classFactory . ' não foi encontrada!');
        }
    }
    
    /*
     * Retorna uma instância de uma classe de modelo.
     * Para este caso deve-se passar o módulo
     * 
     * @param $modulo string = Indica o módulo em questão.
     * @param $classAlias string = Indica o pós nome da classe.
     */
    static function model($modulo, $classAlias) 
    {
        $classFactory = $modulo . '_model_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe modelo ' . $classFactory . ' não foi encontrada!');
        }
        
    }
    
    /*
     * Retorna uma instância de uma classe de view (visão).
     * Para este caso deve-se passar o módulo
     * 
     * @param $modulo string = Indica o módulo em questão.
     * @param $classAlias string = Indica o pós nome da classe.
     */
    static function view($modulo, $classAlias) 
    {
        $classFactory = $modulo . '_view_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory();
        } else {
            throw new EstException('A classe visão ' . $classFactory . ' não foi encontrada!');
        }
        
    }
    
    /*
    * Retorna uma instância de uma classe de controller.
    * Para este caso deve-se passar o módulo
    * 
    * @param $modulo string = Indica o módulo em questão.
    * @param $classAlias string = Indica o pós nome da classe.
    */
    static function controller($modulo, $classAlias) 
    {
        $classFactory = $modulo . '_controller_' . $classAlias;
        if (class_exists($classFactory)) {
            return new $classFactory($modulo, $classAlias);
        } else {
            throw new EstException('A classe controle ' . $classFactory . ' não foi encontrada!');
        }
    }
    
    /*
    * Retorna uma instância de uma classe de controller.
    * Para este caso deve-se passar a rotina e ação a ser executada. A combinação dos
    * dois é o formulário.
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
         * Se foi definido um controller específico para o formulário, então inicia este.
         * Caso contrário vai retornar o controller base.
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
            throw new EstException('A classe ' . $classFactory . ' não foi encontrada!');
        }
    }
    
    /*
     * Método estático que irá devolver uma instância de inicialização da aplicação.
     */
    static function appInit() {
        return new AppInit();
    }

    /*
     * Este método estático serve para carregar e incluir o conteúdo de algum arquivo HTML 
     * existente na camada de aplicação.
     * 
     * @var $html_file string = Nome do arquivo html a ser incluído.
     */
    static function interfaceContents($html_file) {
        $fileName = 'src/interface/' . $html_file;
        if(file_exists($fileName)) {
            return file_get_contents($fileName);
        } else {
            throw new EstException('O arquivo de conteúdo HTML ' . $fileName . ' não existe.');
        }
    }
    
    /*
     * Este método estático serve para devolver uma instância de um elemento de interface
     * 
     * @param $element string = Nome da classe base do elemento.
     */
    static function interfaceElement($element) {
        $classElement = 'est_class_interface_element_' . $element;
        if (class_exists($classElement)) {
            return new $classElement(); 
        } else {
            throw new EstException('A classe ' . $classElement . ' não foi encontrada!');
        }
    }
    
    
    /*
     * Este método devolve uma instância 
     */
    static function css($style) {
        $classCssFactory = 'est_class_interface_factory_css';
        if (class_exists($classCssFactory)) {
            $oclassCssFactory = new $classCssFactory;
            $method_name = 'css_' . $style;
            if(method_exists($oclassCssFactory, $method_name)) {
                return call_user_func($classCssFactory . '::' . $method_name);
            } else {
                throw new EstException('O método ' . $method_name . ' não foi encontrado na class ' . $classCssFactory . '!');
            }
        } else {
            throw new EstException('A classe ' . $classCssFactory . ' não foi encontrada!');
        }        
    }
    
    /*
     * Este método retorna uma constante de interface de acordo com o seu tipo
     * Tipos disponíveis até o momento: html e css
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
                throw new EstException('A constante ' . $constName . ' não foi encontrada no arquivo ' . $fileName . '!');
            }
        } else {
            throw new EstException('O arquivo de constantes ' . $fileName . ' não foi encontrado!');
        }
    }
    
    /*
     * Este método retorna uma constante de modelo de acordo com a classe passada
     * 
     * @param $modulo string = Nome do módulo conforme estrutura de pastas e arquivos
     * @param $class string = Nome da classe conforme definição final (modulo_model) não precisa
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
                throw new EstException('A constante ' . $constName . ' não foi encontrada no arquivo ' . $fileName . '!');
            }
        } else {
            throw new EstException('O arquivo modelo ' . $fileName . ' não foi encontrado!');
        }
    }
}
