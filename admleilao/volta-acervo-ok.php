<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}



$query = mysql_query("UPDATE `acervo` SET `estatus` = 'Em estoque' WHERE `idPeca` = '".$_GET['idPeca']."' ") or die(mysql_error());



$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$descricao = "Retornou ao acervo - Motivo: ".$_POST['motivo']."";
$query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$descricao."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usu�rio: ".$_SESSION['usuarioNome']." - Voltou a pe�a para o acervo: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['usuarioNome']);


header("Location: view-acervo.php?op=altok&idPeca=".$_GET['idPeca']."");

?>

