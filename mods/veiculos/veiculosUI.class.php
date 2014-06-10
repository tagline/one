<?php
                 
class VeiculosUI extends UI
{
  
      var $templateFile; 	// Arquivo do template, caso seja um por bloco  
      var $template; 		// Template da se��o, caso seja somente um
      var $mainClass; 		// Classe principal que fornece dados para o bloco
      
      function __construct($templateFile='',$template='') {
             
        $this->mainClass = new Veiculos();
        parent::prepareTemplate($templateFile,$template);   
        
      } 
       
      function getPrincipal($secao,$secao_in=''){
        global $geral;
        
        if($secao_in == 'listar') {

        	$this->template->newBlock("listagem");

        	// SELECIONA TODOS OS VE�CULOS CADASTRADOS
	        $arrVeiculos = $this->mainClass->getVeiculos();
	        
	        // ITERA��O PARA IMPRIMIR OS VE�CULOS
	        foreach($arrVeiculos as $veiculo) {
	        	$this->template->newBlock("lista_veiculos");
	        	$veiculo['valor_diaria'] = 'R$ '.toVal($veiculo['valor_diaria']);
	        	$this->template->assign($veiculo);
	        	
	        	if($veiculo['disponivel']==1)
	        		$this->template->assign("label_cor","label-success"); //imprime verde na coluna da disponibilidade
	        	else
	        		$this->template->assign("label_cor","label-danger"); //imprime vermelho na coluna da disponibilidade
	        	
	        }
	             	
        }
        if($secao_in == 'cadastrar') {
        	$this->template->newBlock("cadastro");
        }   
        if($secao_in == 'devolver'){
        	$this->template->newBlock("devolucao");
        }   
            
       	return $this->template->getOutputContent();
      	
      }

      
}

           
           
        
?>