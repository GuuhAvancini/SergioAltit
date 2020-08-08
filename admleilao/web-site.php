<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$querySt = "Select * from website where codigoCliente = '".$_SESSION['codigoCliente']."' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryStS = "Select * from website where codigoCliente = '".$_SESSION['codigoCliente']."' and idPagina = '5'";
$resultadoStS = mysql_query($queryStS);
$linhaStS = mysql_fetch_array($resultadoStS);


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
    <p>Editar imagem da Home - Ag Escritorio de Arte:</p>
    <form id="form2" name="form2" method="post"  action="altera-website-foto.php" enctype="multipart/form-data">
        <table width="100%" border="0">
          <tr>
            <td width="22%"><img src="../images/<? 
	if ($linhaSt['foto'] <> ""){
	echo $linhaSt['foto'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="383" height="217" border="1" /></td>
            <td width="78%" valign="top"><p>Altera foto principal da Pe&ccedil;a:<br />
              <input type="file" name="fotoUpload" id="fotoUpload" />
            </p>
            <p>Tamanho ideal da foto: 1000 pixels x 570 pixels</p>
            <p>Link com leilão: 
<input name="link" type="radio" id="radio6" style="width:30px;" value="nao" <? if($linhaSt['link'] == "nao"){?>checked="checked"<? }?> />
Não <input name="link" type="radio" id="radio5" style="width:30px;" value="sim" <? if($linhaSt['link'] == "sim"){?>checked="checked"<? }?> />
Sim - Id Leilão: <input type="text" name="idLeilao" id="input_text" style="width:100px;"  value="<?=$linhaSt['idLeilao']?>"/></p>
            <p>
              <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style="margin-left:-1px;" />
            </p></td>
          </tr>
        </table>
      </form>
      <p>&nbsp;</p>
    <p>Editar imagem da Home - Sergio Altit - Leiloeiro:</p>
    <form id="form2" name="form2" method="post"  action="altera-website-foto-sergio.php" enctype="multipart/form-data">
        <table width="100%" border="0">
          <tr>
            <td width="22%"><img src="../images/<? 
	if ($linhaStS['foto'] <> ""){
	echo $linhaStS['foto'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="383" height="217" border="1" /></td>
            <td width="78%" valign="top"><p>Altera foto principal da Pe&ccedil;a:<br />
              <input type="file" name="fotoUpload" id="fotoUpload" />
            </p>
            <p>Tamanho ideal da foto: 1000 pixels x 570 pixels</p>
            <p>Link com leilão: 
<input name="link" type="radio" id="radio6" style="width:30px;" value="nao" <? if($linhaStS['link'] == "nao"){?>checked="checked"<? }?> />
Não <input name="link" type="radio" id="radio5" style="width:30px;" value="sim" <? if($linhaStS['link'] == "sim"){?>checked="checked"<? }?> />
Sim - Id Leilão: <input type="text" name="idLeilao" id="input_text" style="width:100px;"  value="<?=$linhaStS['idLeilao']?>"/></p>
            <p>
              <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style="margin-left:-1px;" />
            </p></td>
          </tr>
        </table>
      </form>
      
</div>

<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center">
Web Site alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
