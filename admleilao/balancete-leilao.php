<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Visualizou o balancete do leilão: ".$linha['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

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
        Balancete - Leilão</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <p><?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?> <span style="margin-left:50px;">Estatus: <?=$linha['estatus']?> 
        <a href="leilao-relatorios.php?id=<?=$_GET['id']?>"><img src="images/1400355878_arrow-return-180.png" width="16" height="16"  align="absmiddle"/></a></span></p>
    </div>
    </div>
    
  <div id="tabelaBuscaCadastros"><input type="button" value="Imprimir" name="new_button" id="new_button" onclick="window.open('imprimi-balancete-leilao.php?id=<?=$_GET['id']?>')" style="float:right !important; position:absolute !important; right:50px !important; margin-top:50px;">
    <table width="450" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:150px !important;">
      <tr>
        <td width="60%"></td>
        <td width="40%" align="center">Valor Total</td>
      </tr>
      <?
	  $totalVendas = 0;
	  $totalComissaoLeiloeiro = 0;
	  $totalGaleria = 0;
	  $totalComitentes = 0;
	  $queryLotes = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			  $totalComissaoLeiloeiro = (($linhaLotes['valor']*$linhaLotes['comissao'])/100)+$totalComissaoLeiloeiro;
			  $totalVendas = $linhaLotes['valor']+$totalVendas;
			  
			  $queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			  $resultadoLot = mysql_query($queryLot);
			  $linhaLot = mysql_fetch_array($resultadoLot);
			  if($linhaLot['tipoComissao'] == "normal"){
				  $totalGaleria = (($linhaLotes['valor']*$linhaLot['comissao'])/100)+$totalGaleria;
			  }elseif($linhaLot['tipoComissao'] == "overprice"){
				  $totalGaleria = ($linhaLotes['valor']-$linhaLot['overprice'])+$totalGaleria;
			  }
			  
			  
			
		  }}
		  $totalComitentes = $totalVendas-$totalGaleria;
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" >Total de vendas no leilão:</td>
        <td style="color:#787878 !important;" align="center" >R$ <?=number_format($totalVendas, 2, ',', '.')?></td>
      </tr>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" >Total de comissão do leiloeiro:</td>
        <td style="color:#787878 !important;"  align="center">R$ <?=number_format($totalComissaoLeiloeiro, 2, ',', '.')?></td>
      </tr>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" >&nbsp;</td>
        <td style="color:#787878 !important;" >&nbsp;</td>
      </tr>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" >Total - Comissão da Galeria:
        </td>
        <td style="color:#787878 !important;"  align="center">R$ <?=number_format($totalGaleria, 2, ',', '.')?></td>
      </tr>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" >Saldo dos Comitentes:</td>
        <td style="color:#787878 !important;"  align="center">R$ <?=number_format($totalComitentes, 2, ',', '.')?></td>
      </tr>
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
