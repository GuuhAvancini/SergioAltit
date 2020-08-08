<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
//if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from compradores where idCadastro = '".$_GET['idCadastro']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

//if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}


$queryEMP = "Select * from clientesHadnet where codigoCliente = '".$_SESSION['codigoCliente']."'";
$resultadoEMP = mysql_query($queryEMP);
$linhaEMP = mysql_fetch_array($resultadoEMP);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema > <?=$_SESSION['clienteNome']?></title> 
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<style type="text/css">
.titulosDados {font-size: 14px;}
</style>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
<script>

window.opener.location.href = "view-comprador.php?idCadastro=<?=$_GET['idCadastro']?>";
</script>
</head>
<body onload="<?=$erro?>">
<table width="100%" border="0">
  <tr>
    <td width="12%"><img src="images/logoSergio.jpg" width="79" height="100" /></td>
    <td width="88%"><div id="tituloRelatorio" align="center">DEVOLUÇÃO DE PEÇA - EMPRÉSTIMO</div></td>
  </tr>
</table>
<p style="font-size:16px" >Leiloeiro Sérgio Altit, credenciado na  JUCESP  sobra a matricula 440, com escrit&oacute;rio &agrave; Rua Amélia Correia Fontes Guimarães, 49, Vila Progredior, CEP 05617-010, São Paulo, SP, declaro ter recebido a devolução do empréstimo o(s) iten(s) abaixo relacionados, devidamente conferidos, de<span style="text-align: left"></span>
  <?=$linhaEc['nome']?> 
residente <?=$linhaEc['endereco']?> <?=$linhaEc['numero']?> <?=$linhaEc['complemento']?>, <?=$linhaEc['bairro']?>, <?=$linhaEc['cidade']?>, <?=$linhaEc['estado']?>, Cep: <?=$linhaEc['cep']?>
 portador do CPF 
 <?=$linhaEc['cpf']?> - Telefone <?=$linhaEc['telefone']?> - Celular: <?=$linhaEc['celular']?>
.<span style="text-align: left"></span></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" style="font-size:12px;">
    <tr>
      <td align="center">Id da Peça</td>
      <td align="center">Descrição</td>
    </tr>
    <?
	  $queryCs = "Select * from emprestimo where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."' order by idPeca asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			  
			  $queryAc = "Select * from acervo where idPeca = '".$linha['idPeca']."'";
      			$resultadoAc = mysql_query($queryAc);
	 			$linhaAc = mysql_fetch_array($resultadoAc);
			  
			  if ($_POST['sel_'.$linhaAc['idPeca']] == "sim"){
				  
				  
				  $query = mysql_query("UPDATE `acervo` SET `estatus` = 'Em estoque' WHERE `idPeca` = '".$linha['idPeca']."' ") or die(mysql_error());
				  $descricao = "Devolução do Empréstimo - Comprador: ".$linhaEc['nome']." - Id Peça: ".$linhaAc['idAcervo'];
				  $query = mysql_query("INSERT INTO historicoAcervo (codigoCliente, idPeca, data, date, descricao) VALUES ('".$_SESSION['codigoCliente']."', '".$linhaAc['idAcervo']."', '".date('d/m/Y - H:m:s')."', '".date('Y/m/d')."', '".$descricao."')") or die(mysql_error());
				  
				  
	  ?>
    <tr>
      <td width="13%" align="center"><?=$linhaAc['idAcervo']?></td>
      <td width="87%"><?=$linhaAc['descricao']?></td>
    </tr>
    <? }
	}}?>
</table>
<p>S&atilde;o Paulo,
  <?=date('d')?>
  de
  <?
$mes = date('m');
switch ($mes){
 
case 1: $mes = "janeiro"; break;
case 2: $mes = "fevereiro"; break;
case 3: $mes = "mar&ccedil;o"; break;
case 4: $mes = "abril"; break;
case 5: $mes = "maio"; break;
case 6: $mes = "junho"; break;
case 7: $mes = "julho"; break;
case 8: $mes = "agosto"; break;
case 9: $mes = "setembro"; break;
case 10: $mes = "outubro"; break;
case 11: $mes = "novembro"; break;
case 12: $mes = "dezembro"; break;
 
}
print($mes);
	  ?>
  de
  <?=date('Y')?>
</p>
<p>&nbsp;</p>
<p>________________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________<br />
  <span style="font-size:16px">Leiloeiro Sérgio Altit</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:16px">
  <?=$linhaEc['nome']?>
  </span> </p>
</body>
</html>
