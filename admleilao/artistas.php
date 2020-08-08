<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if($_GET['op'] == "excluir"){
	
	$query = mysql_query("DELETE FROM artistas WHERE idArtista = '".$_GET['idArtista']."' ") or die(mysql_error());
	
}


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
    <input type="button" value="Imagem Home" name="new_button" id="new_button" onclick="location.href='web-site.php'"/> <input type="button" value="Quem Somos" name="new_button" id="new_button" onclick="location.href='quem-somos.php'"/> <input type="button" value="Artistas" name="new_button" id="new_button" onclick="location.href='artistas.php'"/> <input type="button" value="Leilões" name="new_button" id="new_button" onclick="location.href='leiloes-website.php'"/> <input type="button" value="Exposições" name="new_button" id="new_button" onclick="location.href='exposicoes.php'"/> <input type="button" value="Leiloeiro" name="new_button" id="new_button" onclick="location.href='leiloeiro.php'"/>
    <p>&nbsp;</p>
    <p>Artistas:</p>
    <form id="form1" name="form1" method="post" action="cadastra-novo-artista.php" enctype="multipart/form-data" >
    <p>Nome do Artista:
        <input type="text" name="nome" id="input_text" style="width:500px;"/>
    </p>
    <p>Biografia:
      <textarea name="biografia" rows="6" id="input_text" style="width:550px; height:100px;"></textarea>
    </p>
    <p>Referências:
      <textarea name="referencias" rows="6" id="input_text" style="width:530px; height:100px;"></textarea>
    </p>
    <p>Foto: <input type="file" name="fotoUpload" id="fotoUpload" /><input type="submit" value="Cadastrar Artista" name="new_button" id="new_button" style=" float:none !important;">
    </p></form>
    <p>&nbsp;</p>
    <p>Artistas cadastrados:</p>
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:5px !important; margin-bottom:100px !important;">
      <tr>
        <td width="52" align="center">Foto</td>
        <td align="center">Nome do Artista</td>
        <td style="border-right:none !important;" width="30">&nbsp;</td>
        <td style="border-right:none !important;" width="30">&nbsp;</td>
      </tr>
      <?
	  
	  $queryCs = "Select * from artistas order by nome asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;"><img src="../images/<?=$linha['foto']?>" width="52" height="71" /></td>
        <td style="color:#787878 !important;"><?=$linha['nome']?></td>
        <td style="color:#787878 !important;"><a href="edita-artista.php?idArtista=<?=$linha['idArtista']?>"><img src="images/1395668715_document-print.png" width="24" height="24" /></a></td>
        <td style="color:#787878 !important;"><a href="?op=excluir&idArtista=<?=$linha['idArtista']?>"><img src="images/1464125828_Close.png" width="16" height="16" /></a></td>
      </tr>
      <? }}else{?>
      <tr>
        <td style="color:#787878 !important;" colspan="4" align="center"><em>Nenhum artista cadastrado...</em></td>
      </tr><? }?>
    </table>
    
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
