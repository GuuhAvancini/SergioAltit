<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


	  $queryCs = "Select * from compradores where nome like '%".$_GET['nome']."%' order by nome asc";
      $resultadoCs = mysql_query($queryCs);
	  $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  echo $rs['nome']."\n";
		  }
	  }
	  