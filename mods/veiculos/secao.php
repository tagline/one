<?php

    $secao = "veiculos";
        
    require_once(MODULES_PATH.$secao."/".$secao."UI.class.php");
    require_once(MODULES_PATH.$secao."/".$secao.".class.php");
    $geral->estrutura->Prepara();

    function Main(){
      global $geral,$secao;    
          
      $interfaceClass = new VeiculosUI($secao);
      $veiculosClass  = new Veiculos();
         
      switch ($_GET['in']){
                                      
      	 default:
      	 	echo $interfaceClass->getPrincipal($secao,$_GET['in']);
         break;
         
         case 'ajax':
         	
         	if($_GET['ac']=='cadastrar') {
         		if($_POST['veiculo_id']>0){ // ediчуo de um veэculo jс cadastrado
         			$veiculosClass->updateVeiculo($_POST);
         		}
         		else // cadastro de um veэculo
         			$veiculosClass->insertVeiculo($_POST);
         		
         		echo LOCAL_PATH.$secao."/listar"; 
         		die;
         	}
         	
         	if($_GET['ac']=='excluir') {
	         	$veiculosClass->deleteVeiculo($_POST['veiculo_id']);
	         	echo LOCAL_PATH.$secao."/listar"; 
	         	die;
         	}
         	
         	if($_GET['ac']=='buscar') {
         		echo $interfaceClass->getPrincipal($secao,'listar');
         		die;
         	}
         	
         break;
         die;
      }
                	
    }


?>