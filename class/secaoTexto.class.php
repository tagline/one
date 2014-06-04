<?php

//------------------------------------------------
// CLASSE QUE EFETUA CONSULTAS NO BANCO E RETORNA LISTAS DE VALORES
//------------------------------------------------
class SecaoTexto
{
                   
  function getTexto($secao,$secao_in='',$secao_ac='') {
    global $geral;
    
    $where = array();
              
    if ($secao != '')
      $where[] = " secao = '$secao'";
    
    if ($secao_in != '')
      $where[] = " secao_in = '$secao_in'";
    else $where[] = "(secao_in IS NULL OR secao_in = '')";
    
    if ($secao_ac != '')
      $where[] = " secao_ac = '$secao_ac'";
    
    $where = implode(' AND ',$where); 
         
        
    $sql = "SELECT * FROM texto WHERE $where";
    $rows = $geral->db->db_query($sql);
    //echo $sql;
    
    // ADICIONA STYLE NOS TEXTOS SEMPRE QUE ENCONTRAR {}  
    $rows[0]['texto'] = str_replace("{imagePath}",IMAGE_PATH,$rows[0]['texto']);
    $rows[0]['texto'] = str_replace("{","<h2>",$rows[0]['texto']);
    $rows[0]['texto'] = str_replace("}","</h2>",$rows[0]['texto']);
    
    $rows[0]['arquivo_original'] = $rows[0]['arquivo'];
    if (is_file(UPLOAD_PATH.$rows[0]['arquivo']))
    	$rows[0]['arquivo'] = "<p><a href='".UPLOAD_LOCAL_PATH.$rows[0]['arquivo']."' target='_blank'><B>Veja Aqui</B></a></p>";
    else $rows[0]['arquivo'] = '';
    
    return $rows[0];
    
  }
 
  function getTextos($secao) {
    global $geral;
    
    $where = array();
          
    if ($secao != '')
      $where[] = " secao = '$secao'";
    
    $where = implode(' AND ',$where); 
         
    $sql = "SELECT * FROM texto WHERE $where";
    $rows = $geral->db->db_query($sql);
   
    return $rows;
    
  }
  
  
}

?>