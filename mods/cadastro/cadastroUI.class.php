<?php
                 
   class CadastroUI extends UI
    {
      
          var $templateFile; 	// Arquivo do template, caso seja um por bloco  
          var $template; 		// Template da seзгo, caso seja somente um
          var $mainClass; 		// Classe principal que fornece dados para o bloco
          
          function __construct($templateFile='',$template='') {
                 
            $this->mainClass = new Clientes();
            parent::prepareTemplate($templateFile,$template);   
            
          } 
           
          function getPrincipal($secao,$secao_in=''){
            global $geral;
            
            if($_SESSION['cliente_id']) {
            	
            	// abre o cadastro com os dados do cliente logado
            	$arrDadosCliente = $this->mainClass->getCliente();
            	$this->template->assign($arrDadosCliente);            	
            }
            	
          	return $this->template->getOutputContent();
          	
          }    
          
         
   }
   
           
           
        
?>