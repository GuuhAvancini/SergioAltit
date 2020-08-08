<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Visualizou o relatório de venda por compradores.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);



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
    <td width="88%"><div id="tituloRelatorio" align="center">RELATÓRIO COMPRADORES SIMPLES<br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<table width="100%" border="1" cellpadding="5" cellspacing="0"  style="font-size:12px;">
  <tr>
    <td width="26%" align="center">Nome do Comprador</td>
    <td width="32%">&nbsp;</td>
    <td width="15%" align="center">Valor Total</td>
    <td width="14%" align="center">Comissão Total</td>
    <td width="13%" align="center">Valor Total</td>
  </tr>
  <?
	  $queryLotes = "Select DISTINCT idComprador from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			   $valorArremateTotal = 0;
			  $comissaoTotal = 0;
			  
			$queryEc = "Select * from compradores where idCadastro = '".$linhaLotes['idComprador']."'";
			$resultadoEc = mysql_query($queryEc);
			$linhaEc = mysql_fetch_array($resultadoEc);
			
	  ?>
  <tr>
    <td height="67"><?=$linhaEc['nome']?><br />Telefone: <?=$linhaEc['telefone']?><br />Celular: <?=$linhaEc['celular']?><br />E-mail: <?=$linhaEc['email']?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?
	  
	  $queryLotesB = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and idComprador = '".$linhaLotes['idComprador']."' order by lote asc";
      $resultadoLotesB = mysql_query($queryLotesB);
	  if (mysql_num_rows($resultadoLotesB)!=0) {
		  while ($linhaLotesB = mysql_fetch_array($resultadoLotesB)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotesB['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			$comissao = ($linhaLotesB['valor']*$linhaLotesB['comissao'])/100;
			$comissaoTotal = $comissaoTotal+$comissao;
			
			$valorArremateTotal = $valorArremateTotal+$linhaLotesB['valor'];
			
		  }}
			
	  ?>R$ <?=number_format($valorArremateTotal, 2, ',', '.')?></td>
    <td align="center">R$ <?=number_format($comissaoTotal, 2, ',', '.')?></td>
    <td align="center">R$ <?=number_format($valorArremateTotal+$comissaoTotal, 2, ',', '.')?></td>
  </tr>
  <? }}else{?>
  <tr>
    <td colspan="5" align="center"><em>Nenhum arremate até o momento...</em></td>
  </tr><? }?>
</table>
</body>
</html>
