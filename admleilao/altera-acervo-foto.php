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


$query = mysql_query("UPDATE `acervo` SET `foto` = '".$nome_final."' WHERE `idPeca` = '".$_GET['idPeca']."' ") or die(mysql_error());


$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou a foto da peça: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['usuarioNome']);

if($_GET['pagina'] == "acervo"){
header("Location: acervo.php?op=altok");
}elseif($_GET['pagina'] == "leilao"){
header("Location: lotes-leilao.php?op=altok&id=".$_GET['id']."");
}else{
header("Location: view-acervo.php?op=altok&idPeca=".$_GET['idPeca']."");
}
?>

