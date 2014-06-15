<?php
 
    $secao = "cadastro"; 

    require_once(MODULES_PATH."$secao/clientes.class.php");
    require_once(MODULES_PATH."$secao/$secao"."UI.class.php");
        
    $geral->estrutura->Prepara();
    
    function Main(){
      global $geral,$secao;    
           
      $interfaceClass = new CadastroUI($secao);
      $clienteClass = new Clientes();
                
      switch ($_GET['in']){

      	  case 'ajax':
      	  	if($_GET['ac'] == 'cadastrarCliente') {
	      	  	// efetua cadastro do cliente
      	  		$clienteClass->insertCliente($_POST);
	      	  	
      	  		// já efetua login do cliente
      	  		$geral->core->logon($_POST['email'], $clienteClass->getUsuarioSenha($_POST['email']));
      	  		
      	  		// retorna a URL para redirecionar o usuário
      	  		echo LOCAL_PATH; die;
      	  	}      	  	      	  
    	  break;
      		
      	  default:            
            echo $interfaceClass->getPrincipal($secao,$_GET['in']);
          break;
          
        
      }          	
    }               
              
        
?>