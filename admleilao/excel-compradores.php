<?php 
ini_set( 'default_charset', 'UTF-8');
header("Content-Type: text/html; charset=utf-8",true);
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Gerou excel dos compradores.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);


$arquivo = "compradores.xls";

header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=UTF-8;encoding=UTF-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="100%" border="1" cellpadding="5" cellspacing="0"  style="font-size:12px;">
  <tr>
        <td >Comprador</td>
        <td >Telefone</td>
        <td >Celular</td>
        <td >E-mail</td>
        <td >CPF</td>
        <td >Endereço</td>
        <td >Numero</td>
        <td >Complemento</td>
        <td >Bairro</td>
        <td >Cidade</td>
        <td >Estado</td>
        <td >Cep</td>

  </tr>
  <?
	  $queryLotes = "Select * from compradores where codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaEc = mysql_fetch_array($resultadoLotes)) {
	  ?>
  <tr>
    <td align="center"><?=$linhaEc['nome']?></td>
    <td align="center"><?=$linhaEc['telefone']?></td>
    <td align="center"><?=$linhaEc['celular']?></td>
    <td align="center"><?=$linhaEc['email']?></td>
    <td align="center"><?=$linhaEc['cpf']?></td>
    <td align="center"><?=$linhaEc['endereco']?></td>
    <td align="center"><?=$linhaEc['numero']?></td>
    <td align="center"><?=$linhaEc['complemento']?></td>
    <td align="center"><?=$linhaEc['bairro']?></td>
    <td align="center"><?=$linhaEc['cidade']?></td>
    <td align="center"><?=$linhaEc['estado']?></td>
    <td align="center"><?=$linhaEc['cep']?></td>
  </tr>
  <? }}else{?>
  <tr>
    <td colspan="12" align="center"><em>Nenhum comprador ate o momento...</em></td>
  </tr><? }?>
</table>
