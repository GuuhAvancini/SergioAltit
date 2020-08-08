<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from artistas where idArtista = '".$_GET['idArtista']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema > <?=$_SESSION['clienteNome']?></title> 
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<style type="text/css">
.titulosDados {font-size: 14px;}
</style>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
<script>
function fechaMessage(){
	document.getElementById("message").style.display = "none";
}
$(function(){
 $("[name=valor]").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })
</script>
</head>
<body onload="<?=$erro?>">
<div id="menu-princ">
	<?php include("menu.php");?>
</div>
<div id="barra-fixa">
    <div id="titulo-user">
    	<?php include("topo.php");?>
  </div>
</div>
<div id="conteudo" style="margin-bottom:50px;">
    <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
      Web Site</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <input type="button" value="Imagem Home" name="new_button" id="new_button" onclick="location.href='web-site.php'"/> <input type="button" value="Quem Somos" name="new_button" id="new_button" onclick="location.href='quem-somos.php'"/> <input type="button" value="Artistas" name="new_button" id="new_button" onclick="location.href='artistas.php'"/> <input type="button" value="Leilões" name="new_button" id="new_button" onclick="location.href='leiloes-website.php'"/> <input type="button" value="Exposições" name="new_button" id="new_button" onclick="location.href='exposicoes.php'"/>
    <p>&nbsp;</p>
    <p>Artistas:</p>
    <form id="form1" name="form1" method="post" action="altera-artista.php?idArtista=<?=$_GET['idArtista']?>" enctype="multipart/form-data" >
    <p>Nome do Artista:
        <input type="text" name="nome" id="input_text" style="width:500px;" value="<?=$linha['nome']?>"/>
    </p>
    <p>Biografia:
      <textarea name="biografia" rows="6" id="input_text" style="width:550px; height:100px;"><?=str_replace("<br />",'', $linha['biografia'])?></textarea>
    </p>
    <p>Referências:
      <textarea name="referencias" rows="6" id="input_text" style="width:530px; height:100px;"><?=$linha['referencias']?></textarea>
    </p>
    <p><input type="submit" value="Alterar Artista" name="new_button" id="new_button" style=" float:none !important;">
    </p></form>
    <p>&nbsp;</p> <form id="form1" name="form1" method="post" action="altera-foto-artista.php?idArtista=<?=$_GET['idArtista']?>" enctype="multipart/form-data" >
    <p>Altera-foto do Artista:</p>
    <p><img src="../images/<?=$linha['foto']?>" width="102" height="139"  align="absmiddle" /> Foto:
      <input type="file" name="fotoUpload" id="fotoUpload" />
      <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style=" float:none !important;" />
      
    </p></form>
</div>

<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center">
Cadastro alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "excluir"){?>
<div id="message" align="center">
Artista excluído com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
