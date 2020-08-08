<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $idLote = $linha['numLote']+1;
	  }else{
		  $idLote = 1;
	  }
	  

	  $queryBC = "Select * from acervo where idPeca like '".$_GET['idPeca']."'";
      $resultadoBC = mysql_query($queryBC);
	  $linhaBC = mysql_fetch_array($resultadoBC);

$query = mysql_query("INSERT INTO lotesLeiloes (codigoCliente, numLote, idLeilaoN, idPeca, idComitente) VALUES ('".$_SESSION['codigoCliente']."', '".$idLote."', '".$_GET['id']."', '".$_GET['idPeca']."', '".$linhaBC['idCadastro']."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou a peça ".$_GET['idPeca']." no lote ".$idLote." do leilão: ".$_GET['id'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: lotes-leilao.php?id=".$_GET['id']."&op=cadok");

?>

