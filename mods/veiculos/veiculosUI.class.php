<?php
                 
class VeiculosUI extends UI
{
  
      var $templateFile; 	// Arquivo do template, caso seja um por bloco  
      var $template; 		// Template da seção, caso seja somente um
      var $mainClass; 		// Classe principal que fornece dados para o bloco
      
      function __construct($templateFile='',$template='') {
             
        $this->mainClass = new Veiculos();
        parent::prepareTemplate($templateFile,$template);   
        
      } 
       
      function getPrincipal($secao,$secao_in=''){
        global $geral;
        
        if($secao_in == 'listar') {

        	$this->template->newBlock("listagem");
        	
        	// BUSCA O VEÍCULO PROCURADO
        	if($_GET['ac'] == 'buscar') {
        		
        		//trata o where da busca
        		$condicao = "modelo LIKE '%".$_POST['busca_veiculo']."%' OR ".
          					"caracteristicas LIKE '%".$_POST['busca_veiculo']."%' OR ".
          					"serie LIKE '%".$_POST['busca_veiculo']."%'";
        		
        		$arrVeiculos = $this->mainClass->getVeiculos(0,$condicao);
        	}
        	else
        		// SELECIONA TODOS OS VEÍCULOS CADASTRADOS
	        	$arrVeiculos = $this->mainClass->getVeiculos();
	        
	        if(count($arrVeiculos)>0) { 
		        
	        	// ITERAÇÃO PARA IMPRIMIR OS VEÍCULOS
		        foreach($arrVeiculos as $veiculo) {
		        	$this->template->newBlock("lista_veiculos");
		        	$veiculo['valor_diaria'] = 'R$ '.toVal($veiculo['valor_diaria']);
		        	$this->template->assign($veiculo);
		        	
		        	if($veiculo['disponivel']==1)
		        		$this->template->assign("label_cor","label-success"); //imprime verde na coluna da disponibilidade
		        	else
		        		$this->template->assign("label_cor","label-danger"); //imprime vermelho na coluna da disponibilidade
		        	
		        	// se usuário logado for do perfil CLIENTE > não tem acesso às funçoes de Editar e Excluir
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
        	
        	// busca todas as lojas cadastradas e lista-as no formulário
        	$arrLojas = $this->mainClass->getLojas();
        	foreach($arrLojas as $loja) {
        		$this->template->newBlock("lista_lojas");
        		$this->template->assign($loja);        		
        	}
        	
        }  
        if($secao_in == 'editar') {
        	 
        	$this->template->newBlock("cadastro");
        	
        	// desabilita a alteração do campo de disponível => apenas ação de devolução faz essa liberação
        	$this->template->assign("disabled","disabled");
        	
        	// se o id está setado é pq trata-se da edição do veículo
        	if($_GET['id'] > 0) {
        		$arrDadosVeiculo = $this->mainClass->getVeiculos($_GET['id']);
        		$this->template->assign("veiculo_id",$_GET['id']);
        		$this->template->assign($arrDadosVeiculo[0]);
        	}
        	
        	// busca todas as lojas cadastradas e lista-as no formulário
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
        	
        	// BUSCA O VEÍCULO SELECIONADO
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