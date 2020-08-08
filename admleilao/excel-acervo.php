<?php 
ini_set( 'default_charset', 'UTF-8');
header("Content-Type: text/html; charset=utf-8",true);
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Gerou excel do acervo.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);


$arquivo = "acervo.xls";

header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=UTF-8;encoding=UTF-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="100%" border="1" cellpadding="5" cellspacing="0"  style="font-size:12px;">
  <tr>
        <td width="10%">ID Peça</td>
        <td width="55%">Descrição</td>
        <td width="20%">Valor inicial</td>
        <td width="10%">Estatus</td>
      </tr>
  <?
	  
	  $queryCs = "Select * from acervo where estatus = 'Em estoque' order by descricao asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linha['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=str_replace("<br />","-----",$linha['descricao'])?></td>
        <td style="color:#787878 !important;" >R$ <?=$linha['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="5" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum acervo encontrado...</em></td>
        </tr><? }?>
</table>
