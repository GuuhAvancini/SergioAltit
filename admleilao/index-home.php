<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema > <?=$_SESSION['clienteNome']?></title> 
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script language="javascript">
function fechaMessage(){
	document.getElementById("message").style.display = "none";
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
<div id="conteudo">
    <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
        Leilões</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <input type="button" value="+ Novo Leilão" name="new_button" id="new_button" onclick="location.href='novo-leilao.php'" style="margin-left:0px !important;">  
    </div>
    </div>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:130px !important;">
      <tr>
        <td width="10%">ID</td>
        <td width="30%">Descrição</td>
        <td width="20%">Data</td>
        <td width="20%">Estatus</td>
        <td width="5">&nbsp;</td>
        <td width="5">&nbsp;</td>
        <td width="5">&nbsp;</td>
        <td width="5">&nbsp;</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	  $queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' order by data desc";
		
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linha['idLeilaoN']?></td>
        <td style="color:#787878 !important;" ><?=$linha['descricao']?></td>
        <td style="color:#787878 !important;" ><?=$linha['dataLeilao']?> - <?=$linha['horario']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
        <td style="color:#787878 !important;" ><a href="editar-leilao.php?id=<?=$linha['idLeilaoN']?>"><img src="images/1395668715_document-print.png" width="16" height="16" /></a></td>
        <td style="color:#787878 !important;" >
        <? if($linha['estatus'] == "Em produção"){?>
        <input type="button" value="Lotes" name="new_button" id="new_button" onclick="location.href='lotes-leilao.php?id=<?=$linha['idLeilaoN']?>'" style="margin-left:0px !important;">
        <? }
		if($linha['estatus'] == "Pregão" || $linha['estatus'] == "Finalizado" ){
		?><input type="button" value="Lotes" name="new_button" id="new_button" onclick="location.href='pregao-leilao.php?id=<?=$linha['idLeilaoN']?>'" style="margin-left:0px !important;">
        <? }?>
        </td>
        <td style="color:#787878 !important;" >
        <input type="button" value="Cartelas" name="new_button" id="new_button" onclick="location.href='cartelas.php?id=<?=$linha['idLeilaoN']?>'" style="margin-left:0px !important;">
        </td>
        <td style="color:#787878 !important;" >
        <? if($linha['estatus'] == "Em produção" || $linha['estatus'] == "Finalizado"){?>
        <input type="button" value="Fechamento" name="new_button" id="new_button" onClick="alert('Altere o status para Pregão para poder realizar o fechamento.')" style="margin-left:0px !important;"><? }
		if($linha['estatus'] == "Pregão" ){
		?>
        <input type="button" value="Fechamento" name="new_button" id="new_button" onclick="location.href='fechamento.php?id=<?=$linha['idLeilaoN']?>'" style="margin-left:0px !important;"><? }?>
        </td>
        <td style="border-right:none !important; color:#787878 !important;" ><input type="button" value="Relatórios" name="new_button" id="new_button" onclick="location.href='leilao-relatorios.php?id=<?=$linha['idLeilaoN']?>'" style="margin-left:0px !important;"></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="9" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum leilão encontrado...</em></td>
        </tr>
    </table>
    <? }?>
    </div>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Leilão cadastrado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altstok"){?>
<div id="message" align="center" style="z-index:100">
Estatus do leilão alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center" style="z-index:100">
Leilão alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
