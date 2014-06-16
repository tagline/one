<?php

$tabela = "veiculos";

class Veiculos
{

  /** 
   * 
   * @param integer $id
   * @return string
   */
  function getVeiculos($id=0,$restricao=''){
      global $geral, $tabela;
     
      $arrVeiculos = array();
      $where = "";
      
      if ($id > 0)
      	$where = "v.veiculo_id=".$id;
      elseif(trim($restricao)<>"")
      	$where = $restricao; 
      else
 		$where = "";
      
      $campos = "v.*, CASE WHEN v.disponivel=1 THEN 'Sim' ELSE 'Não' END AS disponibilidade, l.nome as loja";
      $tabelas = $tabela . " v LEFT JOIN lojas l USING(loja_id) ";
      $order = " v.ano DESC ";
      $arrVeiculos = $geral->db->db_select($tabelas,$campos,$where,$order);

      return $arrVeiculos;
  }
 
  
  /**
   * 
   * @param array $arrDados
   * @return int $id => last_insert_id
   */
  function insertVeiculo($arrDados){
      global $geral, $tabela;

      $set = "loja_id	   	  = '".$arrDados['loja_id']."',".
        	 "modelo	   	  = '".utf8_decode($arrDados['modelo'])."',".
        	 "ano		   	  = '".$arrDados['ano']."',".
        	 "serie		   	  = '".utf8_decode($arrDados['serie'])."',".
        	 "potencia	   	  = '".$arrDados['potencia']."',".
        	 "placa		   	  = '".$arrDados['placa']."',".
        	 "disponivel      = '".$arrDados['disponivel']."',".
        	 "valor_diaria    = '".toDecimal($arrDados['valor_diaria'])."',".
        	 "caracteristicas = '".utf8_decode($arrDados['caracteristicas'])."'";        
	  
      $id = $geral->db->db_insert($tabela,$set);	
      
      if($id)
      	return $id;
      else 
      	return 0;
             	
  }
  
  /**
   *
   * @param array $arrDados ($_POST com os dados)
   * @return int => 1 = sucesso ou 0 = falha
   */
  function updateVeiculo($arrDados){
  	global $geral, $tabela;
  
  	$set = "loja_id	   	  	 = '".$arrDados['loja_id']."',".
  			"modelo	   	 	 = '".utf8_decode($arrDados['modelo'])."',".
  			"ano		   	 = '".$arrDados['ano']."',".
  			"serie		   	 = '".utf8_decode($arrDados['serie'])."',".
  			"potencia	   	 = '".$arrDados['potencia']."',".
  			"placa		   	 = '".$arrDados['placa']."',".
  			"disponivel      = '".$arrDados['disponivel']."',".
  			"valor_diaria    = '".toDecimal($arrDados['valor_diaria'])."',".
  			"caracteristicas = '".utf8_decode($arrDados['caracteristicas'])."'";
  	
  	$where = "veiculo_id=".$arrDados['veiculo_id'];
  	 
  	$id = $geral->db->db_update($tabela,$set,$where);
  
  	if($id)
  		return 1;
  	else
  		return 0;
  
  }
  /**
   *
   * @param int $id
   * @return bool : true if sucess , false if problem 
   */
  function deleteVeiculo($id){
  	global $geral, $tabela;
  
  	if(!($id>0))
  		return false;
  	
  	$where = "veiculo_id = '".$id."'";  	 
  	if($geral->db->db_delete($tabela,$where))
  		return true;
  	else
  		return false;
  
  }
  
  /**
   *
   * @return array
   */
  function getLojas(){
  	global $geral;
  
  	$arrLojas = $geral->db->db_select("lojas","*");
	return $arrLojas;
  
  }
 
  
}

?>