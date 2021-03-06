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
	      	  	
      	  		if($_SESSION['cliente_id']>0) {
      	  			
      	  			// atualiza o cadastro do cliente
      	  			$clienteClass->updateCliente($_POST);
      	  			
      	  			// atualiza senha, caso o cliente tenha alterado
      	  			if(!trim($_POST['senha']))
      	  				unset($_POST['senha']);
      	  			else 
      	  				$clienteClass->updateUsuarioSenha($_POST['email'], $_POST['senha']);
      	  			
      	  			echo '1';
      	  			die;
      	  		}
      	  		else {
	      	  		// efetua cadastro do cliente
	      	  		$clienteClass->insertCliente($_POST);
		      	  	
	      	  		// j� efetua login do cliente
	      	  		$geral->core->logon($_POST['email'], $clienteClass->getUsuarioSenha($_POST['email']));
	      	  		
	      	  		// retorna a URL para redirecionar o usu�rio
	      	  		echo LOCAL_PATH;
	      	  		die;
      	  		}
      	  	}      	  	      	  
    	  break;
      		
      	  default:            
            echo $interfaceClass->getPrincipal($secao,$_GET['in']);
          break;
          
        
      }          	
    }               
              
        
?>