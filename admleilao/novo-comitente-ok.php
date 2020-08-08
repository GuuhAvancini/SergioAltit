<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryVer = "Select * from comitentes where nome like '%".$_POST['nome']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or cpf like '%".$_POST['cpf']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
$resultadoVer = mysql_query($queryVer);
if (mysql_num_rows($resultadoVer)!=0) {
	
	header("Location: comitentes.php?op=caddup");
	
}else{


$queryCs = "Select * from comitentes where codigoCliente = '".$_SESSION['codigoCliente']."' order by idComitente desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $id = $linha['idComitente']+1;
	  }else{
		  $id = 1;
	  }

$query = mysql_query("INSERT INTO comitentes (codigoCliente, idComitente, nome, endereco, numero, complemento, cidade, estado, cep, cpf, email, telefone, celular, banco, agencia, conta, tipoConta, favorecido, cpfFavorecido) VALUES ('".$_SESSION['codigoCliente']."', '".$id."', '".$_POST['nome']."', '".$_POST['endereco']."', '".$_POST['numero']."', '".$_POST['complemento']."', '".$_POST['cidade']."', '".$_POST['estado']."', '".$_POST['cep']."', '".$_POST['cpf']."', '".strtolower($_POST['email'])."', '".$_POST['telefone']."', '".$_POST['celular']."', '".$_POST['banco']."', '".$_POST['agencia']."', '".$_POST['conta']."', '".$_POST['tipoConta']."', '".$_POST['favorecido']."', '".$_POST['cpfFavorecido']."')") or die(mysql_error());

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou comitente: ".$_POST['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: comitentes.php?op=cadok&id=".$id."");

}
?>

