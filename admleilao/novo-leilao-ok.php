<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' order by idLeilao desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $id = $linha['idLeilaoN']+1;
	  }else{
		  $id = 1;
	  }
	  
$data = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
$dataLeilao = $_POST['dia']."/".$_POST['mes']."/".$_POST['ano'];
$estatus = utf8_encode("Em produção");

$query = mysql_query("INSERT INTO leiloes (codigoCliente, idLeilaoN, descricao, data, dataLeilao, horario, estatus, infos) VALUES ('".$_SESSION['codigoCliente']."', '".$id."', '".$_POST['descricao']."', '".$data."', '".$dataLeilao."', '".$_POST['horario']."', '".$estatus."', ' ')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou o leilão: ".$_POST['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: index-home.php?op=cadok");

?>

