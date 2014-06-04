<?php
        
class Menu
{
  
  /**
   * 
   * @return array
  */
  function getMenus(){
      global $geral;
     
      $rows = $geral->db->db_query("SELECT * FROM menu WHERE publicado=1 ORDER BY ordem ASC");
      
      if(count($rows)>0)
         return $rows;
      else
        return array();      	
  }
  
  /**
   * 
   * @return array
  */
  function getSubMenus($menu_id=0){
      global $geral;
     
      if($menu_id>0)
          $where = " AND menu_id=$menu_id ";
      else
          $where = "";
          
      $rows = $geral->db->db_query("SELECT * FROM submenu WHERE publicado=1 $where ORDER BY ordem ASC");
      
      if(count($rows)>0)
         return $rows;
      else
        return array();      	
  }
  

  
  /**
   * 
   * @return array
  */
  function getMenuFotos($secao,$secao_in=''){
      global $geral;
      
      if(trim($secao_in)!='')
        $where = " AND secao_in LIKE '".$secao_in."'";
      else
        $where = '';
            
      $rows = $geral->db->db_query("SELECT * FROM menu_foto WHERE secao LIKE '".trim($secao)."' $where ORDER BY RAND() LIMIT 1");
        
      if(count($rows)>0)
         return $rows[0]['foto'];
      else
        return array();      	
  }

  
}

?>