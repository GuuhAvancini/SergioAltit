<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}



$queryEc = "Select * from acervo where idAcervo = '".$_POST['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
if (mysql_num_rows($resultadoEc)==0) {
	header("Location: emprestimo-peca-comprador.php?idCadastro=".$_GET['idCadastro']."&op=emperrok");
}else{
$linhaEc = mysql_fetch_array($resultadoEc);

$query = mysql_query("INSERT INTO emprestimo (codigoCliente, idPeca, idComprador, dataEmprestimo, motivo, tipo) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idPeca']."', '".$_GET['idCadastro']."', '".date('d/m/Y - H:m:s')."', '".$_POST['motivo']."', '".utf8_encode("Empréstimo")."')") or die(mysql_error());


$queryComt = "Select * from compradores where idCadastro = '".$_GET['idCadastro']."'";
$resultadoComt = mysql_query($queryComt);
$linhaComt = mysql_fetch_array($resultadoComt);
$descricao = utf8_encode("Empréstimo de acervo para: ").$linhaComt['nome']." - Motivo: ".$_POST['motivo']."";
$query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaEc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$descricao."')") or die(mysql_error());


$query = mysql_query("UPDATE `acervo` SET `estatus` = '".utf8_encode("Emprestada")."' WHERE `idPeca` = '".$linhaEc['idPeca']."' ") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou o emprestimo para peça: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: view-comprador.php?idCadastro=".$_GET['idCadastro']."&op=empok&idAcervo=".$_POST['idPeca']."");
}
?>

