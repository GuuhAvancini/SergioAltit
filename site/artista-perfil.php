<?php 
include("../admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '2'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);

if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
	font-weight:	bold;
	
}
#conteudoTxt{
	margin-bottom:40px;	
}
#redesSociais{
	position: absolute;
	top: 5px;
	padding-left:790px;
	
}
#imgArtista{
	float:left;
	margin-left:10px;
	margin-bottom:10px;
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
</style>
</head>

<body>
<div id="topo">
 <div id="conteudo">
  <img src="images/logo-altit.png" width="227" height="103" />
  <div id="redesSociais"><span style="margin-right:50px; font-weight:bold; font-size:18px;">Telefone: (11) 3721 9676</span><img src="images/face-ico.png" width="38" height="25" hspace="3" border="0" align="absmiddle" /> <img src="images/insta-ico.png" width="38" height="25" hspace="3" border="0" align="absmiddle" /> <img src="images/twiter-ico.png" width="38" height="25" hspace="3" border="0" align="absmiddle" /></div>
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
            <h2>Artistas:</h2>
        	<hr size="1" color="#999999"><table width="100%" border="0">
            <?
	  $queryCs = "Select * from artistas where idArtista = '".$_GET['id']."'";
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
        <h2>Obras no acervo:</h2>
        <p align="center" style="width:950px; margin-bottom:40px;">
				<?
				
					  $conta = 0;
					  
					  $queryCs = "Select * from acervo  where website = 'sim' and estatus = 'Em estoque' and artista = '".$_GET['id']."' ORDER BY descricao asc";
					  $resultadoCs = mysql_query($queryCs);
                      if (mysql_num_rows($resultadoCs)!=0) {
                          while ($linha = mysql_fetch_array($resultadoCs)) {
							  
							 $imgW = "205";$imgH = "215";
							  
                
                ?>
                    <div id="imgArtista" style="width:<?=$imgW?>px;height:<?=$imgH?>px;">
                        <a href="acervo-visualizar.php?id=<?=$linha['idPeca']?>"><img src="../admleilao/fotos/<?=$linha['foto']?>" width="<?=$imgW?>" height="<?=$imgH?>" style="margin:5px;" /></a>
                        <div id="tituloArtistas" style="width:<?=$imgW-10?>px;"><?
						$queryAt = "Select * from artistas where idArtista = '".$linha['artista']."'";
      					$resultadoAt = mysql_query($queryAt);
	  					$linhaAt = mysql_fetch_array($resultadoAt);
						echo $linhaAt['nome'];
						
						?></div>
                    </div>
                <? 
				$conta = $conta+1;
				}?>
            </p>
            
            <? }else{?>
          <p align="center" style="min-height:400px;"><em>No momento não temos nenhuma obra do artista em nosso acervo, entre em contato...</em></p>
            <? }?></td>
              
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
