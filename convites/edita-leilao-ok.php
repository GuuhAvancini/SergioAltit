<?php include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$data = $_POST['ano']."-".$_POST['mes']."-".$_POST['dia'];
//echo $data; exit();
$dataLeilao = $_POST['dia']."/".$_POST['mes']."/".$_POST['ano'];
if($_POST['siteAg'] == ""){$siteAg = "0";}else{$siteAg = $_POST['siteAg'];}
if($_POST['siteSergio'] == ""){$siteSergio = "0";}else{$siteSergio = $_POST['siteSergio'];}

if ($_FILES['fotoUpload']['name'] <> ""){
$cpfnome = uniqueAlfa();


// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../images/';

// Tamanho m�ximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 5; // 5Mb

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

$query = mysql_query("UPDATE `leiloes` SET convite = '".$nome_final."' WHERE `idLeilaoN` = '".$_GET['id']."' ") or die(mysql_error());

}



if ($_FILES['fotoUploadpdf']['name'] <> ""){

$cpfnome = uniqueAlfa();


// Pasta onde o arquivo vai ser salvo
$_UP['pasta'] = '../convites/';

// Tamanho m�ximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 20; // 5Mb

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

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
echo "Não foi possivel enviar o arquivo, tente novamente";
}

$query = mysql_query("UPDATE `leiloes` SET catalogopdf = '".$nome_finalpdf."' WHERE `idLeilaoN` = '".$_GET['id']."' ") or die(mysql_error());

}

	  


$query = mysql_query("UPDATE `leiloes` SET `estatus` = '".$_POST['estatus']."', descricao = '".$_POST['descricao']."', data = '".$data."', dataLeilao = '".$dataLeilao."', horario = '".$_POST['horario']."', website = '".$_POST['website']."', infos = '".str_replace("\n",'<br />', addslashes(htmlspecialchars($_POST['infos'])))."', urlLeilao = '".$_POST['urlLeilao']."', siteAg = '".$siteAg."', siteSergio = '".$siteSergio."' WHERE `idLeilaoN` = '".$_GET['id']."' ") or die(mysql_error());


if(utf8_decode($_POST['estatus']) == "Pregão"){
	
	$descricao = "Participando do Leilão: ".utf8_decode($_POST['descricao']);
	
	 $queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			  $query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaLotes['idPeca']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".utf8_encode($descricao)."')") or die(mysql_error());
			  
		  }
	  }
	
	
}



$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou os dados do leil�o: ".$_POST['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: index-home.php?op=altok");

?>

