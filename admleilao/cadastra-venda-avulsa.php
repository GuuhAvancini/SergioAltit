<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}



$query = mysql_query("UPDATE `acervo` SET `estatus` = 'Vendida' WHERE `idPeca` = '".$_GET['idPeca']."' ") or die(mysql_error());


$queryComp = "Select * from compradores where idComprador = '".$_POST['idComprador']."'";
$resultadoComp = mysql_query($queryComp);
$linhaComp = mysql_fetch_array($resultadoComp);

$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$query = mysql_query("INSERT INTO vendaAvulsa (codigoCliente, idPeca, data, date, idComprador, valor) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$_POST['idComprador']."', '".$_POST['valor']."')") or die(mysql_error());

$descricao = "Venda avulsa - Comprador: ".$linhaComp['nome']." - Valor: R$ ".$_POST['valor'];
$query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$descricao."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou a venda avulsa da peça: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['usuarioNome']);


header("Location: view-acervo.php?op=vendaok&idPeca=".$_GET['idPeca']."&idComp=".$_POST['idComprador']."");

?>

