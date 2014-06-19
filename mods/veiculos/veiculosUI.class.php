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
        	
        	// BUSCA O VE�CULO PROCURADO
        	if($_GET['ac'] == 'buscar') {
        		
        		//trata o where da busca
        		$condicao = "modelo LIKE '%".$_POST['busca_veiculo']."%' OR ".
          					"caracteristicas LIKE '%".$_POST['busca_veiculo']."%' OR ".
          					"serie LIKE '%".$_POST['busca_veiculo']."%'";
        		
        		$arrVeiculos = $this->mainClass->getVeiculos(0,$condicao);
        	}
        	else
        		// SELECIONA TODOS OS VE�CULOS CADASTRADOS
	        	$arrVeiculos = $this->mainClass->getVeiculos();
	        
	        if(count($arrVeiculos)>0) { 
		        
	        	// ITERA��O PARA IMPRIMIR OS VE�CULOS
		        foreach($arrVeiculos as $veiculo) {
		        	$this->template->newBlock("lista_veiculos");
		        	$veiculo['valor_diaria'] = 'R$ '.toVal($veiculo['valor_diaria']);
		        	$this->template->assign($veiculo);
		        	
		        	if($veiculo['disponivel']==1)
		        		$this->template->assign("label_cor","label-success"); //imprime verde na coluna da disponibilidade
		        	else
		        		$this->template->assign("label_cor","label-danger"); //imprime vermelho na coluna da disponibilidade
		        	
		        	// se usu�rio logado for do perfil CLIENTE > n�o tem acesso �s fun�oes de Editar e Excluir
		        	if($_SESSION['usuario_tipo_id']==3){
		        		$this->template->assign("display_editar","style='display:none;'");
		        		$this->template->assign("display_excluir","style='display:none;'");
		        	}
		        	
		        }
	        }
	        else
	        	$this->template->newBlock("sem_registros");
	             	
        }
        if($secao_in == 'cadastrar') {
        	
        	$this->template->newBlock("cadastro");
        	
        	// busca todas as lojas cadastradas e lista-as no formul�rio
        	$arrLojas = $this->mainClass->getLojas();
        	foreach($arrLojas as $loja) {
        		$this->template->newBlock("lista_lojas");
        		$this->template->assign($loja);        		
        	}
        	
        }  
        if($secao_in == 'editar') {
        	 
        	$this->template->newBlock("cadastro");
        	
        	// desabilita a altera��o do campo de dispon�vel => apenas a��o de devolu��o faz essa libera��o
        	$this->template->assign("disabled","disabled");
        	
        	// se o id est� setado � pq trata-se da edi��o do ve�culo
        	if($_GET['id'] > 0) {
        		$arrDadosVeiculo = $this->mainClass->getVeiculos($_GET['id']);
        		$this->template->assign("veiculo_id",$_GET['id']);
        		$this->template->assign($arrDadosVeiculo[0]);
        	}
        	
        	// busca todas as lojas cadastradas e lista-as no formul�rio
        	$arrLojas = $this->mainClass->getLojas();
        	foreach($arrLojas as $loja) {
        		$this->template->newBlock("lista_lojas");
        		$this->template->assign($loja);
        		
        		if($arrDadosVeiculo[0]['loja_id'] && $loja['loja_id']==$arrDadosVeiculo[0]['loja_id'])
        			$this->template->assign("loja_selected","selected");
        		else
        			$this->template->assign("loja_selected","");
        	}
        	
        	if($arrDadosVeiculo[0]['disponivel'] == 0)
        		$this->template->assign("disponivel_selected_0","selected");
        	else
        		$this->template->assign("disponivel_selected_1","selected");
        	 
        } 
        if($secao_in == 'visualizar'){
        	$this->template->newBlock("detalhes");
        	
        	// BUSCA O VE�CULO SELECIONADO
        	$arrDadosVeiculo = $this->mainClass->getVeiculos($_GET['id']);
        	
        	// TRATAMENTO DOS DADOS
        	$arrDadosVeiculo[0]['valor_diaria'] = 'R$ '. toVal($arrDadosVeiculo[0]['valor_diaria']);
        	$arrDadosVeiculo[0]['caracteristicas'] = str_replace("\n", "<br>", $arrDadosVeiculo[0]['caracteristicas']);
        	
        	$this->template->assign($arrDadosVeiculo[0]);
        	
        	if($arrDadosVeiculo[0]['disponivel'] == 1) {
        		$this->template->newBlock("disponivel");
        		$this->template->newBlock("btn_locacao");
        	}
        	else
        		$this->template->newBlock("indisponivel");
        }
        if($secao_in == 'devolver'){
        	$this->template->newBlock("devolucao");
        }   
            
       	return $this->template->getOutputContent();
      	
      }

      
}

           
           
        
?>