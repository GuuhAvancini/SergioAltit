<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
$_SESSION['versaoSistema'] = "1.0";
$sqlCliente = "SELECT * FROM `clientesHadnet`";
$queryCliente = mysql_query($sqlCliente);
$resultadoCliente = mysql_fetch_assoc($queryCliente);
$_SESSION['clienteNome'] = $resultadoCliente['nomeCliente'];

if($_GET['login'] == "false"){
$erro = "alert('Usuário ou senha inválidos, tente novamente...')";	
}


if($_GET['op'] == "logar"){
$usuario = (isset($_POST['login'])) ? $_POST['login'] : '';
$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

global $_SG;
$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
$nusuario = addslashes($usuario);
$nsenha = addslashes($senha);
$sql = "SELECT * FROM `users` WHERE ".$cS." `usuarioAcesso` = '".$nusuario."' AND ".$cS." `senhaAcesso` = '".$nsenha."' and isAtivo = '1' LIMIT 1";
$query = mysql_query($sql);
$resultado = mysql_fetch_assoc($query);
if (empty($resultado)) {
	$erro = "alert('Usuário ou senha inválidos, tente novamente...')";	
} else {

	$datalogin = date('d/m/Y - H:m:s');
	$query = mysql_query("UPDATE `users` SET `ultimoLogin` = '".$datalogin."' WHERE `idUser` = '".$resultado['idUser']."' ") or die(mysql_error());
	
	//if($resultado['idUser'] == "1"){
	
	$_SESSION['usuarioID'] = $resultado['idUser']; 
	$_SESSION['usuarioNome'] = $resultado['nomeUsuario']; 
	$_SESSION['ultimologin'] = $resultado['ultimoLogin'];
	$_SESSION['codigoCliente'] = $resultado['codigoCliente'];
	
	
	$_SESSION['acervoAcesso'] = $resultado['acervoAcesso'];
	$_SESSION['leilaoAcesso'] = $resultado['leilaoAcesso'];
	$_SESSION['comitenteAcesso'] = $resultado['comitenteAcesso'];
	$_SESSION['compradorAcesso'] = $resultado['compradorAcesso'];
	$_SESSION['configsAcesso'] = $resultado['configsAcesso'];
	
	$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Se logou no sistema.\n";
	escrevelog($linhalog,$_SESSION['codigoCliente']);
	
	header("Location: index-home.php");
	
	//}

}
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema &gt; <?=$_SESSION['clienteNome']?></title>
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<style type="text/css">
body {
	background-repeat: no-repeat;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color:#f1f1f1;
	font-family: "Open Sans",sans-serif;
	color: #444;
    font-family: "Open Sans",sans-serif;
    font-size: 13px;
    line-height: 1.4em;
}

#conteudoCentro{
  width: 880px;
  margin: 0 auto;
  padding-top:60px;

  
}

#formlogin{
	width:270px;
	height:215px;
	background-color:#FFF;
	box-shadow: 0 1px 3px rgba(0,0,0,.13);
	padding:25px;
	font-weight: 400;
	
}
#formlogin p{
	float: left;
	color: #777;
    font-size: 14px;
	
}
#formlogin input{
	background: #fbfbfb;
	font-size: 24px;
    width: 100%;
    padding: 3px;
    border: 1px solid #ddd;
    box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    background-color: #fbfbfb;
    color: #333;
    
}
#bot{
	border:none;
	padding:10px;
	color: #FFF !important;
	background-color:#603002 !important;	
	margin-top:15px;
	width:100px !important;
	float:right;
	cursor:pointer;
	border-radius:5px;
	font-size: 16px !important;
	height:40px;
	margin-right:-10px;
}
#by{
	text-decoration: none;
    color: #999;
	margin-top:30px;
}
</style>
</head>

<body onload="<?=$erro?>">
<div id="conteudoCentro" align="center">
  <p><img src="images/logoSergio.jpg" width="156" height="197" /></p>
  <p>&nbsp; </p>
  <form id="formlogin" name="formlogin" method="post" action="?op=logar">
  <p>Nome de usuário</p>
<input name="login" id="login" type="text" />
<p>Senha</p>
<input name="senha" id="senha" type="password" />
<input name="bot" id="bot" type="submit" value="acessar" />
</form>
<p id="by"><img src="images/logohadnet.png" width="25" height="24" align="absmiddle"/> Had Net - Soluções para Internet - Telefone: (11) 2384-5301</p>
</div>
</body>
</html>
