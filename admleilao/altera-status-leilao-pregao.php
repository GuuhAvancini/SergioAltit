<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$query = mysql_query("UPDATE `leiloes` SET `estatus` = '".utf8_encode("Pregão")."' WHERE `idLeilaoN` = '".$_GET['id']."' ") or die(mysql_error());


$queryEc = "Select * from leiloes where idLeilaoN = '".$_GET['id']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);
$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou o estatus para Pregão do leilao: ".$linhaEc['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);



header("Location: index-home.php?op=altstok");

?>

