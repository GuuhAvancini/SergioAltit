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
<style type="text/css">
.break { page-break-before: always; }
</style>
</head>

<body>
<?
$queryLotes = "Select DISTINCT idComprador from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
?>
<table width="100%" border="0">
  <tr>
    <td width="12%"><img src="images/logoSergio.jpg" width="79" height="100" /></td>
    <td width="88%"><div id="tituloRelatorio" align="center">Despacho de Peças<br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<?
	  
			  
			$queryEc = "Select * from compradores where idCadastro = '".$linhaLotes['idComprador']."'";
			$resultadoEc = mysql_query($queryEc);
			$linhaEc = mysql_fetch_array($resultadoEc);
			
	  ?>
      <div  >Comprador: <?=$linhaEc['nome']?><br />
      Endereço: <?=$linhaEc['endereco']?> <?=$linhaEc['numero']?> <?=$linhaEc['complemento']?> <?=$linhaEc['bairro']?> - <?=$linhaEc['cidade']?> - <?=$linhaEc['estado']?> - Cep: <?=$linhaEc['cep']?><br /><br />
      </div>
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
          <td width="9%" valign="top">LOTE: <?=$linhaLotesB['lote']?><?=$linhaLotesB['loteExt']?></td>
          <td width="6%" valign="top"><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
          <td width="85%" valign="top">Descrição do Lote:<br />
          <?=$linhaLot['descricao']?></td>
        </tr>
        <? 
		$ValorTotal = $ValorTotal+$linhaLotesB['valor'];
		$valorcomissaoTotal = $valorcomissaoTotal+$comissao;
		}}
		$ValorLiquido = $ValorTotal + $valorcomissaoTotal;
		?>
        
      </table>
      <br />
<p class="break"></p>
<? }}?>
</body>
</html>
