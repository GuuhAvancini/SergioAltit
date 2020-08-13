<?php 
include("admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança

$mysqli = $_SG['link'];

$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = $mysqli->query($querySt);
$linhaSt = $resultadoSt->fetch_array();

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '2'";
$resultadoAltit = $mysqli->query($queryAltit);
$linhaAltit = $resultadoAltit->fetch_array();


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
	header("Location: /mobile/index.php");
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127428658-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-127428658-1');
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AG - Escritório de Arte</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #f4f4f5;
	font-family: Helvetica, Sans-Serif;
    font-size: 15px;
    line-height: 1.428571429;
    -webkit-font-smoothing: antialiased;
}
#topo{
	height:170px;
	background-color:#000000;
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
	margin-left:	10px;
	margin-right:	10px;
	margin-top:		5px;
	right:			10px;
	color:			#FFF;
	padding:		5px;
	font-weight:	bold;
	
	
}
#redesSociais{
	float:right;
	margin-top:30px;
	margin-right:30px;
	
	
}
#fotoHome{
	margin-top:20px;
}
#conteudoTxt{
	margin-bottom:40px;	
}

</style>
</head>

<body>
<div id="topo">
 <div id="conteudo">
 <img src="images/logo-altit.png" width="227" height="103" />
  <div id="redesSociais"><a href="https://www.facebook.com/ag.escritoriodearte/" target="_blank"><img src="images/face-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <a href="https://www.instagram.com/ag.escritoriodearte/?hl=pt-br" target="_blank"><img src="images/insta-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <img src="images/tel-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /> <span style="font-weight:bold; font-size:22px;">(11) 3721 9676</span></div>
  <ul class="menu-ag">
      <li><a href="contato.php">CONTATO</a></li>
      <li><a href="leiloeiro.php">O LEILOEIRO</a></li>
      <li><a href="exposicoes.php">EXPOSIÇÕES</a></li>
      <li><a href="leiloes.php">LEILÕES</a></li>
      <li><a href="artistas.php">ARTISTAS</a></li>
      <li><a href="acervo.php">ACERVO</a></li>
      <li><a href="escritorio-de-arte.php">ESCRITÓRIO DE ARTE</a></li>
      <li><a href="index.php">HOME</a></li>
    </ul>
  </div>
</div>
<div id="fotoHome">
	<div id="conteudo">
    	<div id="conteudoTxt">
            <div align="center" style="margin-top:40px;"><img src="images/logo-horizontal.png" width="480" height="100"></div>
             <div style="margin-top:20px; padding-right:80px; min-height:400px;"><img src="../images/<?=$linhaAltit['foto']?>" width="302" height="199" hspace="80" align="left" style="margin-bottom:100px;">
               <p align="justify"><?=$linhaAltit['texto']?></p>
     		</div>      
            <p align="center" id="rodape">Copyright © 2018 - AG - Escritorio de Arte. Todo o conteúdo deste site é de uso exclusivo.<br />
            R. Amélia Corrêa Fontes Guimarães, 49 - Jardim Guedala - Morumbi, São Paulo - SP - Tel: 55 11 3721 9676
            </p>
