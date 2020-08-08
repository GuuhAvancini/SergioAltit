<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from acervo";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {

$query = mysql_query("UPDATE `acervo` SET `descricao` = '".str_replace("\n",'<br />', addslashes(htmlspecialchars($linha['descricao'])))."' WHERE `idPeca` = '".$linha['idPeca']."' ") or die(mysql_error());

		  }}

?>ok...

