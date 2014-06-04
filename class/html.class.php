<?php

//---- definições da classe ----------
define("DEFAULT_PAGE_LAYOUT","defaultPageLayout.tpl");
define("DEFAULT_PAGE_ALIGN","left");
define("AUTHOR","");
//------------------------------------

class html
{
  var $title;      	 // título da página
  var $description;   // description da página
  var $keywords;      // keywords da página
  var $image; // imagem da pagina
  
  var $scripts;                   // scripts .js da página
  var $styles;                    // estilos .css da página
  var $bodyCfg;                   // configurações da tag BODY
  
  var $header;                    // objeto htmlTemplate do header
  var $menu;                      // objeto htmlTemplate do menu
  var $footer;                    // objeto htmlTemplate do footer
  var $body;                      // objeto do corpo da página (htmlTemplate)

  var $pageLayout;                // layout do corpo da página (arquivo .tpl)

  var $makeCache = FALSE;         // flag de gravação de cache da página
  var $makeLog = TRUE;            // flag de gravação de log
  var $dieOnError = TRUE;         // flag de parada do script em caso de erros
  var $siteOn = TRUE;             // flag que indica se o site está ativa

  //-----------------------------------------
  // html($pageLayout*,$pageAlign**,
  //                   $pageSize***)
  // construtor da classe
  // * $pageLayout (layout do corpo da página)
  // ** $pageAlign (alinhamento para a página)
  // *** $pageSize (tamanho da página)
  //-----------------------------------------
  function html($pageLayout=DEFAULT_PAGE_LAYOUT,$pageAlign=DEFAULT_PAGE_ALIGN,$pageSize=PAGE_SIZE, $metaTags=array(), $openGraphTags=array())
  { 
    $this->pageLayout = $pageLayout;
    $this->pageAlign  = $pageAlign;
    $this->pageSize   = $pageSize;
    $this->metaTags   = $metaTags;
    $this->openGraphTags   = $openGraphTags;
  }
  

  //-----------------------------------------
  // addScript($script*)
  // adiciona um js à página
  // trata como array scripts separados por ','
  // * $script (js a adicionar)
  //-----------------------------------------
 function addScript($script,$common=TRUE,$extra='',$google=FALSE){
		
		if ($google == TRUE){
			$url = "http://www.google-analytics.com/".$script;
			$this->scripts .= "<script type='text/javascript' language='javascript' src='".$url."'></script>";
		}
		
		if ($script == 'pngfixed.js'){
			$this->scripts .= "<!--[if IE]>\n";
			$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$script."' $extra></script>\n";
			$this->scripts .= "<![endif]-->\n";
		}
		
		else {
			if (ereg(",",$script)) {
				$scripts = explode(",",$script);
				for(reset($scripts); $scriptName = current($scripts); next($scripts)) {
					if($common) {
						$this->_checkFileInclusion(COMMON_SCRIPT_PATH,$scriptName);
						copy(COMMON_SCRIPT_PATH.$scriptName,SCRIPT_SERVER_PATH.$scriptName);
						$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$scriptName."' $extra></script>\n";
					}
					else {
						$this->_checkFileInclusion(SCRIPT_SERVER_PATH,$scriptName);
						$this->scripts .= "<script type='text/javascript' language='JavaScript' src='".SCRIPT_PATH.$scriptName."' $extra></script>\n";
					}
				}
			}
		    else {
				if ($common) {
					$this->_checkFileInclusion(COMMON_SCRIPT_PATH,$script);
					copy(COMMON_SCRIPT_PATH.$script,SCRIPT_SERVER_PATH.$script);
					$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$script."' $extra></script>\n";
				}
				else {
				
					$this->_checkFileInclusion(SCRIPT_SERVER_PATH,$script);
					$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$script."' $extra></script>\n";
				}
		    }
		    
		    if ($_GET['imprimir'])
		    	$this->scripts = '';
		}
	}
	
  function addScriptModule($script,$common=TRUE,$extra='',$google=FALSE){
		
		if ($google == TRUE){
			$url = "http://www.google-analytics.com/".$script;
			$this->scripts .= "<script type='text/javascript' language='javascript' src='".$url."'></script>";
		}
		
		if ($script == 'pngfixed.js'){
			$this->scripts .= "<!--[if IE]>\n";
			$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$script."' $extra></script>\n";
			$this->scripts .= "<![endif]-->\n";
		}
		
		else {
			if (ereg(",",$script)) {
				$scripts = explode(",",$script);
				for(reset($scripts); $scriptName = current($scripts); next($scripts)) {
					if($common) {
						$this->_checkFileInclusion(COMMON_SCRIPT_PATH,$scriptName);
						copy(COMMON_SCRIPT_PATH.$scriptName,SCRIPT_SERVER_PATH.$scriptName);
						$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$scriptName."' $extra></script>\n";
					}
					else {
						$this->_checkFileInclusion(SCRIPT_SERVER_PATH,$scriptName);
						$this->scripts .= "<script type='text/javascript' language='JavaScript' src='".SCRIPT_PATH.$scriptName."' $extra></script>\n";
					}
				}
			}
		    else {
				if ($common) {
					$this->_checkFileInclusion(COMMON_SCRIPT_PATH,$script);
					copy(COMMON_SCRIPT_PATH.$script,SCRIPT_SERVER_PATH.$script);
					$this->scripts .= "<script type='text/javascript' language='javaScript' src='".SCRIPT_PATH.$script."' $extra></script>\n";
				}
				else {
				
					//$this->_checkFileInclusion(GLOBAL_PATH,$script);
					$this->scripts .= "<script type='text/javascript' language='javaScript' src='".LOCAL_PATH.$script."' $extra></script>\n";
				}
		    }
		    
		    if ($_GET['imprimir'])
		    	$this->scripts = '';
		}
	}
  //-----------------------------------------
  // addStyle($style*)
  // adiciona um css à página
  // trata como array estilos separados por ','
  // * $style (estilo(s) a adicionar)
  //-----------------------------------------
  
  function addStyle($style)
  {
  	
  	$this->styles .= "<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700,800' rel='stylesheet' type='text/css'/>";
	
	if ($style == "styles_ie.css") {
		$style_extra_inicial = "<!--[if IE]>\n";
		$style_extra_final = "<![endif]-->\n";
	}
  	
    if (ereg(",",$style)) {
      $styles = explode(",",$style);
      for(reset($styles); $styleName = current($styles); next($styles)) {
        $this->_checkFileInclusion(STYLE_SERVER_PATH,$styleName);
        $this->styles .= $style_extra_inicial;
        $this->styles .= "<link rel='stylesheet' type='text/css' href='".STYLE_PATH.$styleName."'/>\n";
        $this->styles .= $style_extra_final;
      }
    }
    else {
      $this->_checkFileInclusion(STYLE_SERVER_PATH,$style);
      $this->styles .= $style_extra_inicial;
      $this->styles .= "<link rel='stylesheet' type='text/css' href='".STYLE_PATH.$style."'/>\n";
      $this->styles .= $style_extra_final;
    }
  }

  //-----------------------------------------
  // addBodyCFG($cfg*)
  // concatena um atributo à tag BODY
  // * $cfg (novo atributo)
  //-----------------------------------------
  function addBodyCFG($cfg)
  {
    $this->bodyCfg .= $cfg;
  }

  //-----------------------------------------
  // setTitle($title*)
  // Seta o título da página
  // * $title (novo título)
  //-----------------------------------------
  function setTitle($title) {	
  	$this->title = $title;
  	$this->metaTags['TITLE'] = $title;
  }
  
  function setDescription($description) {	
  	$this->description = $description;
  	$this->metaTags['DESCRIPTION'] = $description;
  }
  
  function setKeywords($keywords) {	
  	$this->keywords = $keywords;
  	$this->metaTags['KEYWORDS'] = $keywords;
  }            
   
  function setImage($image) {	
  	$this->image = $image;
  	$this->metaTags['IMAGE'] = $image;
  }

  //-----------------------------------------
  // getTitle()
  // retorna o título da página
  //-----------------------------------------
  function getTitle()
  {
    return $this->title;
  }

  function getDescription() {
  	return $this->description;
  }
  
	function getKeywords() {
  	return $this->keywords;
  }
  
  //-----------------------------------------
  // makePage()
  // instancia os objetos que compõem a página
  //-----------------------------------------
  function makePage()
  {
    //$this->_makeHeader();
    //$this->_makeMenu();
    //$this->_makeFooter();
    $this->_makeBody();
  }

  //-----------------------------------------
  // printPage()
  // exibe o conteúdo dos objetos principais
  //-----------------------------------------
  function printPage()
  {
    global $geral;
    
    if($this->makeLog == TRUE) {
       require_once(CLASSE_LOGS);
       $logs = new logs("Visita de Página",$GLOBALS["PHP_SELF"]);
       $logs->insertLog();
    }
    if(!$this->makeCache) {
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
    }
           
    if ($_GET['in'] != 'ajax')
      $this->_printHeader();
      
    $this->_printBody();
    
    if ($_GET['in'] != 'ajax')
      $this->_printFooter();     
                                                                         
    $geral->estrutura->Finaliza();
  }

  //-----------------------------------------
  // _metaTags()
  // busca no arquivo de configuração as tags
  // META e imprime no 'head' da página
  //-----------------------------------------
  function _metaTags($tags=array())
  {       
              
    if (!$tags['TITLE'])
      $tags['TITLE'] = TITLE; 
    if (!$tags['DESCRIPTION'])
      $tags['DESCRIPTION'] = DESCRIPTION; 
    if (!$tags['KEYWORDS'])
      $tags['KEYWORDS'] = KEYWORDS;
    if (!$tags['IDENTIFIER-URL']) 
      $tags['IDENTIFIER-URL'] = IDENTIFIER-URL; 
    if (!$tags['VERIFY-V1'])
      $tags['VERIFY-V1'] = VERIFY-V1;
                   
    $metaTags =  "\n<meta name=\"TITLE\" content=\"".$tags['TITLE']."\"/>\n".
                 "<meta name=\"DESCRIPTION\" content=\"".$tags['DESCRIPTION']."\"/>\n".
                 "<meta name=\"KEYWORDS\" content=\"".$tags['KEYWORDS']."\"/>\n".
                 "<meta name=\"IDENTIFIER-URL\" content=\"".$tags['IDENTIFIER-URL']."\"/>\n".
                 "<meta name=\"verify-v1\" content=\"".$tags['VERIFY-V1']."\" />\n";                           
  
    return $metaTags;
  }
  
  function _metaOpenGraph($tags=array())
  {  
                                             
    $metaOG = '';
 
    if ($tags['OG_TITLE'] != '')
      $metaOG = "<meta content='".$tags['OG_TITLE']."' property='og:title'/>".chr(13).chr(10);
    else {
      if (defined('OG_TITLE'))
         $metaOG = "<meta content='".OG_TITLE."' property='og:title'/>".chr(13).chr(10);      // titulo do open graph 
    }   
    
    if ($tags['OG_TYPE'] != '')    
      $metaOG .= "<meta content='".$tags['OG_TYPE']."' property='og:type'/>".chr(13).chr(10);
    else {
      if (defined('OG_TYPE'))
         $metaOG .= "<meta content='".OG_TYPE."' property='og:type'/>".chr(13).chr(10);       // tipo de site  
    }    
      
    if ($tags['OG_URL'] != '')
      $metaOG .= "<meta content='".$tags['OG_URL']."' property='og:url'/>".chr(13).chr(10);
    else {
                                            
     $metaOG .= "<meta content='".str_replace('//','/',str_replace('://','///',LOCAL_PATH.$_SERVER['REQUEST_URI']))."' property='og:url'/>".chr(13).chr(10);        // url da pagina
    	
    }            

    if ($tags['OG_DESCRIPTION'] != '')
      $metaOG .= "<meta content='".$tags['OG_DESCRIPTION']."' property='og:description'/>".chr(13).chr(10);
    else {
      if (defined('OG_DESCRIPTION'))
         $metaOG .= "<meta content='".OG_DESCRIPTION."' property='og:description'/>".chr(13).chr(10);      // imagem apresentada 
    }         
      
    if ($tags['OG_SITE_NAME'] != '')
      $metaOG .= "<meta content='".$tags['OG_SITE_NAME']."' property='og:site_name'/>".chr(13).chr(10);
    else {
      if (defined('OG_SITE_NAME'))
         $metaOG .= "<meta content='".OG_SITE_NAME."' property='og:site_name'/>".chr(13).chr(10);  // nome do site
    }       
      
    if ($tags['OG_IMAGE'] != '')
      $metaOG .= "<meta content='".$tags['OG_IMAGE']."' property='og:image'/>".chr(13).chr(10);
    else {
      if (defined('OG_IMAGE'))
         $metaOG .= "<meta content='".OG_IMAGE."' property='og:image'/>".chr(13).chr(10);
    }       

    if (defined(OG_ADMINS))
        $metaOG .= "<meta content='".OG_ADMINS."' property='fb:admins'/>".chr(13).chr(10);    

    return $metaOG;
  }

  //-----------------------------------------
  // _makeHeader()
  // instancia e processa o cabeçalho
  //-----------------------------------------
  function _makeHeader()
  {
    $this->header = new header();
  }

  //-----------------------------------------
  // _makeMenu()
  // instancia e processa o menu
  //-----------------------------------------
  function _makeMenu()
  {
    $this->menu = new menu();
  }

  //-----------------------------------------
  // _makeFooter()
  // instancia e processa o footer
  //-----------------------------------------
  function _makeFooter()
  {
    $this->footer = new footer();
  }

  //-----------------------------------------
  // _makeBody()
  // instancia o template do esqueleto da página
  //-----------------------------------------
  function _makeBody()
  {
  
    $this->body = new htmlTemplate($this->pageLayout,TEMPLATE_PATH);
    $this->body->loadTemplate();
  }

  
  
  //-----------------------------------------
  // _printHeader()
  // imprime o cabeçalho 'head' da página
  //-----------------------------------------
  function _printHeader()
  {

    $titulo = ($this->metaTags['TITLE'] != '' ? $this->metaTags['TITLE'] : ($this->title != '' ? $this->title . ' - ' : ''));
         
    //$pageHeader = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" >\n";
    $pageHeader = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
   	//$pageHeader = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">";
    $pageHeader .= "<html xmlns=\"https://www.w3.org/1999/xhtml\" xmlns:og=\"http://opengraphprotocol.org/schema/\" xmlns:fb=\"https://www.facebook.com/2008/fbml\">\n";
    $pageHeader .= "<head>\n";
    $pageHeader .= "<title>$titulo</title>";          
    $pageHeader .= $this->_metaTags($this->metaTags);
    $pageHeader .= $this->_metaOpenGraph($this->openGraphMetaTags);
    $pageHeader .= $this->styles;
    $pageHeader .= $this->scripts;
    $pageHeader .= "<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false'></script>";
    $pageHeader .= "<link rel=\"shortcut icon\" href=\"".IMAGE_PATH."logo.png\" />\n";
    $pageHeader .= GOOGLE_ANALYTICS;    
    $pageHeader .= "</head>\n";
    
    print $pageHeader;

  }

  //-----------------------------------------
  // _printBody()
  // Imprime as tags BODY da página e chama
  // a função Main() que deve ser escrita;
  // Exibe a tela de site fora do ar se a
  // configuração indicar este estado
  //-----------------------------------------
  
  function _printBody()
  {
    global $geral;
    
    if (!$this->siteOn) {
      
      if ($_GET['in'] != 'ajax')
        print "<body>\n";
      
      $tpl = new htmlTemplate(OFF_STATUS_TEMPLATE,TEMPLATE_PATH);
      $tpl->loadTemplate();
      $tpl->substituiValor("imagePath",IMAGE_PATH);
      $tpl->printTemplate();
      
      //---------------- tag de remarketing - GOOGLE ----------------------//
      print '<script type="text/javascript">
            /* <![CDATA[ */
            var google_conversion_id = 1002270719;
            var google_custom_params = window.google_tag_params;
            var google_remarketing_only = true;
            /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
            <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1002270719/?value=0&amp;guid=ON&amp;script=0"/>
            </div>          
            </noscript>';
      //-------------------------------------------------------------------//
      
      echo '<!-- Google Tag Manager -->
            <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NF7WNL"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
            new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
            "//www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,"script","dataLayer","GTM-NF7WNL");</script>
            <!-- End Google Tag Manager -->';
            
      if ($_GET['in'] != 'ajax')
        print "</body>\n";
    }
    elseif (is_object($this->body)) {
      
      $this->body->substituiValor("width",$this->pageSize);
      $this->body->substituiValor("align",$this->pageAlign);
      $this->body->substituiValor("main",$this->_getMain());
      
      if ($_GET['in'] != 'ajax')
        print "<body style='overflow-x: hidden' ".$this->bodyCfg.">\n";
      
      if ($_GET['on'] == 'matricula' && $_GET['in'] == 'passo_4') { 
        print '<script type="text/javascript">
                  /* <![CDATA[ */
                  var google_conversion_id = 1002270719;
                  var google_conversion_language = "en";
                  var google_conversion_format = "3";
                  var google_conversion_color = "ffffff";
                  var google_conversion_label = "HnEeCIn5iwUQ_9_13QM";
                  var google_conversion_value = 0;
                  /* ]]> */
                  </script>
                  <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
                  </script>
                  <noscript>
                  <div style="display:inline;">
                  <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1002270719/?value=0&amp;label=HnEeCIn5iwUQ_9_13QM&amp;guid=ON&amp;script=0"/>
                  </div>
                </noscript>';  
      }
              
      print $this->body->getContents();
      
      //---------------- tag de remarketing - GOOGLE ----------------------//
      print '<script type="text/javascript">
            /* <![CDATA[ */
            var google_conversion_id = 1002270719;
            var google_custom_params = window.google_tag_params;
            var google_remarketing_only = true;
            /* ]]> */
            </script>
            <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
            </script>
            <noscript>
            <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1002270719/?value=0&amp;guid=ON&amp;script=0"/>
            </div>          
            </noscript>';
      //-------------------------------------------------------------------//
      
      echo '<!-- Google Tag Manager -->
            <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NF7WNL"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
            new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
            "//www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,"script","dataLayer","GTM-NF7WNL");</script>
            <!-- End Google Tag Manager -->';
            
                  
      if ($_GET['in'] != 'ajax')
        print "</body>\n";     
        
    }
    else {
      $this->_error("O objeto body não foi instanciado. Execute a função makePage() antes da printPage() ou crie uma classe extendida à classe html.");
    }
    
  }

  //-----------------------------------------
  // _printFooter()
  // imprime a tag </HTML>
  //-----------------------------------------
  function _printFooter()
  {
    print "</html>\n";
   // if (!ereg("WIN",strtoupper(PHP_OS))) GzDocOut();
  }

  //-----------------------------------------
  // _getMain()
  // carrega no buffer o conteúdo da função
  // Main() e retorna para a classe inserir
  // no layout de página escolhido
  //-----------------------------------------
  function _getMain()
  {
    ob_start();
    Main();
    $main = ob_get_contents();
    ob_end_clean();
    return $main;
  }


  //-----------------------------------------
  // _checkFileInclusion($path*,$file**)
  // Verifica se um arquivo incluído existe
  // * path (caminho do arquivo)
  // ** $file (arquivo)
  //-----------------------------------------
  function _checkFileInclusion($path,$file)
  {  	
    if (!file_exists($path.$file)) {
      $this->_error("O arquivo ".$file." não foi encontrado no caminho ".$path."!");
    }
  }

  //-----------------------------------------
  // _error($errorString*)
  // mensagem de erro da classe
  // * $errorString (mensagem de erro)
  //-----------------------------------------
  function _error($errorString)
  {
    print "<B>Erro na Classe html</B>: ".$errorString;
    if ($this->dieOnError) {
      exit;
    }
  }
}
?>
