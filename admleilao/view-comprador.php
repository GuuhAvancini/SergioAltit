<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from compradores where idCadastro = '".$_GET['idCadastro']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}





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
function fechaMessage(){
	document.getElementById("message").style.display = "none";
}
$(function(){
 $("[name=valor]").maskMoney({symbol:'R$ ', 
showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
 })
</script>
</head>
<body onload="<?=$erro?>">
<div id="menu-princ">
	<?php include("menu.php");?>
</div>
<div id="barra-fixa">
    <div id="titulo-user">
    	<?php include("topo.php");?>
  </div>
</div>
<div id="conteudo" style="margin-bottom:50px;">
    <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
      Comprador</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important; width:90%;">
    <table width="100%" border="0">
  <tr>
    <td><h2><?=$linhaEc["nome"]?></h2></td>
    <td align="right"><input type="button" value="Editar Comprador" name="new_button" id="new_button" onclick="location.href='edita-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px;"><input type="button" value="Tornar-se Comitente" name="new_button" id="new_button" onclick="location.href='novo-comitente.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; right:240px;position:absolute;">
    <!--<input type="button" value="Retirada de Peça" name="new_button" id="new_button" onclick="location.href='retirada-peca-comprador.php?idCadastro=<? //echo $_GET['idCadastro'];?>'" style="float:right; margin-right:50px; position:absolute; margin-top:60px;">--><input type="button" value="Empréstimo de Peça" name="new_button" id="new_button" onclick="location.href='emprestimo-peca-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px; position:absolute; margin-top:60px;"><input type="button" value="Recibo Devolução" name="new_button" id="new_button" onclick="location.href='emprestimo-peca-comprador-devolucao.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px; position:absolute; margin-top:110px;"><input type="button" value="Venda Avulsa" name="new_button" id="new_button" onclick="location.href='venda-avulsa-selecao-pecas.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px; position:absolute; margin-top:160px;"></td>
  </tr>
</table>
    
    <table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="12%" valign="top"><img src="vendedores/<? 
	if ($linhaEc['foto'] == ""){
		echo "perfil.jpg";
	}else{
		echo $linhaEc['foto'];}?>" width="135" height="102" /></td>
        <td width="30%" valign="top"><h3>ID: <strong>
          <?=$linhaEc['idComprador']?>
          </strong></h3>
          <p>Telefone: <strong>
            <?=$linhaEc['telefone']?>
          </strong></p>
          <p>Celular: <strong>
            <?=$linhaEc['celular']?>
          </strong></p>
          <p>CPF/CNPJ/Passaporte: <strong>
            <?=$linhaEc['cpf']?>
          </strong></p></td>
        <td width="35%" valign="top"><p>Endere&ccedil;o:<br />
          <strong>
            <?=$linhaEc['endereco']?>
            ,
  <?=$linhaEc['numero']?>
  <?=$linhaEc['complemento']?>
            -
  <?=$linhaEc['bairro']?>
  <br />
  <?=$linhaEc['cidade']?>
            -
  <?=$linhaEc['estado']?>
            - Cep:
  <?=$linhaEc['cep']?>
        </strong></p>
        <p><br />
          E-mail: <strong>
        <?=$linhaEc['email']?>
        </strong></p></td>
        <td width="23%" valign="top">&nbsp;</td>
      </tr>
    </table>
    </div>
  	
    <div id="conteudo-cadastros-menu" style="margin-top:370px;">
    	<div id="busca-invoices-ativo">
        Peças</div>
       <div id="busca-cadastros"></div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:420px !important; ">
      <div id="tabelaBuscaCadastros">
    <table width="1000" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:10px !important; margin-bottom:50px !important;">
      <tr>
        <td width="78">Foto</td>
        <td width="95">ID Peça</td>
        <td width="396">Descrição</td>
        <td>&nbsp;</td>
        <td style="border-right:none !important;" width="35">&nbsp;</td>
      </tr>
      <?
	  $queryCs = "Select * from emprestimo where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."' and tipo = 'Empréstimo'";
	  $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linha['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			if($linhaLot['estatus'] == "Emprestada"){
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-acervo.php?idPeca=<?=$linhaLot['idPeca']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >Empréstimo:<br />Data: <?=$linha['dataEmprestimo']?><br />Motivo: <?=$linha['motivo']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-acervo.php?idPeca=<?=$linhaLot['idPeca']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
      </tr>
      <?
	  
	  }}}
			
	  $queryCs = "Select * from vendaAvulsa where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."'";
	  $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linha['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			if($linhaLot['estatus'] == "Vendida"){
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-acervo.php?idPeca=<?=$linhaLot['idPeca']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >Vendida - Venda Avulsa: 
        <? if($linha['idTemp'] <> ""){?>
        <a href="recibo-venda-avulsa-lote.php?idCadastro=<?=$_GET['idCadastro']?>&idTemp=<?=$linha['idTemp']?>" target="_blank"><img src="images/1495046831_document-print-preview.png" width="26" height="26" border="0" align="absmiddle" /></a>
        <? }else{?>
        <a href="recibo-venda-avulsa.php?id=<?=$linha['idPeca']?>&idComp=<?=$linha['idComprador']?>" target="_blank"><img src="images/1495046831_document-print-preview.png" width="26" height="26" border="0" align="absmiddle" /></a>
        <? }?>
        <br />Data: <?=$linha['data']?><br />
        Valor: R$ <?=$linha['valor']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-acervo.php?idPeca=<?=$linhaLot['idPeca']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
      </tr>
      <?
			}}}
	  
	  $queryCs = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."' order by idLeilaoN, lote";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			$queryLe = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$linha['idLeilaoN']."'";
			$resultadole = mysql_query($queryLe);
			$linhaLe = mysql_fetch_array($resultadole);
			
			$queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$linha['idLeilaoN']."' and numLote = '".$linha['lote']."' order by numLote asc";
			$resultadoLotes = mysql_query($queryLotes);
			$linhaLotes = mysql_fetch_array($resultadoLotes);
			  
			$queryLot = "Select * from acervo where idAcervo = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			if($linhaLot['estatus'] == "Vendida"){
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-acervo.php?idPeca=<?=$linhaLot['idPeca']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idPeca']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >Arrematada no Leilão:<br />
          <?=$linhaLe['idLeilaoN']?> - <?=$linhaLe['descricao']?> - <?=$linhaLe['dataLeilao']?> - <?=$linhaLe['horario']?> - Lote: <?=$linha['lote']?><br />
          Valor do arremate: R$          <?=$linha['valor']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-acervo.php?idPeca=<?=$linhaLot['idPeca']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
      </tr>
      <?
		  }
		  }
	  }?>
    </table>
    </div>
    </div>
    
</div>

<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idpeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "empok"){?>
<div id="message" align="center">
Empréstimo realizado com sucesso! <br />
<input type="button" value="Imprimir Recibo Empréstimo" name="close_button" id="close_button"  onclick="window.open('recibo-emprestimo.php?idCadastro=<?=$_GET['idCadastro']?>&idAcervo=<?=$_GET['idAcervo']?>')" style="width:200px !important;"><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "vendaok"){?>
<div id="message" align="center" style="height:150px !important;">
Venda avulsa realizada com sucesso! <br /><br />
<input type="button" value="Imprimir Recibo Venda" name="close_button" id="close_button"  onclick="window.open('recibo-venda-avulsa-lote.php?idCadastro=<?=$_GET['idCadastro']?>&idTemp=<?=$_GET['idTemp']?>')" style="width:200px !important;"><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
