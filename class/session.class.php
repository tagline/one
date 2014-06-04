<?php

class Sessao {
	
  function Sessao () {
    session_set_cookie_params(0,DIRETORIO);
    session_start(); //habilita controle de sessão
  }
  function set ($strVarName, $strContents) {
    $_SESSION[$strVarName] = $strContents;
  }
  function get ($strVarName) {    
    return (isset($_SESSION[$strVarName]) ? $_SESSION[$strVarName] : 0);
  }
  function unsetDado ($strVarName) {
      unset($_SESSION[$strVarName]);
  }  
  function destroy() {
    session_destroy();
  }
  function start() {
    session_start();
  }
  function restart() {
  	session_destroy();
    session_start();
  }
  function php_version_ge ($vercheck) {
    $minver = explode('.', $vercheck);
    $curver = explode('.', phpversion());
    return !(($curver[0] < $minver[0]) || (($curver[0] == $minver[0])
           && ($curver[1] < $minver[1])) || (($curver[0] == $minver[0])
           && ($curver[1] == $minver[1]) && ($curver[2][0] < $minver[2][0])));
  }
  
  
 function debug () {
 	echo "<PRE>";
 	print_r($_SESSION);
 	
 }
  
}


?>