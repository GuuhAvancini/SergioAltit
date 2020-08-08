<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}



$queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' and idCadastro = '".$_GET['idCadastro']."' and estatus = 'Em estoque' order by idPeca asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {

	if ($_POST['sel_'.$linha['idPeca']] == "sim"){
		
		$idPeca = $linha['idPeca'];


$queryCs = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_POST['leilao']."' order by numLote desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $idLote = $linha['numLote']+1;
	  }else{
		  $idLote = 1;
	  }


	  $queryBC = "Select * from acervo where idPeca like '".$idPeca."'";
      $resultadoBC = mysql_query($queryBC);
	  $linhaBC = mysql_fetch_array($resultadoBC);

$query = mysql_query("INSERT INTO lotesLeiloes (codigoCliente, numLote, idLeilaoN, idPeca, idComitente) VALUES ('".$_SESSION['codigoCliente']."', '".$idLote."', '".$_POST['leilao']."', '".$idPeca."', '".$linhaBC['idCadastro']."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou a peça ".$idPeca." no lote ".$idLote." do leilão: ".$_POST['leilao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

	}

		  }}




header("Location: lotes-leilao.php?id=".$_POST['leilao']."&op=cadok");

?>

