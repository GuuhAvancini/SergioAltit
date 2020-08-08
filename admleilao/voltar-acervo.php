<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);


if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}

$queryVe = "Select * from comitentes where idCadastro = '".$linhaEc['idCadastro']."'";
$resultadoVe = mysql_query($queryVe);
$linhaVe = mysql_fetch_array($resultadoVe);




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
      Acervo</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <input type="button" value="Editar Acervo" name="new_button" id="new_button" onclick="location.href='edita-acervo.php?idPeca=<?=$_GET['idPeca']?>'" style="float:right; margin-right:50px;" />
    <table width="100%" border="0">
  <tr>
    <td width="241" rowspan="2" valign="top"><img src="fotos/<? 
	if ($linhaEc['foto'] <> ""){
	echo $linhaEc['foto'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="210" height="230" border="1"></td>
    <td width="537" height="140" valign="top">Id da peça: <?=$linhaEc['idAcervo']?><br /><br /><?=$linhaEc['descricao']?></td>
    <td width="588" rowspan="2" valign="top"><p>Comitente Vendedor: <a href="editar-comitente-vendedor.php?idpeca=<? echo $_GET['idpeca'];?>"><img src="images/1395668715_document-print.png" width="16" height="16"></a></p>
            <p>Nome: <strong>
              <?=$linhaVe['nome']?>
            </strong></p>
            <p>Telefone: <strong>
              <?=$linhaVe['telefone']?></strong></p>
            <p>Celular: <strong>
                <?=$linhaVe['celular']?>
              </strong></p>
            <p>CPF: <strong>
              <?=$linhaVe['cpf']?>
              </strong> </p>
            <p>E-mail: <strong>
                <?=$linhaVe['email']?>
            </strong></p></td>
  </tr>
  <tr>
    <td valign="top">Valor inicial: R$ <?=$linhaEc['valor']?><br /><br />
    Estatus da peça: <?=$linhaEc['estatus']?></td>
  </tr>
    </table>
     <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
      Voltar para o acervo</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div style="margin-top:50px;">
      <form id="form1" name="form1" method="post" action="volta-acervo-ok.php?idPeca=<?=$_GET['idPeca']?>">
      Motivo:<br />
      <textarea name="motivo" cols="" rows="" id="input_text" style="width:350px; height:130px;"></textarea><br /><br />
      <input type="submit" value="Voltar para o acervo" name="new_button" id="new_button" style="margin-left:-1px; float:none !important;">
      <a href="view-acervo.php?idPeca=<?=$_GET['idPeca']?>"><img src="images/1400355878_arrow-return-180.png" width="16" height="16"  align="absmiddle"/></a>
      </form>
    </div>
    </div>
</div>


<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center">
Cadastro alterado com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
