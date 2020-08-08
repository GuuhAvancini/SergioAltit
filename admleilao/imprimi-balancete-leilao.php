<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Imprimiu o balancete do leilão: ".$linha['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$_SESSION['clienteNome']?></title>
<link rel="stylesheet" href="myAuction.css" type="text/css" />
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td width="12%"><img src="images/logoSergio.jpg" width="79" height="100" /></td>
    <td width="88%"><div id="tituloRelatorio" align="center">BALANCETE LEILÃO - <?=$_SESSION['clienteNome']?><br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<table width="600" border="1" cellpadding="5" cellspacing="0" align="center" bordercolor="#FFFFFF">
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
        <td bgcolor="#EAEAEA" style="color:#787878 !important;" >Total de vendas no leilão:</td>
        <td align="center" bgcolor="#EAEAEA" style="color:#787878 !important;" >R$ <?=number_format($totalVendas, 2, ',', '.')?></td>
      </tr>
      <tr bgcolor="#fffdea">
        <td bgcolor="#EAEAEA" style="color:#787878 !important;" >Total de comissão do leiloeiro:</td>
        <td  align="center" bgcolor="#EAEAEA" style="color:#787878 !important;">R$ <?=number_format($totalComissaoLeiloeiro, 2, ',', '.')?></td>
      </tr>
      <tr bgcolor="#fffdea">
        <td bgcolor="#EAEAEA" style="color:#787878 !important;" >&nbsp;</td>
        <td bgcolor="#EAEAEA" style="color:#787878 !important;" >&nbsp;</td>
      </tr>
      <tr bgcolor="#fffdea">
        <td bgcolor="#EAEAEA" style="color:#787878 !important;" >Total - Comissão da Galeria:
        </td>
        <td  align="center" bgcolor="#EAEAEA" style="color:#787878 !important;">R$ <?=number_format($totalGaleria, 2, ',', '.')?></td>
      </tr>
      <tr bgcolor="#fffdea">
        <td bgcolor="#EAEAEA" style="color:#787878 !important;" >Saldo dos Comitentes:</td>
        <td  align="center" bgcolor="#EAEAEA" style="color:#787878 !important;">R$ <?=number_format($totalComitentes, 2, ',', '.')?></td>
      </tr>
    </table>
</body>
</html>
