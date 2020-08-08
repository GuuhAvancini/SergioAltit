<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Imprimiu relatório IPHAN do leilão: ".$linha['descricao'].".\n";
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
    <td width="88%"><div id="tituloRelatorio" align="center">RELATÓRIO IPHAN - <?=$_SESSION['clienteNome']?><br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<?
	  $queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			if($linhaLot['iphan'] == "sim"){
			
	  ?>
      <table width="100%" border="0">
        <tr>
          <td width="7%" valign="top"><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
          <td width="93%">Descrição do Lote:<br />
          <?=$linhaLot['descricao']?></td>
        </tr>
        <tr>
          <td colspan="2" valign="top"><hr /></td>
        </tr>
      </table>
<? }}}?>
</body>
</html>
