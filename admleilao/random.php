<?php 
include("seguranca.php");

$queryLote = "Select * from lotesLeiloes where idLeilaoN = '".$_GET['idleilao']."' order by rand()";
$resultadoLote = mysql_query($queryLote);
if (mysql_num_rows($resultadoLote)!=0) {
$numeLote = 1;
while ($linhaLote = mysql_fetch_array($resultadoLote)) {

$query = mysql_query("UPDATE `lotesLeiloes` SET `numLote` = '".$numeLote."' WHERE `idLote` = '".$linhaLote['idLote']."' ") or die(mysql_error());

$numeLote = $numeLote+1;
}
}

$queryEc = "Select * from leiloes where idLeilaoN = '".$_GET['idleilao']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);
$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Deu um RAMDOM no leilao: ".$linhaEc['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: lotes-leilao.php?op=randok&id=".$_GET['idleilao']."");

?>