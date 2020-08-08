<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if ($_FILES['fotoUpload']['name'] <> ""){
$cpfnome = uniqueAlfa();
}

// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = 'fotos/';

// Tamanho m�ximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 5; // 5Mb

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'N�o houve erro';
$_UP['erros'][1] = 'O arquivo no upload � maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'N�o foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
//if ($_FILES['fotoUpload']['error'] != 0) {
//die("N�o foi poss�vel fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['fotoUpload']['error']]);
//exit; // Para a execu��o do script
//}

// Faz a verifica��o do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['fotoUpload']['size']) {
echo "O arquivo enviado � muito grande, envie arquivos de at� 5Mb.";
}

// Mant�m o nome original do arquivo
$nome_final = $cpfnome.$_FILES['fotoUpload']['name'];

// Depois verifica se � poss�vel mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['fotoUpload']['tmp_name'], $_UP['pasta'] . $nome_final)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
} else {
// N�o foi poss�vel fazer o upload, provavelmente a pasta est� incorreta
echo "N�o foi poss�vel enviar o arquivo, tente novamente";
}

$queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' order by idAcervo desc";
$resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
		  $id = $linha['idAcervo']+1;
	  }else{
		  $id = 1;
	  }
	  
$queryEc = "Select * from comitentes where nome = '".$_POST['txtCliente']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);
$idComitente = $linhaEc ['idCadastro'];

$query = mysql_query("INSERT INTO acervo (codigoCliente, idAcervo, idCadastro, datacadastro, descricao, foto, valor, valorInicial, estatus, tipoComissao, comissao, overprice, localizacaoPeca, iphan, nomeComitente, obsImp, website, artista, categoria) VALUES ('".$_SESSION['codigoCliente']."', '".$id."', '".$idComitente."', '".date('d/m/Y - H:m:s')."', '".$_POST['descricao']."', '".$nome_final."', '".$_POST['valor']."', '".$_POST['valor']."', 'Em estoque', '".$_POST['tipoComissao']."', '".$_POST['comissao']."', '".$_POST['overprice']."', '".$_POST['localizacaoPeca']."', '".$_POST['iphan']."', '".$linhaEc['nome']."', '".$_POST['obsImp']."', '".$_POST['website']."', '".$_POST['artista']."', '".$_POST['categoria']."')") or die(mysql_error());

$sql = "SELECT LAST_INSERT_ID()"; 
$con = mysql_query($sql) or die ("Problemas na Consulta! ".mysql_error());
$res = mysql_fetch_row($con);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usu�rio: ".$_SESSION['usuarioNome']." - Cadastrou o pe�a: ".$_POST['nome'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);



header("Location: acervo.php?op=cadok&idpeca=".$id."");
?>

