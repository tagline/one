<?php

class Geral {
	
	public function __construct() {
		
		// ----------------------------------------------------------------
		// CONSTRUTORA DA CLASSE
		// ----------------------------------------------------------------
		
		if (! function_exists ( '__autoload' )) {
			function __autoload($class_name) {
				
				if (is_file ( CLASSE_PATH . $class_name . '.class.php' ))
					require_once CLASSE_PATH . $class_name . '.class.php';
				
				if (is_file ( CLASSE_PATH . $class_name . '.php' ))
					require_once CLASSE_PATH . $class_name . '.php';
				
				if (is_file ( CLASSE_FCK_PATH . $class_name . '.php' ))
					require_once CLASSE_FCK_PATH . $class_name . '.php';
				
				if (is_file ( SYSTEM_CLASSE_PATH . $class_name . '.php' ))
					require_once SYSTEM_CLASSE_PATH . $class_name . '.php';
			}
		}
		
		require_once (CORE_CLASSE_PATH . 'htmlTemplate.class.php');
		require_once (CORE_CLASSE_PATH . 'htmlPowerTemplate.class.php');
		require_once (CORE_CLASSE_PATH . 'html.class.php');
		require_once (CORE_CLASSE_PATH . 'htmlStructure.class.php');
		require_once (CORE_CLASSE_PATH . 'core.class.php');
		require_once (CORE_CLASSE_PATH . 'db.class.php');
		require_once (CORE_CLASSE_PATH . 'estrutura.class.php');
		require_once (CORE_CLASSE_PATH . 'session.class.php');
		require_once (CORE_CLASSE_PATH . 'ui.class.php');
		
		$this->getDatabaseConnector ();
		$this->getCore ();
		$this->getEstrutura ();
		$this->getSessao ();
	
	}
	
	public function getUsuario() {
	}
	
	public function getDatabaseConnector() {
		$this->db = new edz_db ( DB_HOST, DB_USER, DB_PASS, DB_BASE );
	}
	
	public function getSessao() {
		$this->sessao = new Sessao ();
	}
	
	public function getEstrutura() {
		$this->estrutura = new Estrutura ();
	}
		
	public function getCore() {
		$this->core = new Core ();
	}
		
	public function getSecao($id = 1) {
		
		if ($id == '')
			$id = 1;
		
		$db = new edz_db ( DB_HOST, DB_USER, DB_PASS, DB_BASE );
		$rows = $db->db_query ( "SELECT secao_id,nome,alias FROM secao WHERE alias = '$id' ORDER BY secao_id" );
		return $rows [0] ['alias'];
	
	}
	
	public function getSubSecao($id = 1, $sessao_id = 1) {
		
		if ($id == '')
			$id = 1;
		
		$db = new edz_db ( DB_HOST, DB_USER, DB_PASS, DB_BASE );
		
		$rows = $db->db_query ( "SELECT subsecao_id,nome,alias FROM subsecao WHERE subsecao_id = '$id' AND secao_id = '$secao_id' ORDER BY secao_id" );
		
		return $rows [0] ['alias'];
	
	}
	
	public function geraInclude($login = 0) {
		
		// ###############################
		// ##### GERA O INCLUDE DO ARQUIVO
		// ###### SE $login = 1, TESTA SE USUÁRIO ESTÁ LOGADO
		// ###############################
		
		$secao = $this->getSecao ( $_GET ['on'] );
		
		$link = MODS_PATH . "$secao.php";
		
		if (! is_file ( $link )) {
			
			$this->error->geraErro ( 404 ); // PÁGINA NÃO ENCONTRADA
			$link = MODS_PATH . "erro.php";
		} elseif (! $this->core->getSessao ( 1 ) && ! $_POST ['username'] && $secao != 'login' && $login == 1) {
			
			$this->error->geraErro ( 2 ); // SESSÃO EXPIRADA
			
			$login = 1; // HABILITA OS CAMPOS DE LOGIN
			$link = MODS_PATH . "erro.php";
		}
		echo $link;
		die ();
		include_once ($link);
	
	}
	
	public function enviaEmail($email, $assunto = 'Email', $mensagem = '', $variaveis = array()) {
		
		if (! $nome)
			$nome = $email;
			
			// CONTEÚDO DO EMAIL ##
		
		$EMAILTPLV = new TemplatePower ( TEMPLATE_PATH . "email.tpl" );
		$EMAILTPLV->prepare ();
		$EMAILTPLV->assignGlobal ( "imagePath", IMAGE_PATH );
		$EMAILTPLV->assignGlobal ( "texto", $mensagem );
		$EMAILTPLV->assignGlobal ( "siteCliente", DOMINIO );
		$EMAILTPLV->assignGlobal ( "nomeCliente", TITLE );
		
		$msg = $EMAILTPLV->getOutputContent ();
		
		// CABEÇALHO DO EMAIL ##
		$crlf = "\n";
		$headers = "";
		$headers .= "From: " . str_replace ( '-', '', TITLE ) . " <" . EMAIL_FROM . ">" . $crlf;
		$headers .= "Sender: " . EMAIL_FROM . $crlf;
		$headers .= "Reply-To: " . EMAIL . $crlf;
		$headers .= "Received: " . EMAIL . $crlf;
		$headers .= "Delivered-To: $email" . $crlf;
		$headers .= "MIME-Version: 1.0" . $crlf;
		$headers .= "Content-type: text/html; charset=iso-8859-1" . $crlf;
		
		// ENVIO ##
		@mail ( $email, $assunto, $msg, $headers );
		//if ($email != EMAIL_DEBUG) @mail ( EMAIL_DEBUG, 'DEBUG: ' . $assunto, $msg, $headers );
	
	}
	
	function removeAspas($valor) {
		
		$valor = addslashes ( str_replace ( "\"", "''", $valor ) );
		
		return $valor;
	
	}
	
	function geraSenha() {
		$sConso = 'bcdfghjklmnpqrstvwxyzbcdfghjklmnpqrstvwxyz';
		$sVogal = 'aeiou';
		$sNum = '123456789';
		$passwd = '';
		
		$y = strlen ( $sConso ) - 1; // conta o nº de caracteres da variável $sConso
		$z = strlen ( $sVogal ) - 1; // conta o nº de caracteres da variável $sVogal
		$r = strlen ( $sNum ) - 1; // conta o nº de caracteres da variável $sNum
		
		for($x = 0; $x <= 1; $x ++) {
			$rand = rand ( 0, $y ); // Funçao rand() - gera um valor randômico
			$rand1 = rand ( 0, $z );
			$rand2 = rand ( 0, $r );
			$str = substr ( $sConso, $rand, 1 ); // substr() - retorna parte de uma
			                                // string
			$str1 = substr ( $sVogal, $rand1, 1 );
			$str2 = substr ( $sNum, $rand2, 1 );
			
			$passwd .= $str . $str1 . $str2;
		}
		return $passwd;
	}
	
	function getTemplate($secao = '', $templateFile = '') {
		
		$templateFile = ($templateFile != '' ? $templateFile : MODS_PATH . $secao . "/secao.tpl");
		
		if ($templateFile != '') {
			$templateFile = new TemplatePower ( $templateFile );
			$templateFile->prepare ();
			$templateFile->assignGlobal ( 'localPath', LOCAL_PATH );
			$templateFile->assignGlobal ( 'uploadPath', UPLOAD_LOCAL_PATH );
			$templateFile->assignGlobal ( 'imagePath', IMAGE_PATH );
			$templateFile->assignGlobal ( 'swfPath', SWF_PATH );
			
		}
		
		return $templateFile;
	}
	
	function trataLink($texto) {
		$texto = $this->tira_acento ( $texto );
		$texto = strtolower ( $texto );
		$texto = str_replace ( ' ', '_', $texto );
		$texto = ereg_replace ( "[^a-zA-Z0-9_]", "", strtr ( $texto, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_" ) );
		
		return $texto;
	}
	
	
}

?>