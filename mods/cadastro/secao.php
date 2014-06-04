<?php
 
    $secao = "cadastro"; 

    require_once(MODULES_PATH."$secao/clientes.class.php");
    require_once(MODULES_PATH."$secao/$secao"."UI.class.php");
        
    $geral->estrutura->Prepara();
    
    function Main(){
      global $geral,$secao;    
           
      $interfaceClass = new CadastroUI($secao);
                
      switch ($_GET['in']){
                                      
          default:            
            echo $interfaceClass->getPrincipal($secao,$_GET['in']);
          break;
          
        
      }          	
    }               
              
        
?>