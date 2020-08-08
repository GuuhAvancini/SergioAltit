<?php 
ini_set( 'default_charset', 'UTF-8');
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Visualizou o relatório excel dos compradores.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

$arquivo = $linha['descricao'].".xls";

header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel; charset=UTF-8;encoding=UTF-8");
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header ("Content-Description: PHP Generated Data" );

?>
<table width="100%" border="1" cellpadding="5" cellspacing="0"  style="font-size:12px;">
  <tr>
        <td >Lote</td>
        <td >Id Peça</td>
        <td >Descrição</td>
        <td >Valor inicial</td>
        <td >Valor arremate</td>
        <td >Cartela</td>
        <td >Comprador</td>
        <td >Telefone</td>
        <td >Celular</td>
        <td >E-mail</td>
        <td >CPF</td>
        <td >Endereço</td>
        <td >Número</td>
        <td >Complemento</td>
        <td >Bairro</td>
        <td >Cidade</td>
        <td >Estado</td>
        <td >Cep</td>

  </tr>
  <?
	  $queryLotes = "Select DISTINCT idComprador, idArremate from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {

            $queryAr = "Select * from arremates where idArremate = '".$linhaLotes['idArremate']."'";
			$resultadoAr = mysql_query($queryAr);
            $linhaAr = mysql_fetch_array($resultadoAr);
			  
			  
			$queryEc = "Select * from compradores where idCadastro = '".$linhaAr['idComprador']."'";
			$resultadoEc = mysql_query($queryEc);
            $linhaEc = mysql_fetch_array($resultadoEc);
            
            $queryAc = "Select * from acervo where idPeca = '".$linhaAr['idPeca']."'";
			$resultadoAc = mysql_query($queryAc);
			$linhaAc = mysql_fetch_array($resultadoAc);
			
	  ?>
  <tr>
    <td align="center"><?=$linhaAr['lote']?></td>
    <td align="center"><?=$linhaAc['idAcervo']?></td>
    <td align="center"><?=$linhaAc['descricao']?></td>
    <td align="center">R$ <?=$linhaAc['valor']?></td>
    <td align="center">R$ <?=$linhaAr['valor']?></td>
    <td align="center"><?=$linhaAr['cartela']?></td>
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
    <td colspan="17" align="center"><em>Nenhum arremate até o momento...</em></td>
  </tr><? }?>
</table>
