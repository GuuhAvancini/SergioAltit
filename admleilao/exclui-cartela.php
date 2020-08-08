<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$query = mysql_query("DELETE FROM cartelas WHERE idCartela = '".$_GET['idCartela']."' ") or die(mysql_error());

$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$queryCs = "Select * from cartelas where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by cartela asc";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Excluiu a cartela para o leilão: ".$linha['descricao']." - Cartela: ".$linha['cartela'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: cartelas.php?op=exok&id=".$_GET['id']."");

?>

