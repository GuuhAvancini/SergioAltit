<?php include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}




$cpfnome = uniqueAlfa();


// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../convites/';

// Tamanho m�ximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 10; // 5Mb

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'N�o houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'N�o foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
//if ($_FILES['fotoUpload']['error'] != 0) {
//die("N�o foi poss�vel fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['fotoUpload']['error']]);
//exit; // Para a execu��o do script
//}

// Faz a verifica��o do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['fotoUploadpdf']['size']) {
echo "O arquivo enviado é muito grande, envie arquivos de até 10Mb.";
}

// Mant�m o nome original do arquivo
$nome_finalpdf = $cpfnome.$_FILES['fotoUploadpdf']['name'];

// Depois verifica se � poss�vel mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['fotoUploadpdf']['tmp_name'], $_UP['pasta'] . $nome_finalpdf)) {
// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
} else {
// N�o foi poss�vel fazer o upload, provavelmente a pasta est� incorreta
echo "N�o foi poss�vel enviar o arquivo, tente novamente";
}

$query = mysql_query("UPDATE `leiloes` SET catalogopdf = '".$nome_finalpdf."' WHERE `idLeilaoN` = '".$_GET['id']."' ") or die(mysql_error());

echo $_GET['id'];exit();

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou os pdf do leilão: ".$_POST['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: index-home.php?op=altok");

?>

