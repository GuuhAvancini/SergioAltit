<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$query = mysql_query("UPDATE `acervo` SET idCadastro = '".$_GET['idCadastro']."' WHERE `idPeca` = '".$_GET['idPeca']."' ") or die(mysql_error());

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou o comitente da peça: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

	$queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idPeca = '".$linhaEc['idPeca']."' order by numLote asc";
    $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			
			  $query = mysql_query("UPDATE `lotesLeiloes` SET idComitente = '".$_GET['idCadastro']."' WHERE `idLote` = '".$linhaLotes['idLote']."' ") or die(mysql_error());
			  
		  }}



header("Location: view-acervo.php?op=altok&idPeca=".$_GET['idPeca']."");

?>

