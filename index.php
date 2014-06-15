<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
//error_reporting(E_ALL); 
       
ini_set('max_execution_time','9999999');
ob_start();
Header("Content-type: text/html; charset=iso-8859-1");
session_start();

require_once("cfg/cfg.site.php");
require_once("cfg/cfg.main.php");

$geral = new Geral();
$db       =  $geral->db;
$sessao   =  $geral->sessao;
$core     =  $geral->core;

/**********************************************************************/
/// CONFIGURA O BANCO DE ACORDO COM O SERVIDOR E CRIA O OBJETO
$db = new edz_db(DB_HOST, DB_USER, DB_PASS, DB_BASE);
/**********************************************************************/

// Processa Uploads com Ajax
if ($_GET['ajaxUpload']) {
  echo $core->processaAjaxUploads();
  die;
}

// IMPORTA CLASSES DO SISTEMA
//$geral->importaDependenciaModulo('classes');

$url	= new url($_SERVER['REQUEST_URI']);    
$url->convertGET();
                  

if($_GET['on'] == "" || $_GET['on'] == "home") {
	$on = 'capa';
	$_GET['on'] = $on;
}
else {
	$on = $_GET['on'];
}
$in = $_GET['in'];

if (isset($_POST['secao']))
	$on = $_POST['secao'];

$include = MODS_PATH."$on/secao.php";

### CONTEUDO ###
if(!is_file($include))
	$include = MODS_PATH.'capa/secao'.".php";

include($include);

### ENCERRA A CONEXAO COM O DB ###
$db->db_close();

?>
