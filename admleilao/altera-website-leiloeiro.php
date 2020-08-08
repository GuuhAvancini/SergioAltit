<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$query = mysql_query("UPDATE `website` SET `texto` = '".$_POST['descricao']."' WHERE `idPagina` = '3' and codigoCliente = '".$_SESSION['codigoCliente']."' ") or die(mysql_error());

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou o texto quem somos do site.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);



header("Location: leiloeiro.php?op=altok");
?>

