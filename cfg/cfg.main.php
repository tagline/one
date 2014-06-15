<?php

//---------------------------------------
// DEFINIÇÕES OBRIGATÓRIAS DE SEGURANÇA
//---------------------------------------
ini_set('post_max_size',        99999999999);
ini_set('upload_max_filesize',  99999999999);
ini_set('max_execution_time',   99999999999);
ini_set('max_input_time',       99999999999);
ini_set('memory_limit',         99999999999);

if (eregi("cfg.framework.php",$_SERVER['PHP_SELF'])) {
    Header("Location: /404.php");
    die();
}

//---------------------------------------
// DEFINIÇÕES DE SEO
//---------------------------------------

define('TITLE', NOME);
define('META_TITLE', NOME);
define('DATECREATION', '20/05/2014');    // Data de criaçao do site
define('ROBOTS', 'index, all, follow');  // Serviços utilizados pelo site
define('REVISITAFTER', '1 days');        // Tempo para re-visitar site
define('CATEGORY', 'Internet');          // Categoria do site

//---------------------------------------
// CAMINHOS
//---------------------------------------
define("UPLOAD_PATH",      		$_SERVER['DOCUMENT_ROOT']."/".DIRETORIO."upload/"					      );
define("UPLOAD_LOCAL_PATH",		"http://".$_SERVER["HTTP_HOST"]."/".DIRETORIO."upload/"		  );
define("GLOBAL_PATH",      		$_SERVER['DOCUMENT_ROOT']."/".DIRETORIO							            );
define("LOCAL_PATH",       		"http://".$_SERVER["HTTP_HOST"]."/".DIRETORIO	                );


//---------------------------------------
// FRAMEWORK
//---------------------------------------
define("CORE_CLASSE_PATH",        GLOBAL_PATH."class/");             // Classes da framework
define("SITE_CLASSE_PATH",        GLOBAL_PATH."class/");             // Classes do site
define("CLASSE_PATH",             GLOBAL_PATH."class/");             // Classes padrões

define("CORE_PURE_SCRIPT_PATH",   "core/scripts/");                       // Scripts
define("CORE_SCRIPT_PATH",        GLOBAL_PATH.CORE_PURE_SCRIPT_PATH);     // Scripts
define("CORE_LOCAL_SCRIPT_PATH",  LOCAL_PATH.CORE_PURE_SCRIPT_PATH);      // Scripts

define("PLUGIN_PURE_CLASSE_PATH","core/plugins/php/");                    // Scripts de plugin (adicionais)
define("PLUGIN_CLASSE_PATH",      GLOBAL_PATH.PLUGIN_PURE_CLASSE_PATH);            // Classes de plugin (adicionais)
define("PLUGIN_LOCAL_CLASSE_PATH",LOCAL_PATH.PLUGIN_PURE_CLASSE_PATH);    // Classes de plugin (adicionais)
define("PLUGIN_PURE_SCRIPT_PATH","core/plugins/scripts/");                // Scripts de plugin (adicionais)
define("PLUGIN_SCRIPT_PATH",      GLOBAL_PATH.PLUGIN_PURE_SCRIPT_PATH);   // Scripts de plugin (adicionais)
define("PLUGIN_LOCAL_SCRIPT_PATH",LOCAL_PATH.PLUGIN_PURE_SCRIPT_PATH);    // Scripts de plugin (adicionais)


//---------------------------------------
// SISTEMA
//---------------------------------------
define("SYSTEM_PATH",           GLOBAL_PATH."system/");
define("SYSTEM_LOCAL_PATH",     LOCAL_PATH."system/");
define("SYSTEM_CLASSE_PATH",    SYSTEM_PATH."class/"); // Classes do sistema
define('MODULES_PURE_PATH', 	"mods/");
define('MODULES_PATH', 	        GLOBAL_PATH."mods/");
define('MODULES_LOCAL_PATH', 	LOCAL_PATH."mods/");

//---------------------------------------
// ESTRUTURA
//---------------------------------------
define("STRUCTURE_PATH",           GLOBAL_PATH."resources/");
define("STRUCTURE_LOCAL_PATH",     LOCAL_PATH."resources/");
define("TEMPLATE_CLASSE_PATH",     STRUCTURE_PATH."class/");
define("TEMPLATE_PATH",            STRUCTURE_PATH."templates/");
define("TEMPLATE_LOCAL_PATH",      STRUCTURE_LOCAL_PATH."templates/");
define("RESOURCE_PATH",            STRUCTURE_LOCAL_PATH);
define("RESOURCE_GLOBAL_PATH",     STRUCTURE_PATH);
define('MODS_PATH', 	           GLOBAL_PATH."mods/");
define("SCRIPT_PATH",              RESOURCE_PATH."scripts/");
define("SCRIPT_SERVER_PATH",       RESOURCE_GLOBAL_PATH."scripts/");
define("IMAGE_PATH",               RESOURCE_PATH."images/");
define("IMAGE_GLOBAL_PATH",        RESOURCE_GLOBAL_PATH."images/");
define("STYLE_PATH",               RESOURCE_PATH."styles/");
define("STYLE_SERVER_PATH",        RESOURCE_GLOBAL_PATH."styles/");

//---------------------------------------
// CLASSES
//---------------------------------------
define("CLASSE_HTML_STRUCTURE",          TEMPLATE_CLASSE_PATH."htmlStructure.class.php");
define("CLASSE_HTML",                    TEMPLATE_CLASSE_PATH."html.class.php");
define("CLASSE_POWER_TEMPLATE",          TEMPLATE_CLASSE_PATH."htmlPowerTemplate.class.php");
define("CLASSE_HTML_TEMPLATE",           TEMPLATE_CLASSE_PATH."htmlTemplate.class.php");
define("MYSQLDB_CLASS",                  CLASSE_PATH."db.class.php");

require_once(CORE_CLASSE_PATH.'main.php');
require_once(CORE_CLASSE_PATH.'geral.class.php');
require_once(CORE_CLASSE_PATH.'url.class.php');

?>
