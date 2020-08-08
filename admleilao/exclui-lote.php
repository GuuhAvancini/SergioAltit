<?php 
include("seguranca.php");



$queryLote = "Select * from lotesLeiloes where numLote > '".$_GET['numLote']."' and idLeilaoN = '".$_GET['idleilao']."' order by numLote asc";
$resultadoLote = mysql_query($queryLote);
if (mysql_num_rows($resultadoLote)!=0) {
while ($linhaLote = mysql_fetch_array($resultadoLote)) {

$numeLote = $linhaLote['numLote']-1;

//$query = mysql_query("UPDATE `lotesLeiloes` SET `numLote` = '".$numeLote."' WHERE `idLote` = '".$linhaLote['idLote']."' ") or die(mysql_error());

}
}

$query = mysql_query("DELETE FROM lotesLeiloes WHERE idLote = '".$_GET['idLote']."' ") or die(mysql_error());

$queryEc = "Select * from leiloes where idLeilaoN = '".$_GET['idleilao']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuario: ".$_SESSION['usuarioNome']." - Excluiu o lote: ".$_GET['numLote']." do Leilao: ".$linhaEc['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);




header("Location: lotes-leilao.php?op=exok&id=".$_GET['idleilao']."");

?>