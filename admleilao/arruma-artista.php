<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from artistas order by nome asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {

$query = mysql_query("UPDATE `artistas` SET `biografia` = '".str_replace("\n",'<br />', addslashes(htmlspecialchars($linha['biografia'])))."' WHERE `idArtista` = '".$linha['idArtista']."' ") or die(mysql_error());

		  }}

?>ok...

