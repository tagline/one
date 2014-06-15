<?php

$tabela = "veiculos";

class Veiculos
{

  /** 
   * 
   * @param integer $id
   * @return string
   */
  function getVeiculos($id=0){
      global $geral, $tabela;
     
      $arrVeiculos = array();
      
      if ($id > 0)
      	$where = "WHERE veiculo_id=$id";
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
        	 "modelo	   	  = '".$arrDados['modelo']."',".
        	 "ano		   	  = '".$arrDados['ano']."',".
        	 "serie		   	  = '".$arrDados['serie']."',".
        	 "potencia	   	  = '".$arrDados['potencia']."',".
        	 "placa		   	  = '".$arrDados['placa']."',".
        	 "disponivel      = '".$arrDados['disponivel']."',".
        	 "valor_diaria    = '".$arrDados['valor_diaria']."',".
        	 "caracteristicas = '".$arrDados['caracteristicas']."'";        
	  
      $id = $geral->db->db_insert($tabela,$set);	
      
      if($id)
      	return $id;
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