<?php 
include("admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '2'";
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
	header("Location: /mobile/acervo-visualizar.php?id=".$_GET['id']."");
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
<script src='jquery-1.8.3.min.js'></script>
<script src='jquery.elevatezoom.js'></script>
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
            <h2>Peças disponíveis em nosso acervo:</h2>
        	<hr size="1" color="#999999"><table width="100%" border="0">
            <?
	  $queryCs = "Select * from acervo where website = 'sim' and estatus = 'Em estoque' and idPeca = '".$_GET['id']."' order by descricao asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
			$EndImagem = "admleilao/fotos/".$linha['foto']; 
			$TamanhoImagem = getimagesize($EndImagem);
			if($TamanhoImagem[0] > $TamanhoImagem[1]){
				$imgTam = "width=450";
			}else{
				$imgTam = "height=450";
			}
			
			
			?>
            
            <tr>
              <td width="504">
              <img id="zoom_01" src="admleilao/fotos/<?=$linha['foto']?>" data-zoom-image="admleilao/fotos/<?=$linha['foto']?>" <?=$imgTam?>/>
              <script>
    $("#zoom_01").elevateZoom();
</script>
              </td>
              <td width="686" valign="top">
                <h2>
				<?
						$queryAt = "Select * from artistas where idArtista = '".$linha['artista']."'";
      					$resultadoAt = mysql_query($queryAt);
	  					$linhaAt = mysql_fetch_array($resultadoAt);
						echo $linhaAt['nome'];
						
						?></h2>
                <p><br />
                <?=$linha['descricao']?></p>
              <p style="font-size:18px"><br /><br />Valor Base: <strong>R$ <?=$linha['valor']?></p></td>
              </tr>
            <tr>
              <td colspan="2"><p>&nbsp;</p><p>&nbsp;</p></td>
            </tr>
<? }?>
            </table>
            <table width="100%" border="0">
            <?
	  $queryCs = "Select * from artistas where idArtista = '".$linha['artista']."'";
      $resultadoCs = mysql_query($queryCs);
	  $linha = mysql_fetch_array($resultadoCs);
			
			?>
            
            <tr>
              <td width="233" rowspan="2" valign="top"><img src="../../images/<?=$linha['foto']?>"  width="215" height="226" /></td>
              <td width="957" rowspan="2" valign="top">
      <p><br />
        <strong style="border-bottom:5px #f58220 solid; padding-bottom:5px; font-size:18px"><?=$linha['nome']?></strong></p>
        <p align="justify"><?=$linha['biografia']?></p>
        <hr size="1" color="#999999">
        <p>Referência: <?=$linha['referencias']?></p>
        </td>
              
            </tr>
            
 

            </table>
            
	  </div>      
            <p align="center" id="rodape">Copyright © 2018 - AG - Escritorio de Arte. Todo o conteúdo deste site é de uso exclusivo.<br />
            R. Amélia Corrêa Fontes Guimarães, 49 - Jardim Guedala - Morumbi, São Paulo - SP - Tel: 55 11 3721 9676
            </p>
    	</div>
    </div>
</div>
</body>
</html>
