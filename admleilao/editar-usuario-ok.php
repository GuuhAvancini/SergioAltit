<?php include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


if($_POST['acervoAcesso'] == ""){$acervoAcesso = 0;}else{$acervoAcesso = $_POST['acervoAcesso'];}
if($_POST['acervoEditar'] == ""){$acervoEditar = 0;}else{$acervoEditar = $_POST['acervoEditar'];}
if($_POST['comitenteAcesso'] == ""){$comitenteAcesso = 0;}else{$comitenteAcesso = $_POST['comitenteAcesso'];}
if($_POST['comitenteEditar'] == ""){$comitenteEditar = 0;}else{$comitenteEditar = $_POST['comitenteEditar'];}
if($_POST['compradorAcesso'] == ""){$compradorAcesso = 0;}else{$compradorAcesso = $_POST['compradorAcesso'];}
if($_POST['compradorEditar'] == ""){$compradorEditar = 0;}else{$compradorEditar = $_POST['compradorEditar'];}
if($_POST['leilaoAcesso'] == ""){$leilaoAcesso = 0;}else{$leilaoAcesso = $_POST['leilaoAcesso'];}
if($_POST['leilaoEditar'] == ""){$leilaoEditar = 0;}else{$leilaoEditar = $_POST['leilaoEditar'];}
if($_POST['financeiroAcesso'] == ""){$financeiroAcesso = 0;}else{$financeiroAcesso = $_POST['financeiroAcesso'];}
if($_POST['configsAcesso'] == ""){$configsAcesso = 0;}else{$configsAcesso = $_POST['configsAcesso'];}
if($_POST['websiteAcesso'] == ""){$websiteAcesso = 0;}else{$websiteAcesso = $_POST['websiteAcesso'];}


$query = mysql_query("UPDATE `users` SET `nomeUsuario` = '".$_POST['nomeUsuario']."', `usuarioAcesso` = '".$_POST['usuarioAcesso']."', `senhaAcesso` = '".$_POST['senhaAcesso']."', `acervoAcesso` = '".$acervoAcesso."', `acervoEditar` = '".$acervoEditar."', `comitenteAcesso` = '".$comitenteAcesso."', `comitenteEditar` = '".$comitenteEditar."', `compradorAcesso` = '".$compradorAcesso."', `compradorEditar` = '".$compradorEditar."', `leilaoAcesso` = '".$leilaoAcesso."', `leilaoEditar` = '".$leilaoEditar."', `financeiroAcesso` = '".$financeiroAcesso."', `configsAcesso` = '".$configsAcesso."', `websiteAcesso` = '".$websiteAcesso."' WHERE `idUser` = '".$_GET['id']."' ") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Alterou o usuário: ".$_POST['nomeUsuario'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: configuracoes.php?op=altok");

?>

