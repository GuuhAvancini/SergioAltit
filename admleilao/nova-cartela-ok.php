<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryEc = "Select * from compradores where nome = '".$_POST['txtCliente']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);
$idComitente = $linhaEc ['idCadastro'];


$query = mysql_query("INSERT INTO cartelas (codigoCliente, idLeilaoN, idComitente, cartela) VALUES ('".$_SESSION['codigoCliente']."', '".$_GET['id']."', '".$idComitente."', '".$_POST['cartela']."')") or die(mysql_error());

$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou a cartela para o leilão: ".$linha['descricao']." - Comprador: ".$linhaEc['nome']." - Cartela: ".$_POST['cartela'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: cartelas.php?op=cadok&id=".$_GET['id']."");

?>

