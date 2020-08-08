<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança


$queryCsi = "Select * from import";
$resultadoCsi = mysql_query($queryCsi);
	if (mysql_num_rows($resultadoCsi)!=0) {
		  while ($linhai = mysql_fetch_array($resultadoCsi)) {

				$queryCs = "Select * from acervo where codigoCliente = '1' order by idAcervo desc";
				$resultadoCs = mysql_query($queryCs);
					  if (mysql_num_rows($resultadoCs)!=0) {
						  $linha = mysql_fetch_array($resultadoCs);
						  $id = $linha['idAcervo']+1;
					  }else{
						  $id = 1;
					  }
					  
				
				
				$query = mysql_query("INSERT INTO acervo (codigoCliente, idAcervo, idCadastro, datacadastro, descricao, foto, valor, valorInicial, estatus, tipoComissao, comissao, overprice, localizacaoPeca, iphan, nomeComitente) VALUES ('1', '".$id."', '2', '".date('d/m/Y - H:m:s')."', '".addslashes($linhai['descricao'])."', '', '', '', 'Em estoque', '', '', '', '', '', '".utf8_encode("AG Escritório de Arte")."')") or die(mysql_error());
				
		  }
	}




?>ok - planilha importada...

