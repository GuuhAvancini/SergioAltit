<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if ($_FILES['fotoUpload']['name'] <> ""){
$cpfnome = uniqueAlfa();
}

// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'fotos/';

// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 5; // 5Mb

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
//if ($_FILES['fotoUpload']['error'] != 0) {
//die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['fotoUpload']['error']]);
//exit; // Para a execução do script
//}

// Faz a verificação do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['fotoUpload']['size']) {
echo "O arquivo enviado é muito grande, envie arquivos de até 5Mb.";
}

// Mantém o nome original do arquivo
$nome_final = $cpfnome.$_FILES['fotoUpload']['name'];

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['fotoUpload']['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
} else {
// Não foi possível fazer o upload, provavelmente a pasta está incorreta
echo "Não foi possível enviar o arquivo, tente novamente";
}

$queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' order by idAcervo desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $id = $linha['idAcervo']+1;
	  }else{
		  $id = 1;
	  }

$query = mysql_query("INSERT INTO acervo (codigoCliente, idAcervo, idCadastro, datacadastro, descricao, foto, valor, valorInicial, estatus, tipoComissao, comissao, overprice, localizacaoPeca, iphan, obsImp, website, artista) VALUES ('".$_SESSION['codigoCliente']."', '".$id."', '".$_GET['idCadastro']."', '".date('d/m/Y - H:m:s')."', '".$_POST['descricao']."', '".$nome_final."', '".$_POST['valor']."', '".$_POST['valor']."', 'Em estoque', '".$_POST['tipoComissao']."', '".$_POST['comissao']."', '".$_POST['overprice']."', '".$_POST['localizacaoPeca']."', '".$_POST['iphan']."', '".$_POST['obsImp']."', '".$_POST['website']."', '".$_POST['artista']."')") or die(mysql_error());

$sql = "SELECT LAST_INSERT_ID()"; 
$con = mysql_query($sql) or die ("Problemas na Consulta! ".mysql_error());
$res = mysql_fetch_row($con);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Cadastrou o peça: ".$_POST['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);





header("Location: view-comitente.php?idCadastro=".$_GET['idCadastro']."&op=cadok&idpeca=".$id."");
?>

