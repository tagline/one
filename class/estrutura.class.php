<?php

class Estrutura {
	
	function Prepara($metaTags = array(), $openGraphMetaTags = array()) {
		global $geral;
		
		$url = new url ( $_SERVER ['REQUEST_URI'] );		
		$url->getHtmlInfo ();
		
		$metaTags['TITLE'] = ($url->title != '' ? $url->title . ' - ' : '') . TITLE;
		$metaTags['DESCRIPTION'] = $url->description;
		$metaTags['KEYWORDS'] = $url->keywords;
		
		if ($_GET ['ajax'])
			$pageLayout = "noLayout.tpl";
		else
			$pageLayout = "structure.tpl";
		
		$HTML = new htmlStructure ( "structure.tpl" );
		$HTML->configPage ();
		$HTML->makeLog = FALSE;
		$HTML->metaTags = $metaTags;
		
		$HTML->printPage ();
	
	}
	
	function Finaliza() {
		
		global $geral;
		
		$html = ob_get_contents ();
		
		ob_end_clean ();
		
		echo $html;
		die ();
	
	}

}

?>