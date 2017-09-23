<?php

/**
 * Esta classe tem o objetivo de server como construtora de estilos padrão que podem ser utilizados pela aplicação
 * @author Administrador
 */
class_alias('est_class_interface_factory_css', 'cssFactory');
class est_class_interface_factory_css {
    
    /*
     * Este método serve para gerar um arquivo padrão com todas as classes CSSs já produzidas pelo factory
     * Este método não deve ser chamado toda vez (embora possa ser).
     * O seu uso correto é apenas uma vez através da configuração geral da aplicação
     * 
     * @return String = Retorna o caminho completo do arquivo gerado.
     */
    static public function geraArqCss($bRegera = FALSE) {
        $fileCss = __DIR__ . DIRECTORY_SEPARATOR . '/css/appstyles.css';
        if(file_exists($fileCss)) {
            if($bRegera) {
                unlink($fileCss);
            } else {
                return $fileCss;
            }
        }
        $styles = FALSE;
        $methods = get_class_methods(__CLASS__);
        foreach ($methods as $method) {
            if($method != __FUNCTION__) { 
                 /* @var $oStyle est_class_interface_css */
                 $oStyle = call_user_func(__CLASS__ . '::' . $method);
                 $styles .= $oStyle->show(TRUE);
            }            
        }        
        if($styles) {
            $styles = "/* Gerado Automáticamente pelo framework do Cleber*/" . PHP_EOL . $styles;
            if(file_put_contents($fileCss, $styles)) {
                return 'appstyles.css';
            } else {
                throw new ExceptionBase('Não foi possível gerar o arquivo de estilos ' . $fileCss);
            }
        }
    }
    
    /*
     * Devolve uma instância de estilo texto plano
     * @return est_class_interface_css 
     */
    static public function css_texto_plano() {
        $oEstilo = new est_class_interface_css('texto_plano');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_COLOR'), '#FF0000');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FONT_FAMILY'), 'Verdana');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FONT_SIZE'), '20pt');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FONT_WEIGHT'), 'bold');
        return $oEstilo;
    }

    //Devolve uma instância de estilo celula simples
    static public function css_celula_simples() {
        /* @var $oEstilo est_class_interface_css */
        $oEstilo = new est_class_interface_css('celula_simples');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), 'white');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING_TOP'), '10px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING_BOTTOM'), '10px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING_LEFT'), '10px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING_RIGHT'), '10px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_LEFT'), '5px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '142px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '154px');
        return $oEstilo;
    }
    
    static public function css_panel() {
        $oEstilo = new est_class_interface_css('panel');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_POSITION'), 'relative');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '100px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BORDER'), '2px solid');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BORDER_COLOR'), 'grey');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), '#F0F0F0');
        return $oEstilo;        
    }

    static public function css_dialog() {
        $oEstilo = new est_class_interface_css('dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_POSITION'), 'absolute');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_LEFT'), '50%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_TOP'), '50%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '50px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), '#e0e0e0');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BORDER'), '1px solid #000000');
        return $oEstilo;        
    }

    static public function css_janela() {
        $oEstilo = new est_class_interface_css('janela');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '400px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '300px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_Z_INDEX'), '10000');
        return $oEstilo;        
    }

    static public function css_janela_manutencao() {
        $oEstilo = new est_class_interface_css('janela_manutencao');
        $oEstilo->addInherited('janela');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '400px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '300px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_Z_INDEX'), '10000');
        return $oEstilo;        
    }

    static public function css_fundo_titulo_dialog() {
        $oEstilo = new est_class_interface_css('fundo_titulo_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), 'blue');
        return $oEstilo;        
    }
    
    static public function css_titulo_dialog() {
        $oEstilo = new est_class_interface_css('titulo_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FLOAT'), 'left');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FONT_FAMILY'), 'arial');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FONT_SIZE'), '10pt');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_COLOR'), 'white');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FONT_WEIGHT'), 'bold');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_LINE_HEIGHT'), '185%');
        return $oEstilo;        
    }
    
    static public function css_titulo_area_botoes() {
        $oEstilo = new est_class_interface_css('titulo_area_botoes');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FLOAT'), 'right');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_LINE_HEIGHT'), '230%');
        return $oEstilo; 
    }   
    
    static public function css_area_cabecalho_dialog() {
        $oEstilo = new est_class_interface_css('area_cabecalho_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '24px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BORDER_COLLAPSE'), 'collapse');
        return $oEstilo;        
    }
    
    static public function css_area_rodape_dialog() {
        $oEstilo = new est_class_interface_css('area_rodape_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_POSITION'), 'absolute');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '30px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BORDER_COLLAPSE'), 'collapse');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BOTTOM'), '0px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), 'blue');
        return $oEstilo;        
    }
    
    static public function css_botao_acao_base() {
        $oEstilo = new est_class_interface_css('botao_acao_base');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_CURSOR'), 'inherit');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '90px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '24px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING'), '0px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN'), '0px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_VALIGN'), 'top');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_LEFT'), '3px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), '3px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FLOAT'), 'none');        
        return $oEstilo;        
    }

    static public function css_botao_acao_dialog() {
        $oEstilo = new est_class_interface_css('botao_acao_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '16px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '16px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), '4px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_RIGHT'), '1px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_IMAGE'), 'url("' . getBasePath(__FILE__) . '/imagem/temas/padrao/imagem_temas_padrao_botoes.png")');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_REPEAT'), 'no-repeat');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FLOAT'), 'right');
        return $oEstilo;        
    }
    
    static public function css_message_base() {
        $oEstilo = new est_class_interface_css('message_base');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), '#DDDDDD');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BORDER'), '4px solid #000000');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_Z_INDEX'), '10000000000000000');
        return $oEstilo;      
    }
    
    static public function css_area_dialog() {
        $oEstilo = new est_class_interface_css('area_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_VALIGN'), 'top');
        return $oEstilo; 
    }

    static public function css_area_conteudo_dialog() {
        $oEstilo = new est_class_interface_css('area_conteudo_dialog');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_VALIGN'), 'top');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_POSITION'), 'absolute');
        return $oEstilo; 
    }
    
    static public function css_table_layout() {
        $oEstilo = new est_class_interface_css('table_layout');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_FLOAT'), 'right');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), '1px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_BOTTOM'), '1px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_RIGHT'), '1px');
        return $oEstilo; 
    }
    
    static public function css_edit_base() {
        $oEstilo = new est_class_interface_css('edit_base');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), '4px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_RIGHT'), '1px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING'), '0px');
        return $oEstilo; 
    } 
    
    static public function css_edit() {
        $oEstilo = new est_class_interface_css('edit');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_HEIGHT'), '21px');
        return $oEstilo; 
    } 

    static public function css_label_base() {
        $oEstilo = new est_class_interface_css('label_base');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_TOP'), '4px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_RIGHT'), '1px');
        $oEstilo->addPropertySelector(Factory::interfaceConst('css','CSSSELECTOR_AFTER'),
                                      Factory::interfaceConst('css','CSSPROP_CONTENT'), 
                                      '":"');
        return $oEstilo;
    } 

    static public function css_label_edit_base() {
        $oEstilo = new est_class_interface_css('label_edit_base');
        //$oEstilo->addInherited('label_base');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_WIDTH'), '100%');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_DISPLAY'), 'block');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_TEXT_ALIGN'), 'right');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_MARGIN_RIGHT'), '3px');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_PADDING'), '0px');
        return $oEstilo;
    } 
    
    static public function css_disable() {
        $oEstilo = new est_class_interface_css('disable');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), '#ccc');
        return $oEstilo;
    }

    static public function css_enable() {
        $oEstilo = new est_class_interface_css('enable');
        $oEstilo->addProperty(Factory::interfaceConst('css','CSSPROP_BACKGROUND_COLOR'), '#fdfdfd');
        return $oEstilo;
    }
    
}
