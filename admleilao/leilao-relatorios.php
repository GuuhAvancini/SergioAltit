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
        Lotes - Leilão</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <p><?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?> <span style="margin-left:50px;">Estatus: <?=$linha['estatus']?> 
        <a href="index-home.php"><img src="images/1400355878_arrow-return-180.png" width="16" height="16"  align="absmiddle"/></a></span></p>
    </div>
    </div>
    <div style="margin-top: 100px; position: absolute; width: 933px;">
    <input type="button" value="Jucesp" name="new_button" id="new_button" onclick="window.open('jucesp.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Iphan" name="new_button" id="new_button" onclick="window.open('iphan.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Ficha Leiloeiro" name="new_button" id="new_button"  onclick="window.open('ficha-leiloeiro.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Relatório de Venda" name="new_button" id="new_button"  onclick="window.open('relatorio-de-venda.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Relatório de Venda Total" name="new_button" id="new_button" onclick="window.open('relatorio-de-venda-completo.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Relatório Comitentes" name="new_button" id="new_button" onclick="window.open('relatorio-de-venda-por-comitentes.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Relatório Compradores" name="new_button" id="new_button" onclick="window.open('relatorio-de-venda-por-compradores.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Balancete" name="new_button" id="new_button" onclick="location.href='balancete-leilao.php?id=<?=$_GET['id']?>'">
    <input type="button" value="Recibo Compradores" name="new_button" id="new_button" onclick="window.open('leilao-recibo-comprador.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Recibo Comitentes" name="new_button" id="new_button" onclick="window.open('leilao-recibo-comitente.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Despacho de Peças" name="new_button" id="new_button" onclick="window.open('leilao-logistica.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Compradores Simples" name="new_button" id="new_button" onclick="window.open('relatorio-compradores-simples.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Comitentes Simples" name="new_button" id="new_button" onclick="window.open('relatorio-comitentes-simples.php?id=<?=$_GET['id']?>')">
    <input type="button" value="Excel Compradores" name="new_button" id="new_button" onclick="window.open('relatorio-excel-compradores.php?id=<?=$_GET['id']?>')">
  </div>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:270px !important;">
      <tr>
        <td width="5%">Lote</td>
        <td width="5%">Id Peça</td>
        <td width="10%">Foto</td>
        <td width="40%">Descrição</td>
        <td width="15%">Valor inicial</td>
        <td width="25%">Arremate</td>
      </tr>
      <?
	  $queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linhaLotes['numLote']?><?=$linhaLotes['loteExt']?>
        </td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linhaLot['valor']?></td>
        <td style="color:#787878 !important;" >
			<?
			$queryArr = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and lote = '".$linhaLotes['numLote']."'";
			$resultadoArr = mysql_query($queryArr);
			if (mysql_num_rows($resultadoArr)!=0) {
			$linhaArr = mysql_fetch_array($resultadoArr);
			$queryComp = "Select * from compradores where idCadastro = '".$linhaArr['idComprador']."'";
			
			$resultadoComp = mysql_query($queryComp);
			$linhaComp = mysql_fetch_array($resultadoComp);
			?>
          Arrematada por cartela: <?=$linhaArr['cartela']?><br />
          <?=$linhaComp['idComprador']?> - <?=$linhaComp['nome']?><br />
          Valor do arremate: R$ <?=$linhaArr['valor']?>
          <? }?>
        </td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="6" style=" border-right:none !important; color:#787878 !important;"><em>Nenhum lote cadastrado...</em></td>
        </tr>
    
    <? }?>
    </table>
    </div>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Lote cadastrado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center" style="z-index:100">
Lote alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "randok"){?>
<div id="message" align="center" style="z-index:100">
Ramdom executado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "exok"){?>
<div id="message" align="center" style="z-index:100">
Lote excluído com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>

</body>
</html>
