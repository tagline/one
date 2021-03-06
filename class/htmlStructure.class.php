<?php

global $geral;

class htmlStructure extends html {
	var $superadmin;
	var $db;
	var $metaTags;
	var $openGraphMetaTags;
	
	function htmlStructure($pageLayout = DEFAULT_PAGE_LAYOUT, $pageAlign = DEFAULT_PAGE_ALIGN, $pageSize = PAGE_SIZE) {
		
		global $db, $geral, $urls;
		
		if ($_GET ['in'] == 'ajax')
			$pageLayout = "noLayout.tpl";
		else
			$pageLayout = "structure.tpl";
		
		parent::html ( $pageLayout, $pageAlign, $pageSize );
		
		$db = new edz_db ( DB_HOST, DB_USER, DB_PASS, DB_BASE );
	}
	
	function configPage($header = TRUE, $menu = TRUE) {
    	global $db, $geral;
    		
    	$pageHeader = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    		
    	$on = $_GET['on'];
    	$in = $_GET['in'];
    	$ac = $_GET['ac'];
    		
    	parent::addBodyCFG("leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'"); 
         
    	parent::addScript("libs/jquery/jquery-1.11.0.min.js", FALSE); 
        parent::addScript("libs/jquery/jquery-migrate-1.2.1.min.js", FALSE);
        parent::addScript("libs/inputmask/jquery.inputmask.bundle.min.js", FALSE);        
        parent::addScript("core/BootstrapFixed.js", FALSE);
        parent::addScript("libs/bootstrap/bootstrap.min.js", FALSE);
        parent::addScript("core/App.js", FALSE);
        parent::addScript("core/geral.js", FALSE);
        
        if($_GET['on']=='veiculos' && ($_GET['in']=='cadastrar' || $_GET['in']=='editar')) {        	
        	parent::addScript("libs/jquery/jquery.maskMoney.min.js", FALSE);
        	parent::addScriptModule(MODULES_PURE_PATH."veiculos/scripts.js", FALSE); 
        }	
        
        // ARQUIVOS DE ESTILOS //    
      	parent::addStyle("theme-default/bootstrap.css");
      	parent::addStyle("theme-default/boostbox.css");
      	parent::addStyle("theme-default/boostbox_responsive.css");
      	parent::addStyle("theme-default/font-awesome.min.css");
                
  		parent::makePage();

    	$this->body->substituiValor("imagePath",IMAGE_PATH);
    	$this->body->substituiValor("fontPath",FONTTRUETYPE_PATH);
    	$this->body->substituiValor("swfPath",SWF_PATH);
    	$this->body->substituiValor("localPath",LOCAL_PATH);
    	$this->body->substituiValor("uploadPath",UPLOAD_LOCAL_PATH);
    		
    	$this->body->substituiValor("on",$on);
    	$this->body->substituiValor("in",$in);		
    	$this->body->substituiValor("ac",$ac);		
    	
    	if(!$geral->sessao->get('email'))
    		$style = "style='display:none'";
    	else 
    		$style = "";

    	$this->body->substituiValor("style",$style);
    	$this->topo();
    	$this->menu();    	
    	
	}
	
	function topo() {
		global $db, $geral, $url;
		
		$TPLV = new templatePower ( TEMPLATE_PATH . "topo.tpl" );
		$TPLV->prepare ();
		$TPLV->assignGlobal ( $url->var );
		
		
		if($_SESSION['usuario_tipo_id']==3 || $_SESSION['usuario_tipo_id']==4)
			$TPLV->newBlock("minha_conta");
		
	  	$this->body->substituiValor ( "topo", $TPLV->getOutputContent () );
  		
	}
	
	function menu() {
		global $db, $geral, $url;
		
		$TPLV = new templatePower ( TEMPLATE_PATH . "menu.tpl" );
		$TPLV->prepare ();
		$TPLV->assignGlobal ( $url->var );
		
		// Perfis:
		// 1 - administrador da loja
		// 2 - secretária da loja
		// 3 - cliente
		// 4 - administrador geral do sistema
		
		if($_SESSION['usuario_tipo_id']==1 )
			$TPLV->newBlock("menu_administrador");
		elseif($_SESSION['usuario_tipo_id']==2 )
			$TPLV->newBlock("menu_secretaria");
		elseif($_SESSION['usuario_tipo_id']==3 )
			$TPLV->newBlock("menu_cliente");
		elseif($_SESSION['usuario_tipo_id']==4) {
			$TPLV->newBlock("menu_administrador_geral");
		}
		
		$this->body->substituiValor ( "menu", $TPLV->getOutputContent () );
	
	}  
	
}

?>