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
	margin-top:1000px;
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
	font-weight:	bold;
	
}
#conteudoTxt{
	margin-bottom:40px;
	
	
}
#imgArtista{
	width: 	260px;
	height:121px;
	float:left;
}
#tituloArtistas{
	background: rgba(225, 225, 225, .8);
	height:20px;
	margin-top:-35px;
	width: 	250px;
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
#redesSociais{
	position: absolute;
	top: 5px;
	padding-left:790px;
	
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
            <h2>Leilões:</h2>
        	<hr size="1" color="#999999">
            <?
			$querySt = "Select * from website where codigoCliente = '".$_SESSION['codigoCliente']."' and idPagina = '4'";
			$resultadoSt = mysql_query($querySt);
			$linhaSt = mysql_fetch_array($resultadoSt);
			if($linhaSt['link'] == "sim"){
			?>
          <p align="center"><img src="images/<? 
	if ($linhaSt['foto'] <> ""){
	echo $linhaSt['foto'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="1004" height="567" /></p>
			</div><? }else{?>
            <table width="100%" border="0">
            <?
	  $queryCs = "Select * from leiloes where website = 'sim' and convite <> '' and estatus = 'Pregão' and siteAg = '1' order by idLeilao desc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
      while ($linha = mysql_fetch_array($resultadoCs)) {
		  //$linha = mysql_fetch_array($resultadoCs);
			$idleilaoDestaque = $linha['idLeilao'];
			
			$pieces = explode("/", $linha['dataLeilao']);
			$dia = $pieces[0];
			$mes = $pieces[1];
			$ano = $pieces[2];
			
			switch ($mes){
				 
				case 1: $mes = "JANEIRO"; break;
				case 2: $mes = "FEVEREIRO"; break;
				case 3: $mes = "MARÇO"; break;
				case 4: $mes = "ABRIL"; break;
				case 5: $mes = "MAIO"; break;
				case 6: $mes = "JUNHO"; break;
				case 7: $mes = "JULHO"; break;
				case 8: $mes = "AGOSTO"; break;
				case 9: $mes = "SETEMBRO"; break;
				case 10: $mes = "OUTUBRO"; break;
				case 11: $mes = "NOVEMBRO"; break;
				case 12: $mes = "DEZEMBRO"; break;
				 
				}
			
			?>
            
            <tr>
              <td width="496" valign="top"><a href="view-leilao.php?id=<?=$linha['idLeilao']?>"><img src="../images/<?=$linha['convite']?>"  width="482" height="272" /></a></td>
              <td width="694" valign="top">
                <h1> <?=$linha['descricao']?></h1>
                <h3>Data do Leilão: <? echo $dia." DE ".$mes." DE ".$ano;?></h3>
                <p><?=$linha['infos']?></p>
                <p><input name="" type="submit" value="Catálogo Completo" style="width:150px;" onclick="location.href='view-leilao.php?id=<?=$linha['idLeilao']?>'"> <? if($linha['catalogopdf'] <> ""){?><input name="" type="button" value="Catálogo em PDF" style="width:150px;" onClick="window.open('../convites/<?=$linha['catalogopdf']?>');"><? }?></p>
                </td>
              </tr>
            
<? }}?>
            </table>
            <? }
					$queryCs = "Select * from leiloes where idLeilao <> '".$idleilaoDestaque."' and  website = 'sim' and convite <> '' and estatus = 'Finalizado' and siteAg = '1' ORDER BY data desc";
					$resultadoCs = mysql_query($queryCs);
                    if (mysql_num_rows($resultadoCs)!=0) {
			?>
            <h2>Leilões anteriores:</h2>
            <hr size="1" color="#999999">
          <p align="center" style="width:1200px; margin-bottom:40px;">
				<?
                     while ($linha = mysql_fetch_array($resultadoCs)) {
                ?>
                    <div id="imgArtista">
                        <a href="view-leilao.php?id=<?=$linha['idLeilao']?>"><img src="../images/<?=$linha['convite']?>" width="260" height="121" style="margin:5px;" /></a>
                      <div id="tituloArtistas"><?=$linha['descricao']?></div>
                    </div>
                <? }}?>
            </p>
	  </div>
         </div>
</div>
</body>
</html>
