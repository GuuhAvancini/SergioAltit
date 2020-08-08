<?php
include("seguranca.php");

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuario: ".$_SESSION['usuarioNome']." saiu do sistema.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

$_SESSION['usuarioID'] = ""; 
$_SESSION['usuarioNome'] = ""; 
$_SESSION['ultimologin'] = "";
$_SESSION['codigoCliente'] = "";
$_SESSION['acervoAcesso'] = "";
$_SESSION['leilaoAcesso'] = "";
$_SESSION['comitenteAcesso'] = "";
$_SESSION['compradorAcesso'] = "";
$_SESSION['configsAcesso'] = "";

unset($_SESSION['usuarioID']);
unset($_SESSION['usuarioNome']);
unset($_SESSION['ultimologin']);
unset($_SESSION['codigoCliente']);
unset($_SESSION['acervoAcesso']);
unset($_SESSION['leilaoAcesso']);
unset($_SESSION['comitenteAcesso']);
unset($_SESSION['compradorAcesso']);
unset($_SESSION['configsAcesso']);



header("Location: index.php");


?>