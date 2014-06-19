<?php

global $geral;

// define o tempo que a sessão deve permanecer sem expirar
define('intSegundosSessaoExpira', $_SERVER['SERVER_NAME'] == 'localhost'?12000:2300);

class Core {
	
  	var $pageStyle; /// HEADERS DA PAGINA
    
  	public function getSessao ($bool=0) {
  		//----------------------------------------------------------------	
  		// VERIFICA SE O USUÁRIO ESTÁ LOGADO
  		// $bool :: 1 => RETORNA VALOR BOOLEANO | 2 => RETORNA ARRAY DA SESSÃO
  		//----------------------------------------------------------------
  		
  		global $geral;
  		
  		$url = '';
  	
  		$s = array();
  		$s['dlogon']           = $geral->sessao->get('dlogon');
  		$s['email']            = $geral->sessao->get('email');
  		$s['nome']             = $geral->sessao->get('nome');  
  		$s['cliente_id']       = $geral->sessao->get('cliente_id');
  		$s['usuario_tipo_id']  = $geral->sessao->get('usuario_tipo_id');
  		
  	    if (!$s['email'] || ($s['dlogon'] < time()-(intSegundosSessaoExpira))){
  	    	
  	    	if ($bool)
  	    		return 0;
  		}
  	    else {
  	    	
  	    	$geral->sessao->unsetDado('dlogon'); 
  	    	$geral->sessao->set('dlogon', time());
  	    	
  	    	if ($bool)
  		    		return 1;
  		    		
  	    	return $s;
  	    }
  	}
	
  	public function logon($usuario_login, $usuario_senha) {
  		  //----------------------------------------------------------------	
  		  // FAZ LOGIN E CRIA A SEÇÃO
  		  //----------------------------------------------------------------
  		
  	    global $db,$geral;
  	    
        $sql = "SELECT * FROM usuarios
  	    		WHERE login = trim('" . $usuario_login . "')  
  	    		  AND senha = '" . $usuario_senha . "' ";                            
  	    $rows = $db->db_query($sql);                                
  		$row = $rows[0];
	       
  	    if (count($rows) > 0) {
  	
    	      $geral->sessao->set('dlogon',          time());  
    	      $geral->sessao->set('email',           $row['login']);
    	      $geral->sessao->set('nome',            $row['nome']);  
    	      $geral->sessao->set('cliente_id',      $row['cliente_id']);
    	      $geral->sessao->set('usuario_tipo_id', $row['usuario_tipo_id']);
    	      $geral->sessao->set('sess_id',         md5(date(' d s i h y m')));
    	      
    	      return 1;	      
  	    }
  	    else 
            return 0;
            
  	}		
	
  	function logoff() {
  		//----------------------------------------------------------------	
  		// DESTRÓI A SESSÃO
  		//----------------------------------------------------------------
  		  global $geral;
        
        unset($_SESSION);
        session_destroy();
        
  	}	

  	function finaliza ($template) {
  		
  		global $error,$login;
  		
  		if (count($error->erros) > 0) {
  				$error->mostrarErros($template);
  			}
  			
  		if ($login)
  			$template->newBlock("bloco_login");
  		
  			
  		$template->printToScreen();
  	
  	}
	
  	
} //------- fim da classe

$core = new Core();



?>