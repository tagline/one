<?php

#################################
############# CFG ###############
#################################
if (eregi ( "cfg.site.php", $PHP_SELF )) {
	Header ( "Location: /404.php" );
	die ();
}

####################################
####### CONFIGURAÇÕES BÁSICAS ######
####################################
define("DOMINIO", 'one.com.br'); // DOMÍNIO
define('TITLE', 'ONE'); // Título do site
define('DESCRIPTION', 'ONE');
define('ROBOTS', 'nofollow');
define('IDENTIFIER-URL', '');
define('VERIFY-V1', '');                   
define('AMBIENTE', 'HOMOLOG');
define('GOOGLE_ANALYTICS', ""); // Codigo completo com script
                               
####################################
###### CONFIGURAÇÕES OPEN GRAPH ####
####################################
define('OG_TITLE', 'ONE');
define('OG_IMAGE', IMAGE_PATH.'logotipo.png');
define('OG_DESCRIPTION', DESCRIPTION);
define('OG_TYPE', 'website');
define('OG_SITE_NAME', TITLE );

define('FACEBOOK','');
define('TWITTER', '');
  
#################################
######### BANCO DE DADOS ########
#################################

define("DB_HOST", "mysql.desenv.zipernet.com.br"); // Localhost ou mysql.host.com.br
define("DB_USED", "mysql");    // Banco de Dados a ser usado
define("DB_USER", "desenv72"); // Nome do Usuario
define("DB_PASS", "engsoft"); // Senha do Usuario
define("DB_BASE", "desenv72"); // Banco de Dados

/*
define("DB_HOST", "localhost"); // Localhost ou mysql.host.com.br
define("DB_USED", "mysql");    // Banco de Dados a ser usado
define("DB_USER", "root"); // Nome do Usuario
define("DB_PASS", "123456"); // Senha do Usuario
define("DB_BASE", "one"); // Banco de Dados
*/
#######################################
############## CONTATO ################
#######################################
define('EMAIL', 			  'tagline.treichel@gmail.com');       
define('EMAIL_ADMIN', 		  'tagline.treichel@gmail.com');
define('EMAIL_DEBUG', 		  'tagline.treichel@gmail.com');  
 
//OBS: EMAILS DO CLIENTE ESTÃO CONFIGURADOS DINAMICAMENTE NOS FORMULÁRIOS DE CONTATO.
                            
$diretorio = dirname ( $_SERVER ['SCRIPT_NAME'] );

if (substr($diretorio,0,1) == '/')
	$diretorio = substr($diretorio,1);

if ($diretorio != '')
	$diretorio = $diretorio.'/';

define ( "DIRETORIO", $diretorio );

?>