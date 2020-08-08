<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if ($_FILES['fotoUpload']['name'] <> ""){
$cpfnome = uniqueAlfa();


// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../images/';

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


$query = mysql_query("UPDATE `website` SET `foto` = '".$nome_final."', link = '".$_POST['link']."' WHERE `idPagina` = '4' and codigoCliente = '".$_SESSION['codigoCliente']."' ") or die(mysql_error());

}else{
	
$query = mysql_query("UPDATE `website` SET link = '".$_POST['link']."' WHERE `idPagina` = '4' and codigoCliente = '".$_SESSION['codigoCliente']."' ") or die(mysql_error());

}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou ou Ativou a imagem da Captação do site.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);



header("Location: leiloes-website.php?op=altok");
?>

