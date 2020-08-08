<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$query = mysql_query("UPDATE `comitentes` SET `nome` = '".$_POST['nome']."', `email` = '".$_POST['email']."', `cpf` = '".$_POST['cpf']."', `cep` = '".$_POST['cep']."', `endereco` = '".$_POST['endereco']."', `numero` = '".$_POST['numero']."', `complemento` = '".$_POST['complemento']."', `bairro` = '".$_POST['bairro']."', `cidade` = '".$_POST['cidade']."', `estado` = '".$_POST['estado']."', `telefone` = '".$_POST['telefone']."', `celular` = '".$_POST['celular']."', `banco` = '".$_POST['banco']."', `agencia` = '".$_POST['agencia']."', `conta` = '".$_POST['conta']."', `tipoConta` = '".$_POST['tipoConta']."', `favorecido` = '".$_POST['favorecido']."',`cpfFavorecido` = '".$_POST['cpfFavorecido']."' WHERE `idCadastro` = '".$_GET['idCadastro']."' ") or die(mysql_error());

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou os dados do comitente: ".$_POST['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: comitentes.php?op=altok&id=".$_GET['idCadastro']."");

?>

