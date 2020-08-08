e<?php include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}





$query = mysql_query("INSERT INTO categorias (categoria) VALUES ('".$_POST['categoria']."')") or die(mysql_error());


$linhalog = "- ".date('d/m/Y - H:m:s')." - Usu�rio: ".$_SESSION['usuarioNome']." - Cadastrou a categoria: ".$_POST['categoria'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

header("Location: categorias.php?op=cadok");

?>

