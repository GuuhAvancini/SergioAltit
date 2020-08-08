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
    <td width="88%"><div id="tituloRelatorio" align="center">RELATÓRIO VENDAS POR COMPRADORES - <?=$_SESSION['clienteNome']?><br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<?
	  $queryLotes = "Select DISTINCT idComprador from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryEc = "Select * from compradores where idCadastro = '".$linhaLotes['idComprador']."'";
			$resultadoEc = mysql_query($queryEc);
			$linhaEc = mysql_fetch_array($resultadoEc);
			
	  ?>
<div  >Comprador: <?=$linhaEc['nome']?><br />Telefone: <?=$linhaEc['telefone']?> - Celular: <?=$linhaEc['celular']?> - E-mail: <?=$linhaEc['email']?><br /></div>
      <table width="100%" border="0" style="font-size:12px;">
      <?
	  
	  $queryLotesB = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and idComprador = '".$linhaLotes['idComprador']."' order by lote asc";
      $resultadoLotesB = mysql_query($queryLotesB);
	  if (mysql_num_rows($resultadoLotesB)!=0) {
		  while ($linhaLotesB = mysql_fetch_array($resultadoLotesB)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotesB['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
	  ?>
        <tr>
          <td width="7%" valign="top">LOTE: <?=$linhaLotesB['lote']?><?=$linhaLotesB['loteExt']?></td>
          <td width="5%" valign="top"><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
          <td width="43%" valign="top">Descrição do Lote:<br />
          <?=$linhaLot['descricao']?></td>
          <td width="42%" valign="top">
            Valor do Lance: R$ <?=number_format($linhaLotesB['valor'], 2, ',', '.')?><br />
            Comissão Leiloeiro: R$ 
          <? $comissao = ($linhaLotesB['valor']*$linhaLotesB['comissao'])/100;
			echo  number_format($comissao, 2, ',', '.');
			?> &nbsp;&nbsp;&nbsp; Total: R$ <?=number_format($comissao+$linhaLotesB['valor'], 2, ',', '.')?></td>
        </tr>
        <? }}?>
        <tr>
          <td colspan="4" valign="top"><hr /></td>
        </tr>
      </table>
<? }}?>
</body>
</html>
