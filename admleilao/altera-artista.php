<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}



$query = mysql_query("UPDATE `artistas` SET `nome` = '".$_POST['nome']."', `biografia` = '".str_replace("\n",'<br />', addslashes(htmlspecialchars($_POST['biografia'])))."', `referencias` = '".$_POST['referencias']."' WHERE `idArtista` = '".$_GET['idArtista']."' ") or die(mysql_error());

header("Location: artistas.php?op=altok");
?>

