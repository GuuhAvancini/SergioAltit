<?php include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' and idCadastro = '".$_GET['idCadastro']."' order by idPeca asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {

			$query = mysql_query("UPDATE `acervo` SET `nomeComitente` = '".$_POST['nome']."' WHERE `idPeca` = '".$linha['idPeca']."' ") or die(mysql_error());

		  }}


$query = mysql_query("UPDATE `compradores` SET `nome` = '".$_POST['nome']."', `email` = '".$_POST['email']."', `cpf` = '".$_POST['cpf']."', `cep` = '".$_POST['cep']."', `endereco` = '".$_POST['endereco']."', `numero` = '".$_POST['numero']."', `complemento` = '".$_POST['complemento']."', `bairro` = '".$_POST['bairro']."', `cidade` = '".$_POST['cidade']."', `estado` = '".$_POST['estado']."', `telefone` = '".$_POST['telefone']."', `celular` = '".$_POST['celular']."' WHERE `idCadastro` = '".$_GET['idCadastro']."' ") or die(mysql_error());

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usu�rio: ".$_SESSION['usuarioNome']." - Alterou os dados do comprador: ".$_POST['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: compradores.php?op=altok&id=".$_GET['idCadastro']."");

?>

