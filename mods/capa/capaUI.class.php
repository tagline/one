<?php
                 
class CapaUI extends UI
{
  
      var $templateFile; 	// Arquivo do template, caso seja um por bloco  
      var $template; 		// Template da seзгo, caso seja somente um
      var $mainClass; 		// Classe principal que fornece dados para o bloco
      
      function __construct($templateFile='',$template='') {
             
        parent::prepareTemplate($templateFile,$template);  
      } 
       
      function getPrincipal($secao,$secao_in=''){
        global $geral;
       
        if($secao_in == 'cadastro')
        	$this->template->newBlock("cadastro");
        elseif(!$geral->sessao->get('email'))
        	$this->template->newBlock("login"); 
        else
        	$this->template->newBlock("principal");
        
       	return $this->template->getOutputContent();
      	
      }

      function efetuarLogin ($login = '', $senha = '')
      {
      	global $geral, $classSecao;
      
      	if ($login && $senha)
      		$geral->core->logon($login, $senha);
      
      	header("Location: ".LOCAL_PATH);
      
      	return $this->template->getOutputContent();
      }
      
}

           
           
        
?>