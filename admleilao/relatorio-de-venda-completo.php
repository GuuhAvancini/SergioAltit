<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Visualizou o relatório de venda completo.\n";
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
    <td width="88%"><div id="tituloRelatorio" align="center">RELATÓRIO DE VENDA - <?=$_SESSION['clienteNome']?><br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<?
	  $queryLotes = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryLot = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and numLote = '".$linhaLotes['lote']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			  
			$queryAc = "Select * from acervo where idPeca = '".$linhaLot['idPeca']."'";
			$resultadoAc = mysql_query($queryAc);
			$linhaAc = mysql_fetch_array($resultadoAc);
			
			$queryEc = "Select * from compradores where idCadastro = '".$linhaLotes['idComprador']."'";
			$resultadoEc = mysql_query($queryEc);
			$linhaEc = mysql_fetch_array($resultadoEc);
			
	  ?>
<table width="100%" border="0" style="font-size:12px;">
        <tr>
          <td width="7%" valign="top">LOTE: <br />            <?=$linhaLotes['lote']?><?=$linhaLotes['loteExt']?></td>
          <td width="5%" valign="top"><img src="fotos/<? 
	if ($linhaAc['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaAc['foto'];}?>" width="52" height="56" /></td>
          <td width="46%" valign="top">Descrição do Lote:<br />
          <?=$linhaAc['descricao']?><br />Lance inicial: R$ <?=$linhaAc['valor']?></td>
          <td width="42%" valign="top">Arrematado por:<br />
            <?=$linhaLotes['cartela']?> - <?=$linhaEc['nome']?><br />
            Valor do Lance: R$ <?=number_format($linhaLotes['valor'], 2, ',', '.')?><br />
            Comissão Leiloeiro: R$ 
            <? $comissao = ($linhaLotes['valor']*$linhaLotes['comissao'])/100;
			echo  number_format($comissao, 2, ',', '.');
			?> &nbsp;&nbsp;&nbsp; Total: R$ <?=number_format($comissao+$linhaLotes['valor'], 2, ',', '.')?></td>
        </tr>
        <tr>
          <td colspan="4" valign="top"><hr /></td>
        </tr>
      </table>
<? }}?>
</body>
</html>
