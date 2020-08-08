<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
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
.inputsTxt{
	padding: 10px 0 10px 15px;
    font-size: 13px;
    font-family: Montserrat, sans-serif;
	border:1px #CCCCCC solid;
    height: 36px;
    color: #999;
    outline: none;
    background: #FFF;
    box-sizing: border-box;
    transition: all 0.15s;
	border-radius:0px;
	margin-top:10px;	
}
</style>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script language="javascript">
function fechaMessage(){
	document.getElementById("message").style.display = "none";
}
function adicionar(id){
			$('#mudalote'+id).show();
			$('#lote'+id).hide();
			return false;
	}
function adicionar2(id){
			$('#mudalote'+id).hide();
			$('#lote'+id).show();
			return false;
	}
function validaForm(){
	var obj = document.form1
	
	
	if(obj.txtCliente.value == ""){
		alert("Campo de nome vazio, favor preencher.")
		obj.txtCliente.focus()
		return
	}
	if(obj.cartela.value == ""){
		alert("Campo cartela vazio, favor preencher.")
		obj.cartela.focus()
		return
	}
	
	
	obj.submit()
}
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    var availableTags = [
      <? 
	  $queryComprs = "Select * from compradores where nome like '%".$_GET['nome']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
      $resultadoComprs = mysql_query($queryComprs);
	  if (mysql_num_rows($resultadoComprs)!=0) {
		  while ($linhaoComprs = mysql_fetch_array($resultadoComprs)) {?>
			  "<?=$linhaoComprs['nome'];?>",
	  <? }}?>
    ];
    $( "#txtCliente" ).autocomplete({
      source: availableTags
    });
	
	
	
	
	
  } );
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
<div id="conteudo">
    <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
        Cartelas - Leilão</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <p><?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?>
        <a href="index-home.php"> <img src="images/1400355878_arrow-return-180.png" width="16" height="16"  align="absmiddle"/></a> </p>
    </div>
    </div>
    <div id="tabelaBuscaCadastros">
    <p style="height:100px;">&nbsp;</p>
    <form action="nova-cartela-ok.php?id=<?=$_GET['id']?>" method="POST" id="form1" name="form1">
    <p>Comprador: <input type="text" name="txtCliente" id="txtCliente" style="width:300px;" class="inputsTxt"/><input id="tags"></p>
    <p style="padding-left:30px;">Cartela: <input type="text" name="cartela" id="cartela"  class="inputsTxt" style="width:90px;"/><input type="button" value="Cadastrar" name="envia_button" id="envia_button" onClick="javascript:validaForm()" style=" margin-left:5px; float:none !important;">
    </p></form>
    <p>&nbsp;</p>
    <p>Cartelas cadastradas:</p>
    <table width="60%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:20px !important;">
      <tr>
        <td width="10%">Cartela</td>
        <td width="70%">Comprador</td>
        <td style="border-right:none !important;" width="10%">&nbsp;</td>
      </tr>
      <?
	  $queryCs = "Select * from cartelas where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by cartela asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linha['cartela']?></td>
        <td style="color:#787878 !important;" ><?
		$queryEc = "Select * from compradores where idCadastro = '".$linha['idComitente']."'";
		$resultadoEc = mysql_query($queryEc);
		$linhaEc = mysql_fetch_array($resultadoEc);
		echo $linhaEc['nome'];
		
		?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="exclui-cartela.php?idCartela=<?=$linha['idCartela']?>&id=<?=$_GET['id']?>"><img src="images/1464125828_Close.png" width="16" height="16" border="0" /></a></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="4" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhuma cartela cadastrada...</em></td>
        </tr>
        <? }?>
    </table>
    </div>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Cartela cadastrada com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "exok"){?>
<div id="message" align="center" style="z-index:100">
Cartela excluída com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>

</body>
</html>
