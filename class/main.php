<?php


function toDecimal($valor){

	$valor = str_replace(".","",$valor);
	
	$valor = str_replace(",",".",$valor);
	
	if(strlen($valor) > 6){
		
		$valor = str_replace(",",".",$valor);
		//echo $valor."<br>";
		//$valor = $valor/100;
	}
	$valor = str_replace(",",".",$valor);
	//echo $valor.">".strlen($valor)."<br>";
	
	return $valor;

}

function toVal($valor,$sigla=FALSE){
	
	//$valor = str_replace(".","",$valor);
	$valor = number_format((float)$valor,2,",",".");
	if($sigla)
		return "R\$".$valor;
	else
		return $valor;
	
}

function captureGlobalInfo() {
   $info = "";
   $getPars = 0;
   $postPars = 0;

   // data e hora
   $info .= date("d/m/Y - H:i:s")."|";

   // parâmetros GET
   while (list($key,$value)=each($_GET)) {
          $info .= "Parâmetro Get ".(++$getPars).": ".$key."=>".$value."|";
   }

   // parâmetros POST
   while (list($key,$value)=each($_POST)) {
          $info .= "Parâmetro Post ".(++$postPars).": ".$key."=>".$value."|";
   }

   // dados básicos da sessão se ela existir
   if (defined("SESSION_OBJECT_NAME")) {
     if (isset($_SESSION[constant("SESSION_OBJECT_NAME")])) {
       $SESSION_OBJECT = $_SESSION[constant("SESSION_OBJECT_NAME")];
       $info .= "Usuário de Sessão : ".$SESSION_OBJECT->getBasicInfo()."|";
     }
   }
   return $info;
}


function getMes($month){
	
	switch($month){
		case '1':
		case '01':
			$nmonth = 'Janeiro';
		break;
		case '2':
		case '02':
			$nmonth = 'Fevereiro';
		break;
		case '3':
		case '03':
			$nmonth = 'Março';
		break;
		case '4':
		case '04':
			$nmonth = 'Abril';
		break;
		case '5':
		case '05':
			$nmonth = 'Maio';
		break;
		case '6':
		case '06':
			$nmonth = 'Junho';
		break;
		case '7':
		case '07':
			$nmonth = 'Julho';
		break;
		case '8':
		case '08':
			$nmonth = 'Agosto';
		break;
		case '9':
		case '09':
			$nmonth = 'Setembro';
		break;
		case '10':
			$nmonth = 'Outubro';
		break;
		case '11':
			$nmonth = 'Novembro';
		break;
		case '12':
			$nmonth = 'Dezembro';
		break;

	}
	return $nmonth;
	
}

function userErrorHandler ($errno, $errmsg, $filename, $linenum, $vars) {
   // define um array associativo de strings
   // de erro onde as únicas entradas a serem
   // consideradas são 2,8,256,512 e 1024
   $errortype = array (
               1   =>  "Error",
               2   =>  "Warning",
               4   =>  "Parsing Error",
               8   =>  "Notice",
               16  =>  "Core Error",
               32  =>  "Core Warning",
               64  =>  "Compile Error",
               128 =>  "Compile Warning",
               256 =>  "User Error",
               512 =>  "User Warning",
               1024=>  "User Notice"
               );

   // define mensagens de erro que devem ser ignoradas
   $ignore_errors = array (
               "UNDEFINED INDEX",
               "USE OF UNDEFINED CONSTANT"
               );

   // verifica se o erro capturado não corresponde
   // a algum tipo de erro que deve ser ignorado
   $trigger_error = TRUE;
   for ($i=0; $i<count($ignore_errors); $i++) {
       if (ereg($ignore_errors[$i],strtoupper($errmsg))) {
           $trigger_error = FALSE;
       }
   }
   if ($trigger_error) {
      // conjunto de tipos de erros para os quais será feito var trace
      $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

      // armazena os dados capturados pelo tratador de erros
      // número do erro, tipo do erro, mensagem de erro, arquivo e linha do código
      $err = $errno."|";
      $err .= $errortype[$errno]."|";
      $err .= $errmsg."|";
      $err .= $filename."|";
      $err .= $linenum."|";

      // realiza var trace para erros de usuário
      if (in_array($errno, $user_errors)) {
        ob_start();
        var_dump($vars);
        $err .= ob_get_contents();
        ob_end_clean();
      }

      // imprime o erro para visualização local
      if (LOCAL == "APOLO") {
        friendlyErrorMessage($err,$errortype[$errno]);
      }

      // salva no log de erros
      if (defined('PHP_ERROR_LOG_DEST')) {
         error_log(captureGlobalInfo().$err."<*>\n", 3, PHP_ERROR_LOG_DEST);
      }
      else {
         error_log(captureGlobalInfo().$err."<*>\n", 3, PHP_ERROR_LOG_DEST);
      }
   }
}

function friendlyErrorMessage($err,$type) {
   echo "<table cellspacing='0' border='1' bordercolor='#000000'>\n";
   echo "<tr><td align='left'><font color='#ff0000'><b>".strtoupper($type).":</b></font></td></tr>\n";
   echo "<tr><td align='left'>".str_replace("|",",",$err)."</td></tr>\n";
   echo "</table>\n";
}

function captureShutdown() {
   if (connection_aborted() && connection_timeout()) {
     $fp = fopen(GLOBAL_PATH."logs/php_timeout.txt","w+");
     fputs($fp,"Timeout já abortado!");
     fclose($fp);
   }
   else if (connection_timeout()) {
     $fp = fopen(GLOBAL_PATH."logs/php_timeout.txt","w+");
     fputs($fp,"Timeout!");
     fclose($fp);
   }
}

function alert($msg) {
  echo "<SCRIPT LANGUAGE='JavaScript'>\n";
  echo "  alert(\"".$msg."\");\n";
  echo "</SCRIPT>";
}

function confirm($msg,$true_action="",$false_action="") {
  if ($true_action != "") {
    $out .= "<SCRIPT>\n";
    $out .= "if (confirm(\"$msg\")) {\n";
    $out .= $true_action."\n";
    $out .= "}\n";
    if ($false_action != "") {
    $out .= "else {";
    $out .= $false_action."\n";
    $out .= "}";
    }
    $out .= "</SCRIPT>\n";
  }
  elseif ($false_action != "") {
    $out .= "<SCRIPT>\n";
    $out .= "if (!confirm(\"$msg\")) {\n";
    $out .= $false_action."\n";
    $out .= "}\n";
    $out .= "</SCRIPT>\n";
  }
  echo $out;
}

function closeWindow() {
  echo "<SCRIPT LANGUAGE='Javascript'>\n";
  echo "  if (parent) parent.close(); else window.close();\n";
  echo "</SCRIPT>\n";
}

function redirect($url,$object="document") {
  echo "<SCRIPT LANGUAGE='Javascript'>\n";
  echo "  ".$object.".location.href = \"".$url."\"\n";
  echo "</SCRIPT>\n";
}

function replace($url) {
  echo "<SCRIPT LANGUAGE='JavaScript'>\n";
  echo "  location.replace(\"".$url."\");\n";
  echo "</SCRIPT>\n";
}

function reload() {
  echo "<SCRIPT LANGUAGE='JavaScript'>\n";
  echo "reload()\n";
  echo "</SCRIPT>\n";
}

function refresh($url,$time=1) {
  echo "<META HTTP-EQUIV=\"refresh\" content=\"".$time."; URL=".$url."\">";
}

function focus($form,$field,$object="")
{
  if ($object != "") $object .= ".";
  echo "<SCRIPT>".$object."document.".$form.".".$field.".focus();</SCRIPT>\n";
}

function mouseOver($texto,$return=TRUE) {
  $mText = "TITLE='$texto' onMouseOver='window.status=\"$texto\";return true;'".
    "onMouseOut='window.status=\"\";return true;'";
  if ($return) {
    return $mText;
  }
  else {
    echo $mText;
  }
}

function HTML_navigator($HTTP_USER_AGENT)
{
  if (ereg("MSIE",$HTTP_USER_AGENT)) {
    return "iex";
  }
  else if (ereg("Opera",$HTTP_USER_AGENT)) {
    return "opr";
  }
  else if (ereg("Gecko",$HTTP_USER_AGENT)) {
    return "nav6";
  }
  else if (ereg("Mozilla",$HTTP_USER_AGENT)) {
    return "nav";
  }
  else return "xxx";
}

function navigator()
{
  $navAgent = @getenv("HTTP_USER_AGENT");
  if (ereg("MSIE",$navAgent)) {
    if (ereg("5.5",$navAgent)) {
      return "ie55";
    }
    else if (ereg("5",$navAgent)) {
      return "ie5";
    }
    elseif (ereg("6",$navAgent)) {
      return "ie6";
    }
    else return "ie4";
  }
  else if (ereg("Opera",$navAgent)) {
    return "opr";
  }
  else if (ereg("Gecko",$navAgent)) {
    return "nav6";
  }
  else if (ereg("Mozilla",$navAgent)) {
    return "nav";
  }
  else return "xxx";
}

function flashMovie($src,$wid=0,$hei=0,$arrPars=array()) {
  $srcP = $src;
  if (!empty($arrPars)) {
     $srcP .= "?";
     foreach($arrPars as $key=>$value) {
          $srcP .= $key."=".$value."&";
     }
     $srcP = substr($srcP,0,strlen($srcP)-1);
  }
  return sprintf("<OBJECT CLASSID='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' CODEBASE='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0'%s%s ALIGN='top'>
                  <PARAM NAME=movie VALUE='%s'>
                  <PARAM NAME='QUALITY' VALUE='high'>
                  <EMBED SRC='%s' QUALITY='high' PLUGINSPAGE='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash' TYPE='application/x-shockwave-flash'%s%s ALIGN='top' SCALE='exactfit'>
                  </EMBED>
                  </OBJECT>",
                  ($wid > 0) ? " WIDTH='".$wid."'" : "",
                  ($hei > 0) ? " HEIGHT='".$hei."'" : "",
                  $srcP,$src,
                  ($wid > 0) ? " WIDTH='".$wid."'" : "",
                  ($hei > 0) ? " HEIGHT='".$hei."'" : "");
}

function image($src,$alt="",$wid=0,$hei=0,$hspace=-1,$vspace=-1) {
  return sprintf("<IMG SRC='%s' BORDER='0'%s%s%s%s%s>",$src,
                 ($alt != "" ? " ALT='".$alt."'" : ""),
                 ($wid > 0 ? " WIDTH='".$wid."'" : ""),
                 ($hei > 0 ? " HEIGHT='".$hei."'" : ""),
                 ($hspace > -1 ? " HSPACE='".$hspace."'" : ""),
   ($vspace > -1 ? " VSPACE='".$vspace."'" : ""));
}

function button($name="btn",$text="Ok",$script="",$alt="Enviar",$type,$imgButton="")

{
  global $HTTP_USER_AGENT;
  $classb = ((HTML_navigator($HTTP_USER_AGENT) == "iex") || (HTML_navigator($HTTP_USER_AGENT) == "nav6")) ? "CLASS='boxlogin'" : "";
  $imageb = ($type == "image") ? "SRC='".$imgButton."'" : "";
  return "<INPUT TYPE='$type' $imageb NAME='ign_$name' VALUE='$text' $classb $script>";
}

function nobreakspace($n)
{
  return str_repeat('&nbsp;', $n);
}

function toMySQLDate($date)
{
  if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $date, $regs))
    return "$regs[3]/$regs[2]/$regs[1]";
}

function toMySQLCodeDate($date)
{
  if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $date, $regs))
    return "$regs[3]-$regs[2]-$regs[1]";
  if (ereg("([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $date, $regs))
    return "$regs[1]-$regs[2]-$regs[3]";
}

function toSQLDataNascimento($date)
{
  if (ereg("([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $date, $regs))
    return "0000-$regs[2]-$regs[1]";
  if (ereg("([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $date, $regs))
    return "00000-$regs[2]-$regs[3]";
}


function toBrDate($date)
{
  $aux=explode('-',$date);
  return ($aux[2].'/'.$aux[1].'/'.$aux[0]);
}

function dataHoje()
{
  $dia_semana=date('w');
  switch ($dia_semana){
    case 0:
      $dia_semana='Domingo';
      break;
    case 1:
      $dia_semana='Segunda';
      break;
    case 2:
      $dia_semana='Terça';
      break;
    case 3:
      $dia_semana='Quarta';
      break;
    case 4:
      $dia_semana='Quinta';
      break;
    case 5:
      $dia_semana='Sexta';
      break;
    case 6:
      $dia_semana='Sábado';
      break;
  }
  return 'Brasil, '.$dia_semana.', '.date('d/m/Y');
}

function alltrim($string)
{
  $aux = rtrim(ltrim($string));
  $pos = strpos($aux,"  ");
  while ($pos !== false) {
    $aux = str_replace("  "," ",$aux);
    $pos = strpos($aux,"  ");
  }
  return $aux;
}
// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO
// ----------------------------------------------------------------------------
function validaCampos ($form,$labels,$class) {
	$req = "_r";
	$c = 0;
	$av = "";
	
	foreach ($form as $key=>$value) {
		 		
		$v = substr($key,-2);
						
 		if($v == $req) { //campos obrigatorios
		
			$campo = substr($key,0,-2);
			//echo $campo."<br>";
			//echo $key.$labels[$campo]."->$value<br>";
			/*if(ereg('cpf', $campo)) { 
				if(!validaCPF($value)) { 
					$av .= geraAviso($labels[$campo],$class); ""; 
				} 
			}*/ 
			if(ereg('cnpj', $campo)) { 
				if(!validaCNPJ($value)) {
					$av .= geraAviso($labels[$campo],$class);
				}
			} 
			elseif(ereg('email', $campo)) { 
				if(!validaEmail($value)) {
					$av .= geraAviso($labels[$campo],$class);
				} 
			} 
			elseif(ereg('telefone', $campo)) {
				
				if(!validaTelefone($value)) {
					$av .= geraAviso($labels[$campo],$class); 
				}
			} 
			elseif(ereg('fone', $campo)) { 
				if(!validaTelefone($value)) {
					$av .= geraAviso($labels[$campo],$class); 
				}	
			} 
			elseif(ereg('_id', $campo) || ereg('id_', $campo)) { 
				if(empty($value) || $value == "-1") {
					$av .= geraAviso($labels[$campo],$class); 
				}	
			} 
			elseif(!isset($labels[$campo])) {
   					$av . geraAviso($labels[$campo],$class);
			} 
			else { 
				if(!validaString($value,"")) {
					$av .= geraAviso($labels[$campo],$class); 
				}
			} //else
		}
	} //foreach
	
	return $av;
}



function validaSenha($campoSenha,$cSenha){
	
	$err="";
	if($_POST[$campoSenha] != $_POST[$cSenha]){
	
		$err .= "<li> Senhas não  coincidem! </li><br>";
	}
	if(empty($_POST[$campoSenha]) || empty($_POST[$cSenha])){
	
		$err .= "<li> Campo senha ou confirmação de senha não podem ser vazios!</li><br>";
	}
	
	return $err;
	
}



// ----------------------------------------------------------------------------
// GERA A TABELA DE ACORDO COM AS PROPRIEDADES E O STRING DE AVISO PASSADO
// ----------------------------------------------------------------------------
function geraTabela ($tableprop,$av) {
	$tab = "<table $tableprop>";
	$tab .= "<tr><td>";
	//$tab .= "<ul>";
	$tab .= $av;
	//$tab .= "</ul>";
	$tab .= "</td></tr></table>";
	if($av != "") $tabela = $tab;
	else $tabela = "";
	return $tabela;

}

// ----------------------------------------------------------------------------
// FUNÇÃO GERA AVISO PADRÃO
// ----------------------------------------------------------------------------
function geraAviso ($campo,$class) {
	$str = "<li class='$class'>Campo $campo inválido";
	return $str;
}

// ----------------------------------------------------------------------------
// FUNÇÃO GERA AVISO PERSONALIZADO
// ----------------------------------------------------------------------------
function geraAviso2 ($texto,$class) {
	$str = "<li class='$class'>$texto";
	return $str;
}

// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO DE CPF
// ----------------------------------------------------------------------------
function validaCPF($cpf) {
	if (strlen($cpf) <> 12) return 0;

	$soma1 = ($cpf[0] * 10) +
				($cpf[1] * 9) +
				($cpf[2] * 8) +
				($cpf[3] * 7) +
				($cpf[4] * 6) +
				($cpf[5] * 5) +
				($cpf[6] * 4) +
				($cpf[7] * 3) +
				($cpf[8] * 2);
	$resto = $soma1 % 11;
	$digito1 = $resto < 2 ? 0 : 11 - $resto;

	$soma2 = ($cpf[0] * 11) +
				($cpf[1]  * 10) +
				($cpf[2]  * 9) +
				($cpf[3]  * 8) +
				($cpf[4]  * 7) +
				($cpf[5]  * 6) +
				($cpf[6]  * 5) +
				($cpf[7]  * 4) +
				($cpf[8]  * 3) +
				($cpf[10] * 2);
	$resto = $soma2 % 11;
	$digito2 = $resto < 2 ? 0 : 11 - $resto;

	return (($cpf[10] == $digito1) && ($cpf[11] == $digito2));
}

// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO DE CNPJ
// ----------------------------------------------------------------------------
function validaCNPJ($CampoNumero)
  {
  	/*
   $RecebeCNPJ=${"CampoNumero"};

   $s="";
   for ($x=1; $x<=strlen($RecebeCNPJ); $x=$x+1)
   {
	$ch=substr($RecebeCNPJ,$x-1,1);
	if (ord($ch)>=48 && ord($ch)<=57)
	{
	 $s=$s.$ch;
	}
   }

   $RecebeCNPJ=$s;
   if (strlen($RecebeCNPJ)!=14)
   {
	   RETURN false;
   }
   else
	if ($RecebeCNPJ=="00000000000000")
	{
	 $then;
	 RETURN false;
   }
   else
   {
	$Numero[1]=intval(substr($RecebeCNPJ,1-1,1));
	$Numero[2]=intval(substr($RecebeCNPJ,2-1,1));
	$Numero[3]=intval(substr($RecebeCNPJ,3-1,1));
	$Numero[4]=intval(substr($RecebeCNPJ,4-1,1));
	$Numero[5]=intval(substr($RecebeCNPJ,5-1,1));
	$Numero[6]=intval(substr($RecebeCNPJ,6-1,1));
	$Numero[7]=intval(substr($RecebeCNPJ,7-1,1));
	$Numero[8]=intval(substr($RecebeCNPJ,8-1,1));
	$Numero[9]=intval(substr($RecebeCNPJ,9-1,1));
	$Numero[10]=intval(substr($RecebeCNPJ,10-1,1));
	$Numero[11]=intval(substr($RecebeCNPJ,11-1,1));
	$Numero[12]=intval(substr($RecebeCNPJ,12-1,1));
	$Numero[13]=intval(substr($RecebeCNPJ,13-1,1));
	$Numero[14]=intval(substr($RecebeCNPJ,14-1,1));

	$soma=$Numero[1]*5+$Numero[2]*4+$Numero[3]*3+$Numero[4]*2+$Numero[5]*9+$Numero[6]*8+$Numero[7]*7+
	$Numero[8]*6+$Numero[9]*5+$Numero[10]*4+$Numero[11]*3+$Numero[12]*2;

	$soma=$soma-(11*(intval($soma/11)));

   if ($soma==0 || $soma==1)
   {
	 $resultado1=0;
   }
   else
   {
	$resultado1=11-$soma;
   }
   if ($resultado1==$Numero[13])
   {
	$soma=$Numero[1]*6+$Numero[2]*5+$Numero[3]*4+$Numero[4]*3+$Numero[5]*2+$Numero[6]*9+
	$Numero[7]*8+$Numero[8]*7+$Numero[9]*6+$Numero[10]*5+$Numero[11]*4+$Numero[12]*3+$Numero[13]*2;
	$soma=$soma-(11*(intval($soma/11)));
	if ($soma==0 || $soma==1)
	{
	 $resultado2=0;
	}
   else
   {
   $resultado2=11-$soma;
   }
   if ($resultado2==$Numero[14])
   {
	RETURN true;
   }
   else
   {
   RETURN false;
   }
  }
  else
  {
   RETURN false;
  }
  
 }
 */
  	return true;
}

// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO DE EMAIL
// ----------------------------------------------------------------------------
function validaEmail($email){
	if( !ereg( "^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_\,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email ) ){
		return false;
	} else {
		return true;
	}
}

// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO DE CAMPO STRING
// ----------------------------------------------------------------------------
function validaString ($string,$len=4) {
	if(strlen($string) < $len || $string == "") return false;
	return true;
}

// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO DE CAMPO TELEFONE
// ----------------------------------------------------------------------------
function validaTelefone ($string) {

	//if(is_int($string)) 
	return true;
	//return false;
}

// ----------------------------------------------------------------------------
// FUNÇÃO DE VALIDAÇÃO DE CAMPO DATA
// ----------------------------------------------------------------------------
function validaData ($data) {
	if(is_int(substr($data,0,2)) && $data[2] == "/" && is_int(substr($data,3,2)) && $data[5] == "/" && is_int(substr($data,6,4))) return true;
	return false;
}
?>