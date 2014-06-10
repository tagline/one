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
         
      	 //case 'cadastrar':
      	 //break;

         //case 'editar':
         //break;
         
         //case 'excluir':
         //break;
         die;
      }
                	
    }


?>