<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Imprimiu relatório da JUCESP do leilão: ".$linha['descricao'].".\n";
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
    <td width="88%"><div id="tituloRelatorio" align="center">RELATÓRIO JUCESP - <?=$_SESSION['clienteNome']?><br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<?
	  $queryLotes = "Select DISTINCT idComitente from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryEc = "Select * from comitentes where idCadastro = '".$linhaLotes['idComitente']."'";
			$resultadoEc = mysql_query($queryEc);
			$linhaEc = mysql_fetch_array($resultadoEc);
			
	  ?>
      Comitente: <?=$linhaEc['nome']?> - CPF: <?=$linhaEc['cpf']?><br />
      Endereço: <?=$linhaEc['endereco']?> <?=$linhaEc['numero']?> <?=$linhaEc['complemento']?> - <?=$linhaEc['bairro']?> - <?=$linhaEc['cidade']?> - <?=$linhaEc['estado']?> - Cep: <?=$linhaEc['cep']?>
      <table width="100%" border="0">
      <?
	  
	  $queryLotesB = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and idComitente = '".$linhaLotes['idComitente']."' order by numLote asc";
      $resultadoLotesB = mysql_query($queryLotesB);
	  if (mysql_num_rows($resultadoLotesB)!=0) {
		  while ($linhaLotesB = mysql_fetch_array($resultadoLotesB)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotesB['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
	  ?>
        <tr>
          <td width="7%" valign="top">LOTE: <?=$linhaLotesB['numLote']?><?=$linhaLotesB['loteExt']?></td>
          <td width="93%">Descrição do Lote:<br />
          <?=str_replace("<br />"," - ",$linhaLot['descricao'])?></td>
        </tr>
        <? }}?>
        <tr>
          <td colspan="2" valign="top"><hr /></td>
        </tr>
      </table>
<? }}?>
</body>
</html>
