<?php include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$query = mysql_query("UPDATE `leiloes` SET `estatus` = '".utf8_encode("Preg�o")."' WHERE `idLeilaoN` = '".$_GET['id']."' ") or die(mysql_error());


$queryEc = "Select * from leiloes where idLeilaoN = '".$_GET['id']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);
$linhalog = "- ".date('d/m/Y - H:m:s')." - Usu�rio: ".$_SESSION['usuarioNome']." - Alterou o estatus para Preg�o do leilao: ".$linhaEc['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);



header("Location: index-home.php?op=altstok");

?>

