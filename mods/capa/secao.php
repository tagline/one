<?php

    $secao = "capa";

    require_once(MODULES_PATH."cadastro/clientes.class.php");
    require_once(MODULES_PATH.$secao."/".$secao."UI.class.php");
    $geral->estrutura->Prepara();
    
    function Main(){
      global $geral,$secao;    
          
      $interfaceClass = new CapaUI($secao);
                
      switch ($_GET['in']){
                                      
      	 case 'logon' :
      		echo $interfaceClass->efetuarLogin($_POST['login'],$_POST['senha']);
      	 break;
      	 
      	 case 'ajax' :
      	 	if($_GET['ac']=='logout') {
      	 		$geral->core->logoff();
	      	 	echo LOCAL_PATH; die;
      	 	}
      	 break;
      		
      	 default:
            echo $interfaceClass->getPrincipal($secao,$_GET['in']);
         break;
         
      }
                	
    }


?>