<?php
/// CLASSE PARA PAGINAR RESULTADOS
// FUN��O processar() RECEBE A SQL DIVIDA EM VARIAVEIS
// FUN��O processarSQL() RECEBE A SQL INTEIRA NUMA STRING

global $geral;

class paginar {

	var $variaveis = array();
	var $paginas = array();
	var $mysql = array();
	var $mensagens = array();
	
	//NUMERO DE RESULTADOS POR P�GINA
	var $numero; 
	//variavel passada por url para o link das p�ginas. Ex: localhost/teste.php?pagina=1 -> 'pagina'
	var $url;    
	// ANCORA PARA O RETORNO
	var $ancora; 
	// Total de resultados
	var $total_resultados;
	
	
	
	function paginar() {
		
		$this->variaveis['SEPARADOR'] = " "; // separador da barra de nave��o das p�ginas
		
		if(!$this->paginas['PAGINA']) 
			$this->paginas['PAGINA'] = 1; // p�gina atual, caso n�o informada o padr�o � 1
		
		// MENSAGENS
		$this->mensagens['SEM_RESULTADOS'] = "";
		$this->mensagens['MYSQL_ERRO_LINK'] = "<b>ERRO NO MYSQL</b>";
		
	}
	/*
	processar()
	@param string $query 
	
	faz uma consultado com $query e define os resultados para constru��o da barra
	*/
	function processar($strTable, $strFields, $strWhere='', $strOrderBy = '', $intLimit = '', $strGroupBy = '') {
		
		// n�mero m�ximo de resultados exibidos por p�gina
		$this->paginas['POR_PAGINA'] = $this->numero; 
		
		$strQuery = 'SELECT '.$strFields; 
		
		if ($strTable) {
	      $strQuery .= ' FROM ';
	      if (is_array($strTable))
	        foreach ($strTable as $tbl)
	          $strQuery .= $this->tblprefix.$tbl.' ';
	      else                        
	        $strQuery .= $this->tblprefix.$strTable;
	    }
	    
	    if ($strWhere) $strQuery   .= ' WHERE '.$strWhere;
	    if ($strGroupBy) $strQuery .= ' GROUP BY '.$strGroupBy;
	    if ($strOrderBy) $strQuery .= ' ORDER BY '.$strOrderBy;
	    if ($intLimit) $strQuery   .= ' LIMIT '.$intLimit;
		
	    $query = $strQuery;
	    
      /// RETORNA O VALOR TOTAL, SEM LIMIT
      $this->mysql['TOTAL'] = ($this->mysql['LINK'] ? pg_num_rows(pg_query($query,$this->mysql['LINK'])) : pg_num_rows(pg_query($query))); 
      
      /// RETORNA A CONSULTA J� COM O LIMIT
      $this->mysql['QUERY'] = $query." LIMIT ".$this->paginas['POR_PAGINA']." OFFSET ".(($this->paginas['PAGINA']-1)*$this->paginas['POR_PAGINA']); 
      
      /// TOTAL DE P�GINAS BASEADAS NO TOTAL DE RESULTADOS E NO M�XIMO DE RESULTADOS POR P�GINA
      $this->paginas['TOTAL'] = ceil($this->mysql['TOTAL']/$this->paginas['POR_PAGINA']);
      
      $total_resultados = $this->mysql['TOTAL']; 
      
		
	}

	function processarSQL($strQuery) {
		
		// n�mero m�ximo de resultados exibidos por p�gina
		$this->paginas['POR_PAGINA'] = $this->numero; 
        
	  $query = $strQuery;
	     
	  // RETORNA O VALOR TOTAL, SEM LIMIT
		$this->mysql['TOTAL'] = ($this->mysql['LINK'] ? @mysql_num_rows(mysql_query($query,$this->mysql['LINK'])) : @mysql_num_rows(mysql_query($query))); 
		  
		/// RETORNA A CONSULTA J� COM O LIMIT
    $queryLimit = $query." LIMIT ".$this->paginas['POR_PAGINA']." OFFSET ".(($this->paginas['PAGINA']-1)*$this->paginas['POR_PAGINA']); 
    $this->mysql['TOTAL_LIMIT'] = ($this->mysql['LINK'] ? @mysql_num_rows(mysql_query($queryLimit,$this->mysql['LINK'])) : @mysql_num_rows(mysql_query($queryLimit)));  
	
		// TIRA O LIMIT DA CONSULTA, SE J� EXISTE
		if (ereg("LIMIT",$query)) {
			
			$limit_pos = strpos($query,"LIMIT");
			$query = substr($query,0,$limit_pos);
		
		}
		  
    if($this->paginas['PAGINA'] < 1)
      $this->paginas['PAGINA'] = 1;
		
		// RETORNA A CONSULTA J� COM O LIMIT
		//$this->mysql['QUERY'] = $query." LIMIT ".$this->paginas['POR_PAGINA']." OFFSET ".(($this->paginas['PAGINA']-1)*$this->paginas['POR_PAGINA']); 
		$this->mysql['QUERY'] = $query." LIMIT ".(($this->paginas['PAGINA']-1)*$this->paginas['POR_PAGINA']).",".$this->paginas['POR_PAGINA']; 
	
		/// TOTAL DE P�GINAS BASEADAS NO TOTAL DE RESULTADOS E NO M�XIMO DE RESULTADOS POR P�GINA
		$this->paginas['TOTAL'] = ceil($this->mysql['TOTAL']/$this->paginas['POR_PAGINA']);
    
    // TOTAL DE RESULTADOS DA CONSULTA
    $this->total_resultados = $this->mysql['TOTAL']; 
		
	}	
	
	function imprimir_paginas($url=false) {///// IMPRIME A LISTAGEM DE P�GINAS
		$this->variaveis['PAGINA'] = $this->url."/pagina"; 
	
		$paginas = "";
	
		if($this->paginas['TOTAL'] > 1) {
			for($i=0;$i<$this->paginas['TOTAL'];$i++) { 
				
				/// TESTA SE � A P�GINA ATUAL
				if ($i+1 != $this->paginas['PAGINA']) 
					$link = "<a class='off' href=\"".(strstr($url,'?') ? "/".$this->variaveis['PAGINA']."/".($i+1) : " ".$this->variaveis['PAGINA']."/".($i+1))."\">";
				else 
					$link = "<a class='on' href='javascript:;'> ";  
				  
					
				if ($i >= $this->paginas['PAGINA'] - 6 && $i <= $this->paginas['PAGINA'] + 6)
					$paginas .= "$link".($i+1 == $this->paginas['PAGINA'] ? ($i+1)."</a>" : ($i+1))."</a>&nbsp;".($i < $this->paginas['TOTAL']-1 ? '  ' : false);
			}
		}
		else 
			$paginas = $this->mensagens['SEM_RESULTADOS'];
			
		return $paginas;
		
	}	
	
	function imprimir_pagina_atual() {///// IMPRIME QUAL P�GINA EST�
		
		if($this->paginas['TOTAL'] > 1) 
			$pagina = $this->paginas['PAGINA'];
		else 
			$pagina = $this->mensagens['SEM_RESULTADOS'];
		
		return $pagina;
			
	}

	function link_pagina_anterior() {
		// RETORNA UM LINK EM AJAX PARA A P�GINA ANTERIOR
		
		
		if ($this->paginas['PAGINA'] > 1) {
			
			$linkpaginas = "pagina/".($this->paginas['PAGINA']-1);
			
			$link = "$this->url/$linkpaginas";
			
		}
		else return '#';

		return $link;
			
	}
	
	function link_pagina_proxima() {
		
		if ($this->paginas['PAGINA'] < $this->paginas['TOTAL']) {
			
			$linkpaginas = "pagina/".($this->paginas['PAGINA']+1);

			$link = "$this->url/$linkpaginas";
			
		}
		else return '#';

		return $link;
			
	}
	
	function link_pagina_primeira() {
		
		if ($this->paginas['PAGINA'] > 1) {
			
			$linkpaginas = "pagina/1";
			
			$link = "$this->url/$linkpaginas";
		
		}
			
		else return '#';

		return $link;
			
	}
	
	function link_pagina_ultima() {
		
		if ($this->paginas['PAGINA'] < $this->paginas['TOTAL']) {
			
			$linkpaginas = "pagina/".$this->paginas['TOTAL'];
			
			$link = "$this->url/$linkpaginas";
			
		}
		else 
			return '#';

		return $link;
			
	}
	
	function getHTML () {
	
    if ($this->paginas['TOTAL'] > 1) {
	 
    	$TPLV = new TemplatePower(TEMPLATE_PATH."paginacao.tpl");
    	$TPLV->assign("imagePath",IMAGE_PATH);
    	$TPLV->assign("localPath",LOCAL_PATH);
    	$TPLV->prepare();
      
      $TPLV->assign("numero",$this->mysql['TOTAL_LIMIT']);
      $TPLV->assign("total",$this->mysql['TOTAL']);           	    
            	    
  		$TPLV->assign("paginacao_anterior",$this->link_pagina_anterior());
  		$TPLV->assign("paginacao_proxima",$this->link_pagina_proxima());
  		$TPLV->assign("paginacao_primeira",$this->link_pagina_primeira());
  		$TPLV->assign("paginacao_ultima",$this->link_pagina_ultima());
  		$TPLV->assign("paginas",$this->imprimir_paginas());
  		$TPLV->assign("pagina",$this->imprimir_pagina_atual());
  		
  		return $TPLV->getOutputContent();
  		
	  }
    	       		
	}
	
	
	
}

?>
