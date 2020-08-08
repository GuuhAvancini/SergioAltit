<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryAr = "Select * from arremates where idArremate = '".$_GET['idArremate']."'";
$resultadoAr = mysql_query($queryAr);
$linhaAr = mysql_fetch_array($resultadoAr);


$query = mysql_query("DELETE FROM arremates WHERE idArremate = '".$_GET['idArremate']."' ") or die(mysql_error());

$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$queryLote = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and numLote = '".$linhaAr['lote']."'";
$resultadoLote = mysql_query($queryLote);
$linhaLote = mysql_fetch_array($resultadoLote);

$query = mysql_query("UPDATE `acervo` SET `estatus` = '".utf8_encode("Em estoque")."' WHERE `idPeca` = '".$linhaLote['idPeca']."' ") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Excluiu o arremate para o leilão: ".$linha['descricao']." - Lote: ".$linhaAr['lote'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: fechamento.php?op=exok&id=".$_GET['id']."");

?>

