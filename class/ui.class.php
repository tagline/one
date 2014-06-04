<?php

abstract class UI
{
  
  var $templateFile; // Arquivo do template
  
  function prepareTemplate ($secao='',$templateFile='') {
    global $url;
                            
    $this->templateFile = ($templateFile != '' ? $templateFile : MODS_PATH.$secao."/secao.tpl");
    
    if ($this->templateFile != '') {
    	
      	$this->template = new TemplatePower($this->templateFile);
      	$this->template->prepare();              
  		
      	$this->template->assignGlobal('localPath',LOCAL_PATH);
  		  $this->template->assignGlobal("uploadPath",UPLOAD_LOCAL_PATH);
  		  $this->template->assignGlobal("imagePath",IMAGE_PATH);
  		  $this->template->assignGlobal("swfPath",SWF_PATH);
  		  $this->template->assignGlobal('urlAreaProfessor', URL_AREA_PROFESSOR);
		    $this->template->assignGlobal('urlAreaAluno', URL_AREA_ALUNO);
		    $this->template->assignGlobal('urlAreaAlunoNova', URL_AREA_ALUNO_NOVA);
		    $this->template->assignGlobal('urlCatalogoBiblioteca', URL_CATALOGO_BIBLLIOTECA);
		    $this->template->assignGlobal('urlMoodle', URL_MOODLE);		
      	
		    $this->template->assignGlobal($url->var);
		
    }
    
  }

}

?>