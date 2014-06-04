<?php

class url {
	
	private $queryString;
	private $varString;
	private $id;
	public $title;
	public $description;
	public $keywords;
	public $image;
	
	function __construct($queryString) {
		global $geral, $db;
		
		$queryString = utf8_decode ( urldecode ( $queryString ) );
		
		if (DIRETORIO != '')
			$queryString = str_replace ( array ('/' . DIRETORIO,strtolower(DIRETORIO) ), '', $queryString );
		
			
		$arrayString = explode ( '|', $queryString );
		
		$this->queryString = mysql_real_escape_string ( $arrayString [0] );
		$this->varString = mysql_real_escape_string ( $arrayString [1] );
		
		//$this->getHtmlInfo ();
	}
	
	function convertGET() {
		
		$queryString = $this->queryString;
		
		// tratamento da url, quando vem com lixo
		$queryString = str_replace("?","/?",$queryString);
		$queryString = str_replace("//?","/?",$queryString);
		
		$queryString = strip_tags ( $queryString );
		$queryString = str_replace ( "/", "*", $queryString );
		
		$url = explode ( '*', $queryString );
		
		foreach ( $url as $key => $value ) {
			switch ($key) {
				case '0' :
				case '1' :
				case '2' :
					if ($value == '' || $value == DIRETORIO)
						unset ( $url [$key] );
					else
						$urls [] = $value;
					break;
				default :
					$urls [] = $value;
					break;
			}
		}
		
		$_GET ['on'] = $_REQUEST ['on'] = $urls [0];
		$_GET ['in'] = $_REQUEST ['in'] = $urls [1];
		$_GET ['ac'] = $_REQUEST ['ac'] = $urls [2];
		$_GET ['id'] = $_REQUEST ['id'] = $urls [3];
		$_GET ['pagina'] = $_REQUEST ['pagina'] = $urls [4];

		if ($urls [5] == 'pagina')
			$_GET ['id'] = $_REQUEST ['id'] = $urls [6];
		
		if (! $_GET ['on'] || $_GET['on'] == 'idc')
			$_GET ['on'] = 'capa';
	
	}
	
	function getHtmlInfo() {
		global $db;
		if (substr($this->queryString,0,1) == '/')
			$this->queryString = substr($this->queryString,1);
		
		$vars = explode ( '/', $this->queryString );
		$on = $vars [0];
		$in = $vars [1];
		$ac = $vars [2];
		
		if ($on != '')
		  $url = $on;
		  
		if ($in != '')
		  $url .= '/'.$in;
		  
		if ($ac != '')
		  $url .= '/'.$ac;
		
		
		$sql = "SELECT * FROM secaosite WHERE secao = '$on' LIMIT 1";
		$rows_on = $db->db_query ( $sql );
		
		
		$sql = "SELECT * FROM secaosite WHERE secao = '$url' ";  
		$rows = $db->db_query ( $sql );
			
		// Se nao tem IN na seзгo, busca o on
		if (count ( $rows ) == 0) {
			$sql = "SELECT * FROM secaosite WHERE secao = '$on/$in' LIMIT 1";
			$rows = $db->db_query ( $sql );
		}
		
	    $secao = $rows [0];
			
	    if ($rows_on[0]['title'] != $secao['title'])                      
			  $secao['title'] = $rows_on[0]['title'] . ' - '.$secao['title'];
			          
			if (count ( $rows ) == 0)
			  $secao = $rows_on [0];
			 
			$this->title = $secao ['title'];
			$this->description = $secao ['description'];
			$this->keywords = $secao ['keywords'];
		        
				
		// Se nao tem IN na seзгo, busca o on
		if ($secao['secao_tabela'] != '' && $_GET ['id'] > 0) {
			$sql = "SELECT * FROM {$secao['secao_tabela']} WHERE {$secao['secao_tabela']}_id = '{$_GET['id']}' LIMIT 1";
			
			$rows = $db->db_query ( $sql );
			$registro = $rows [0];
			                                   
			if(trim($registro['meta_title'])!= "")
				$this->title = $registro['meta_title'];
			else
				$this->title = $this->title. ' - '.($registro ['titulo'] != '' ? $registro ['titulo'] : $registro ['nome']);
			
			
			if ($registro ['foto'] != '')
        $this->image = UPLOAD_LOCAL_PATH . $_GET ['on'] . '/' . $registro ['foto'];
        
			$this->description = substr(strip_tags($registro ['texto']),0,200);
			
			if ($this->description == '')
			 $this->description = $this->title;
			 
			if ($secao['secao_tabela'] == 'ecom_curso')
			 $this->description = "Conheзa esse curso da Faculdade IDC!";
			
			$this->keywords = $registro ['meta_keywords'];
		}
		
		if ($secao['secao_tabela'] == 'site_texto' && $_GET ['in'] != '') {
			$sql = "SELECT * FROM {$secao['secao_tabela']} WHERE secao = '{$_GET['on']}' AND secao_in = '{$_GET['in']}' LIMIT 1";
				
			$rows = $db->db_query ( $sql );
			$registro = $rows [0];
				
			//$this->title = $registro ['titulo'];
			
			if ($registro ['foto'] != '')
			   $this->image = UPLOAD_LOCAL_PATH . $_GET ['on'] . '/' . $registro ['foto'];
			   
			$this->description = $registro ['meta_description'];
			$this->keywords = $registro ['meta_keywords'];
			
		}
	}
	
	

}

?>