<?php 
include("../admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '3'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);

if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}
$mobile = FALSE;

$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");

foreach($user_agents as $user_agent){

    if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;

        $modelo = $user_agent;

        break;
    }
}
if ($mobile){
	header("Location: /mobile/leiloeiro.php");
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127523056-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127523056-1');
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sérgio Altit - Leiloeiro</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #f4f4f5;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 15px;
    line-height: 1.428571429;
    -webkit-font-smoothing: antialiased;
	color:#666666;
}
#topo{
	height:120px;
	background-color:#231f20;
	color:#FFF;	
}
#conteudo{
    width: 1200px;
    margin: 0 auto;
}
#rodape{
	margin-top:20px;
	font-size:12px;
		
}
.menu-ag, .menu-ag * {
	list-style:		none;
	float:			right;
	text-decoration: none;
  	font-size: 		15px;
	margin-left:	3px;
	margin-right:	3px;
	margin-top:		20px;
	right:			10px;
	color:			#FFF;
	padding:		5px;
	
	
}
#conteudoTxt{
	margin-bottom:40px;	
}
#redesSociais{
	position: absolute;
	top: 5px;
	padding-left:830px;
	
}
</style>
</head>

<body>
<div id="topo">
 <div id="conteudo">
  <img src="images/logo-altit.png" width="227" height="103" />
  <div id="redesSociais"><span style="margin-right:50px; font-weight:bold; font-size:18px;"><a href="https://www.facebook.com/sergioaltitileiloes/" target="_blank"><img src="images/face-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <a href="https://www.instagram.com/sergioaltitleiloes/" target="_blank"><img src="images/insta-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <img src="images/tel-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /> Telefone: (11) 3721 9676</span></div>
  <ul class="menu-ag">
      <li><a href="contato.php">CONTATO</a></li>
      <li><a href="leiloes.php">LEILÕES</a></li>
      <li><a href="artistas.php">ARTISTAS</a></li>
      <li><a href="leiloeiro.php">O LEILOEIRO</a></li>
      <li><a href="index.php">HOME</a></li>
    </ul>
  </div>
</div>
<div id="fotoHome">
	<div id="conteudo">
    	<div id="conteudoTxt">
            <div align="center" style="margin-top:40px;"><img src="images/logo-horizontal.png" width="480" height="100"></div>
             <div style="margin-top:20px; padding-right:80px; min-height:400px;"><img src="http://www.agescritoriodearte.com.br/images/<?=$linhaAltit['foto']?>" width="302" height="199" hspace="80" align="left" style="margin-bottom:100px;">
               <p align="justify"><?=$linhaAltit['texto']?></p>
     		</div>      
            <p align="center" id="rodape">Copyright © 2018 - Sérgio Altit - Leiloeiro. Todo o conteúdo deste site é de uso exclusivo.<br />
            R. Amélia Corrêa Fontes Guimarães, 49 - Jardim Guedala - Morumbi, São Paulo - SP - Tel: 55 11 3721 9676
            </p>
