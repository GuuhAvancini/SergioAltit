<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$_SESSION['clienteNome']?></title>
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<style type="text/css">
body,td,th {
	font-family: "Titillium Web", sans-serif;
	font-size: 18px;
}
.break { page-break-before: always;}

</style>
</head>

<body>
      <?
	  $contaFichas = 0;
	  $queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			$contaFichas = $contaFichas+1;
			
	  ?>
      
      <table width="700" cellpadding="0" cellspacing="0" border="1" style="margin-right:10px; margin-bottom:10px;">
        <tr>
          <td><table width="100%" border="0">
        <tr>
          <td width="57%" height="65" valign="top">LOTE:
          <br />            <?=$linhaLotes['numLote']?><?=$linhaLotes['loteExt']?></td>
          <td width="43%" valign="top">Cartela<br />
            _____________________</td>
        </tr>
        <tr>
          <td height="91" colspan="2" valign="top" style="font-size:15px;">
          <?=str_replace("<br />"," - ",$linhaLot['descricao'])?></td>
          </tr>
        <tr>
          <td valign="top">Lance Inicial<br />
          R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?></td>
          <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" style="border:solid 1px color:#000;">
            <tr>
              <td height="60" valign="top" align="center">Lance Final</td>
            </tr>
          </table></td>
        </tr>
          </table>
          </td>
        </tr>
      </table>
      <? 
	  if($contaFichas == 4){
		  $contaFichas = 0;
		  ?><hr />
      <p class="break"></p>
      <? }?>
      
<? }}?></div>
</body>
</html>
