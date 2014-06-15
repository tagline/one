<?php

$tabela = "clientes";

class Clientes
{

  /** 
   * 
   * @param integer $id
   * @return string
   */
  function getCliente($id=0){
      global $geral, $tabela;
     
      $arrClientes = array();
      
      if ($id > 0)
      	$where = "WHERE cliente_id=$id";
      else
 		$where = "WHERE cliente_id=".$_SESSION['cliente_id'];
      
      $campos = "*";
      $arrClientes = $geral->db->db_select($tabela,$campos,$where);

      return $arrClientes[0];
  }
 
  
  /**
   * 
   * @param array $arrDados
   * @return int $id => last_insert_id
   */
  function insertCliente($arrDados){
      global $geral, $tabela;

      $set = "nome	   	 		 = '".$arrDados['nome']."',".
        	 "cpf		 		 = '".$arrDados['cpf']."',".
        	 "cnh		 		 = '".$arrDados['cnh']."',".
        	 "data_validade_cnh	 = '".toMySQLCodeDate($arrDados['data_validade_cnh'])."',".
        	 "telefone	 		 = '".$arrDados['telefone']."',".
        	 "email      		 = '".$arrDados['email']."'";        
	  
      $id = $geral->db->db_insert($tabela,$set);	
      
      //cria o usuário do cliente
      $this->insertUsuario($arrDados['email'], $arrDados['nome'], $id);
      
      if($id)
      	return $id;
      else 
      	return 0;
             	
  }
 
  /**
   *
   * @param array $arrDados
   * @return int $id => id updated
   */
  function updateCliente($arrDados){
  	global $geral, $tabela;
  
  	$set = "nome	   	 = '".$arrDados['nome']."',".
  			"cpf		 = '".$arrDados['cpf']."',".
  			"cnh		 = '".$arrDados['cnh']."',".
  			"data_cnh	 = '".$arrDados['data_cnh']."',".
  			"telefone	 = '".$arrDados['telefone']."',".
  			"email       = '".$arrDados['email']."',";
  	 
  	$id = $geral->db->db_update($tabela,$set);
  
  	if($id)
  		return $id;
  	else
  		return 0;
  
  }
  
  /**
   *
   * @param string $email
   * @return int $id => last_insert_id
   */
  function insertUsuario($email,$nome,$cliente_id){
  	global $geral, $tabela;
  
  	$set = "usuario_tipo_id = 3,".
    	   "cliente_id      = '".$cliente_id."',".
    	   "nome	   		= '".$nome."',".
  		   "login      		= '".$email."',".
  		   "senha	   		= '".$geral->geraSenha()."'";
  	 
  	$id = $geral->db->db_insert("usuarios",$set);
  
  	if($id)
  		return $id;
  	else
  		return 0;
  
  }
  
  /**
   *
   * @param string $email
   * @return int $id => last_insert_id
   */
  function getUsuarioSenha($email){
  	global $geral;
  
  	if(trim($email)=="")
  		return "";
  	
  	$where = "login = '".$email."'";
  	$arrDados = $geral->db->db_select("usuarios","senha",$where);
  
  	if(count($arrDados)>0)
  		return $arrDados[0]['senha'];
  	else
  		return "";
  
  }
  
}

?>