<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryVer = "Select * from compradores where nome like '%".$_POST['nome']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or cpf like '%".$_POST['cpf']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
$resultadoVer = mysql_query($queryVer);
if (mysql_num_rows($resultadoVer)!=0) {
	
	header("Location: compradores.php?op=caddup");
	
}else{


$queryCs = "Select * from compradores where codigoCliente = '".$_SESSION['codigoCliente']."' order by idComprador desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $id = $linha['idComprador']+1;
	  }else{
		  $id = 1;
	  }

$query = mysql_query("INSERT INTO compradores (codigoCliente, idComprador, nome, endereco, numero, complemento, bairro, cidade, estado, cep, cpf, email, telefone, celular) VALUES ('".$_SESSION['codigoCliente']."', '".$id."', '".$_POST['nome']."', '".$_POST['endereco']."', '".$_POST['numero']."', '".$_POST['complemento']."', '".$_POST['bairro']."', '".$_POST['cidade']."', '".$_POST['estado']."', '".$_POST['cep']."', '".$_POST['cpf']."', '".strtolower($_POST['email'])."', '".$_POST['telefone']."', '".$_POST['celular']."')") or die(mysql_error());

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou comprador: ".$_POST['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: compradores.php?op=cadok&id=".$id."");

}
?>

