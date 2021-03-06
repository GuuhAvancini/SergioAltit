<?php
include("../../admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '3'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);


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
<title>Sergio Altit</title>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="stylem.css">
<style type="text/css">
body {
	background-color: #F7F7F7;
    margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	color: #999999;
}

#buscatag{
    width:80%;
    margin-bottom:30px;
    font-size:16px;
    padding:20px;
    color:#ed462f;
    border-radius:5px;
    border:1px solid #CCC;
}
.inputTxt{
    width:450px;
    font-size:16px;
    padding:10px;
    color:#ed462f;
    border-radius:5px;
    border:1px solid #CCC;
}
#butBusca{
    width: 25px;
    height: 25px;
    margin-top:20px;
    margin-left:-40px;
    position:absolute;
    
}
#bot {
    border: none !important;
    padding: 10px;
    color: #FFF !important;
    background-color: #ed462f !important;
    cursor: pointer;
    border-radius: 5px;
    font-size: 15px !important;
    height: 40px;
    width:80% !important;
    -webkit-appearance: none;
    margin:5px  !important;
}
.voltaTopo {
    width: 100px;
    height: 100px;
    position: fixed;
    z-index: 1000;
    right: 1rem;
    bottom: 1rem;
    display:none;
}
#home{
    height:800px;
}
#quem-somos{
    height:750px;
    color:#000;
    padding-top:50px;
}
#como-funciona{
    height:750px;
    color:#000;
    padding-top:50px;
}
#cadastre-se{
    height:760px;
    color:#000;
    padding-top:40px;
}
#duvidas{
    height:770px;
    color:#000;
    padding-top:20px;
}
#central-atendimento{
    height:800px;
}
#rodapeHome{
    height:20px;
    background-color:#f2f2f2;
    position:absolute;
    bottom: 1px;
    width:100%;
    border-top: 1px solid #CCC;
    font-size:13px;
    padding-top:20px;
    padding-bottom:20px;
}
#rodapeHome a{
    text-decoration:none;
    color: #999999;
}
#conteudo{
    width: 1100px;
    margin: 0 auto;
}
#textQuemSomos{
    width:500px;
    font-size: 1.0em;
    line-height: 1.5em;
    float:left;

}
#quadroComo{
    width:230px;
    float:left;
    padding:20px;
}
#rodapeComofunciona{
    width:100%;
    padding-top:375px;
}
#quadroCadastro{
    width:500px;
    float:left;
}
#rodapeCadastrese{
    width:100%;
    padding-top:150px;
}
.respostasPerguntas{
    padding:10px;
    background-color:#fee3df;
    border-radius:5px;
}
#loginQuadro{
    position:fixed;
    top:10px;
    right:10px;
    width:300px;
    height:60px;
}
#loginForm{
    position:absolute;
    width:260px;
    height:300px;
    border-radius:5px;
    background-color:#FFF;
    margin-top:5px;
    margin-right:10px;
    padding:10px;
    border:1px solid #000;
}
#rodapeMenu{
    position:absolute;
    bottom:20px;
}
#rodapeMenu a{
    text-decoration:none;
    color: #999999;
}
#rodape{
    margin-top:30px;
    font-size:12px;
}
h2{
    font-size:16px;
    margin-top:20px;
}
#imgArtista{
    margin-bottom:20px;
}
#tituloArtistas{
	background: rgba(225, 225, 225, .8);
	height:20px;
	margin-top:-35px;
	width: 90%;
	position:relative;
	z-index:100;
	margin-left:5px;
	padding:5px;
}
#tituloArtistas{
	background: rgba(225, 225, 225, .8);
	height:20px;
	margin-top:-35px;
	
	position:relative;
	z-index:100;
	margin-left:5px;
	padding:5px;
}
input[type=text] {
    
    padding: .313em 0;
    letter-spacing: normal;
    text-indent: .25em;
	color: #666666;
	font-size: 13px !important;
    padding: 10px !important;
	border: 1px solid #999 !important;
	box-sizing: border-box;
	border-radius: 0;
    outline: 0;
    background-color: #fff;
    -webkit-appearance: none;
	cursor: text;
	 margin-top:20px;
}
input[type=submit] {
    
    padding: .313em 0;
    letter-spacing: normal;
    text-indent: .25em;
	color: #000000;
	font-size: 13px !important;
    padding: 10px !important;
	border: 1px solid #000000 !important;
	box-sizing: border-box;
	border-radius: 0;
    outline: 0;
    background-color: #CCC;
    -webkit-appearance: none;
	cursor: pointer;
	 margin-top:20px;
	 margin-left:10px;
}
input[type=button] {
    
    padding: .313em 0;
    letter-spacing: normal;
    text-indent: .25em;
	color: #000000;
	font-size: 13px !important;
    padding: 10px !important;
	border: 1px solid #000000 !important;
	box-sizing: border-box;
	border-radius: 0;
    outline: 0;
    background-color: #CCC;
    -webkit-appearance: none;
	cursor: pointer;
	 margin-top:20px;
	 margin-left:10px;
}
#butBusca{
    width: 25px;
    height: 25px;
    margin-top:25px;
    margin-left:-35px;
    position:absolute;
    
}
</style>
<script type="text/javascript">

$(document).ready(function(){
    $('.menu-anchor').on('click touchstart', function(e){
        $('html').toggleClass('menu-active');
        e.preventDefault();
    });
    })
</script>
</head>
<body onload="<?=$erro?>">
<header><span class="menu-anchor"></span>
<p align="center">
<img src="../images/logo-altit.png" width="227" height="103" /></p>
</header>
<menu>
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="leiloeiro.php">O LEILOEIRO</a></li>
        <li><a href="artistas.php">ARTISTAS</a></li>
        <li><a href="leiloes.php">LEILÕES</a></li>
        <li><a href="contato.php">CONTATO</a></li>
    </ul>
    <div id="rodapeMenu" align="center">
    <p align="center" style="margin-left:10px;">
    <img src="http://www.agescritoriodearte.com.br/images/tel-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /> <span style="font-weight:bold; font-size:22px;">(11) 3721 9676</span></p>
    <p>&nbsp;</p>
    </div>
</menu>
<section class="main">
<?
	  $queryCs = "Select * from artistas where idArtista = '".$_GET['id']."'";
      $resultadoCs = mysql_query($queryCs);
	  $linha = mysql_fetch_array($resultadoCs);
			
			?>
            <p  style="margin-left:15px; margin-right:15px; margin-top:20px;"><strong style="border-bottom:5px #f58220 solid; padding-bottom:15px; font-size:18px; margin-top:20px; margin-bottom:20px;"><?=$linha['nome']?></strong></p>
            <p align="center" style="margin-top:30px;"><img src="http://www.agescritoriodearte.com.br/images/<?=$linha['foto']?>"  width="90%" /><p>
             
      <p><br />
        
        <p align="justify" style="margin-left:15px; margin-right:15px;"><?=$linha['biografia']?></p>
        <hr size="1" color="#999999" style="margin-left:15px; margin-right:15px;">
        <p style="margin-left:15px; margin-right:15px;">Referência: <?=$linha['referencias']?></p>
        
    
    <p align="center" id="rodape">Copyright © 2018 - Sergio Altit.<br>Todo o conteúdo deste site é de uso exclusivo.<br />
    R. Amélia Corrêa Fontes Guimarães, 49<br>Jardim Guedala - Morumbi, São Paulo - SP<br>Tel: 55 11 3721 9676
    </p>
</section>
</body>
</html>
