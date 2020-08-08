<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from comitentes where idCadastro = '".$_GET['idCadastro']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}


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

window.opener.location.href = "view-comitente.php?idCadastro=<?=$_GET['idCadastro']?>";
</script>
</head>
<body onload="<?=$erro?>">
<table width="100%" border="0">
  <tr>
    <td width="12%"><? if($_POST['tipoConsig'] == "ag"){?><img src="images/logoTransp.png" width="148" height="86" /><? }else{?><img src="images/logoSergio.jpg" width="79" height="100" />      <? }?></td>
    <td width="88%"><div id="tituloRelatorio" align="center">AUTORIZAÇÃO PARA VENDA EM LEILÃO</div></td>
  </tr>
</table>
<p align="justify" style="font-size:14px;"><strong>
  <?=$linhaEc['nome']?>
  </strong>residente a <strong>
  <?=$linhaEc['endereco']?>
    ,
  <?=$linhaEc['numero']?>
  <?=$linhaEc['complemento']?>
    -
  <?=$linhaEc['bairro']?>
    -
  <?=$linhaEc['cidade']?>
    -
  <?=$linhaEc['estado']?>
    - Cep:
  <?=$linhaEc['cep']?>
  </strong>portador do CPF/CNPJ/Passaporte <strong>
  <?=$linhaEc['cpf']?>
  </strong> - Telefone <strong>
  <?=$linhaEc['telefone']?>
  </strong> - Celular: <strong>
  <?=$linhaEc['celular']?>
  </strong></p>
<p>Pela presente, o acima qualificado, doravante denominado COMITENTE, autoriza <? if($_POST['tipoConsig'] == "ag"){?> a VIEJOLI ANTIQUES LTDA, CNPJ: 05.395.547/0001-57<? }else{?>o Leiloeiro oficial Sérgio Altit, credenciado JUCESP sobre a matrícula 440<? }?>, situado à Rua Amélia Correia Fontes Guimarães, <? if($_POST['tipoConsig'] == "ag"){?>53<? }else{?>49<? }?>, Vila Progredior – Morumbi CEP 05617-010, São Paulo, SP, a vender os bens de sua propriedade, abaixo relacionado (s), nos termos e condições a seguir:</p>
<ol>
  <li>A(s) obra(s) de arte, objetos da presente autorização se encontram livres e desembaraçadas de quaisquer ônus, responsabilizando-se o Comitente/Proprietário por si e seus sucessores, perante a Galeria e Terceiros, pela autenticidade e procedência das mesmas;</li>
  <li>As partes estabelecem para venda das obras o preço mínimo fixado após a descrição das mesmas;</li>
  <li>O Comitente/ Proprietário autoriza desde de já o Leiloeiro a deduzir a título de reembolso de despesas o percentual de (<?=$_POST['percentual']?>) sobre o valor das obras vendidas<? if($_POST['outros'] <> ""){ echo ", ".$_POST['outros'];}?>.</li>
  <li>A liquidação da(s) obra(s) será feita após pagamento dos compradores, no prazo de <?=$_POST['prazo']?> após a venda. Sendo total responsabilidade do <? if($_POST['tipoConsig'] == "ag"){?>da VIEJOLI ANTIQUES LTDA<? }else{?>do Leiloeiro Sergio Altit <? }?>;</li>
  <li>Fica o <? if($_POST['tipoConsig'] == "ag"){?>a VIEJOLI ANTIQUES LTDA autorizada<? }else{?>o Leiloeiro Sergio Altit autorizado<? }?> a divulgar o nome do proprietário das obras quando achar necessário, inclusive reproduzir as mesmas em catálogo, jornais ou qualquer outra mídia;</li>
  <li>Esta autorização é dada em caráter irrevogável e irretratável, pelo prazo de <?=$_POST['vigencia']?> dias;</li>
  <li>Fica desde logo eleito o Foro de São Paulo, para dirimir eventuais divergências da presente;</li>
  <li>Fica autorizado ao Leiloeiro a circulação da(s) obra(s) pela capital durante o período vigente desta autorização.</li>
  <? if($_POST['linha9'] <> ""){?>
  <li><?=$_POST['linha9']?></li>
  <? }?>
</ol>
<table width="100%" border="1" cellpadding="3" cellspacing="0" style="font-size:12px;">
    <tr>
      <td align="center">Id da Peça</td>
      <td align="center">Descrição</td>
      <td align="center">Valor Inicial</td>
      <td align="center">Tipo Comissão</td>
    </tr>
    <?
	  $queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' and idCadastro = '".$_GET['idCadastro']."' and estatus = 'Em estoque' order by idPeca asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			  if ($_POST['sel_'.$linha['idPeca']] == "sim"){
				  
				  
	  ?>
    <tr>
      <td width="9%" align="center"><?=$linha['idAcervo']?></td>
      <td width="56%"><?=$linha['descricao']?></td>
      <td width="19%" align="center">R$ <?=$linha['valor']?></td>
      <td width="16%" align="center">
      <?
	  if($linha['tipoComissao'] == "normal"){
	  ?>Comissão: <?=$linha['comissao']?>%
      <? }
	  if($linha['tipoComissao'] == "overprice"){
	  ?>Comissão acima de R$ <?=$linha['overprice']?>
      <? }?>
      </td>
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
  Consignante &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consignat&aacute;rio </p>
</body>
</html>
