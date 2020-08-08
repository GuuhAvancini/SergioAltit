<?php 
include("seguranca.php");
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}
	
$query = mysql_query("UPDATE `lotesLeiloes` SET `numLote` = '".$_GET['atual']."' WHERE `idLote` = '".$_GET['idlotelugar']."' ") or die(mysql_error());
	
$query = mysql_query("UPDATE `lotesLeiloes` SET `numLote` = '".$_GET['lotefinal']."' WHERE `idLote` = '".$_GET['idLote']."' ") or die(mysql_error());

$queryEc = "Select * from leiloes where idleilao = '".$_GET['idleilao']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);
$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuario: ".$_SESSION['usuarioNome']." - Mudou o lote: ".$_GET['atual']." para ".$_GET['lotefinal']." do leilao: ".$linhaEc['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

	
header("Location: lotes-leilao.php?op=altok&id=".$_GET['idleilao']."");


?>