<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}



    $queryCs = "Select * from vendaAvulsaTemp where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."' and idTemp = '".$_SESSION['idTemp']."'";
	  $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {

$query = mysql_query("UPDATE `acervo` SET `estatus` = 'Vendida' WHERE `idPeca` = '".$linha['idPeca']."' ") or die(mysql_error());


$queryComp = "Select * from compradores where idComprador = '".$_GET['idCadastro']."'";
$resultadoComp = mysql_query($queryComp);
$linhaComp = mysql_fetch_array($resultadoComp);

$queryEc = "Select * from acervo where idPeca = '".$linha['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$query = mysql_query("INSERT INTO vendaAvulsa (codigoCliente, idPeca, data, date, idComprador, valor, idTemp) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$_GET['idCadastro']."', '".$linhaEc['valor']."', '".$_SESSION['idTemp']."')") or die(mysql_error());

$descricao = "Venda avulsa - Comprador: ".$linhaComp['nome']." - Valor: R$ ".$linhaEc['valor'];
$query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$descricao."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou a venda avulsa da peça: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['usuarioNome']);

		  }}



header("Location: view-comprador.php?op=vendaok&idCadastro=".$_GET['idCadastro']."&idTemp=".$_SESSION['idTemp']."");

?>

