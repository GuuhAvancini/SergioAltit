<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCas = "Select * from cartelas where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and cartela = '".$_POST['cartela']."'";
$resultadoCas = mysql_query($queryCas);
$linhaCa = mysql_fetch_array($resultadoCas);

$queryLote = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and numLote = '".$_POST['lote']."' and loteExt = '".$_POST['loteExt']."'";
$resultadoLote = mysql_query($queryLote);
$linhaLote = mysql_fetch_array($resultadoLote);


$queryAc = "Select * from acervo where idPeca = '".$linhaLote['idPeca']."'";
$resultadoAc = mysql_query($queryAc);
$linhaAc = mysql_fetch_array($resultadoAc);


$query = mysql_query("INSERT INTO arremates (codigoCliente, idLeilaoN, lote, loteExt, idPeca, idComitente, idComprador, cartela, valor, comissao) VALUES ('".$_SESSION['codigoCliente']."', '".$_GET['id']."', '".$_POST['lote']."', '".$_POST['loteExt']."', '".$linhaLote['idPeca']."', '".$linhaAc['idCadastro']."', '".$linhaCa['idComitente']."', '".$_POST['cartela']."', '".$_POST['valor']."', '".$_POST['comissao']."')") or die(mysql_error());



$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);



$query = mysql_query("UPDATE `acervo` SET `estatus` = '".utf8_encode("Arrematada")."' WHERE `idPeca` = '".$linhaLote['idPeca']."' ") or die(mysql_error());

$queryComp = "Select * from compradores where idCadastro = '".$linhaCa['idComitente']."'";
$resultadoComp = mysql_query($queryComp);
$linhaComp = mysql_fetch_array($resultadoComp);


$descricao = "Arremate - Leilão ".$linha['descricao']." - Lote: ".$_POST['lote'].$_POST['loteExt']." - Cartela: ".$_POST['cartela']." - Comprador: ".$linhaComp['nome']." - Id Peça: ".$linhaAc['idAcervo'];
$query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaAc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".utf8_encode($descricao)."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou o arremate para o leilão: ".$linha['descricao']." - Lote: ".$_POST['lote'].$_POST['loteExt']." - Cartela: ".$_POST['cartela'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: fechamento.php?op=cadok&id=".$_GET['id']."");

?>

