<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from comitentes where idCadastro = '".$_GET['idCadastro']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}





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
 $(function(){
 $("[name=overprice]").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })
 function checkAll(o){
	var boxes = document.getElementsByTagName("input");
	for (var x=0;x<boxes.length;x++){			
		var obj = boxes[x];
		if (obj.type == "checkbox"){
			if (obj.name!="chkAll") obj.checked = o.checked;
		}
	}
}
function validaForm(){
	var obj = document.form1
	
	
	if(obj.leilao.value == ""){
		alert("Selecione o leilão que deseja cadastrar as peças.")
		obj.leilao.focus()
		return
	}
	
	
	obj.submit()
}
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
      Comitente</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <table width="100%" border="0">
  <tr>
    <td><h2><?=$linhaEc["nome"]?></h2></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
</div>
  	<div id="conteudo-cadastros-menu" style="margin-top:150px;">
    	<div id="busca-invoices-ativo">
        Selecionar peças</div>
       <div id="busca-cadastros"></div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:200px !important; ">
      <div id="tabelaBuscaCadastros">
      <form id="form1" name="form1" method="post" action="envia-leilao-ok.php?idCadastro=<?=$_GET['idCadastro']?>">
    <table width="1000" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:10px !important; margin-bottom:50px !important;">
      <tr>
        <td width="10%">Foto</td>
        <td width="15%">ID Peça</td>
        <td width="50%">Descrição</td>
        <td width="15%">Valor inicial</td>
        <td width="10%">Estatus</td>
        <td style="border-right:none !important;" width="5"><input type="checkbox" name="chkAll" onClick="checkAll(this)" style="width:40px;" /></td>
      </tr>
      <?
	  $queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' and idCadastro = '".$_GET['idCadastro']."' and estatus = 'Em estoque' order by idPeca asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" >
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linha['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linha['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linha['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linha['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linha['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><input name="sel_<? echo $linha['idPeca'];?>" type="checkbox" id="sel_<? echo $linha['idPeca'];?>" value="sim" style="width:40px;"></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="6" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum peça encontrada...</em></td>
        </tr>
    
    <? }?>
    <tr bgcolor="#fffdea"  >
        <td colspan="6" style="border-bottom:none !important; border-right:none !important;" align="right">Selecione o Leilão: <select name="leilao" id="input_text" style="width:250px;"> 
          <option value="">Selecione o Leilão:</option>
                <?
	  $queryBL = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' order by data desc limit 12";
	  $resultadoBL = mysql_query($queryBL);
	  if (mysql_num_rows($resultadoBL)!=0) {
		  while ($linhaBL = mysql_fetch_array($resultadoBL)) {
	  ?>
      <option value="<?=$linhaBL['idLeilaoN']?>"><?=$linhaBL['descricao']?></option>
      <? }}?>
                
      </select><input type="button" value="Enviar para leilão" name="new_button" id="new_button"  style="float:right;" onClick="javascript:validaForm()"/></td>
      </tr></table>
    </form>
    </div>
    </div>
    
</div>

<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idpeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
