<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from comitentes where idCadastro = '".$_GET['idCadastro']."'";
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
 $(function(){
 $("[name=overprice]").maskMoney({symbol:'R$ ', 
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
      Comitente</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <table width="100%" border="0">
  <tr>
    <td><h2><?=$linhaEc["nome"]?></h2></td>
    <td align="right"><input type="button" value="Editar Comitente" name="new_button" id="new_button" onclick="location.href='edita-comitente.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px;"><input type="button" value="Tornar-se Comprador" name="new_button" id="new_button" onclick="location.href='novo-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:20px;"></td>
  </tr>
</table>
    
    <table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="19%" valign="top"><img src="vendedores/<? 
	if ($linhaEc['foto'] == ""){
		echo "perfil.jpg";
	}else{
		echo $linhaEc['foto'];}?>" width="135" height="102" /></td>
        <td width="31%" valign="top"><h3>ID: <strong>
          <?=$linhaEc['idComitente']?>
        </strong></h3>
          <p>Telefone: <strong>
            <?=$linhaEc['telefone']?>
          </strong></p>
          <p>Celular: <strong>
            <?=$linhaEc['celular']?>
          </strong></p>
          <p>CPF/CNPJ/Passaporte: <strong>
            <?=$linhaEc['cpf']?>
          </strong></p>
          <p>E-mail: <strong>
            <?=$linhaEc['email']?>
          </strong></p>
          <p>Endere&ccedil;o:<br />
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
            </strong></p></td>
        <td width="18%" valign="top"><p>Dados Banc&aacute;rios:</p>
          <p>Banco: <strong>
            <?=$linhaEc['banco']?>
          </strong></p>
          <p>Ag&ecirc;ncia: <strong>
            <?=$linhaEc['agencia']?>
          </strong></p>
          <p>Conta: <strong>
            <?=$linhaEc['conta']?>
            </strong>- Tipo: <strong>
              <?=$linhaEc['tipoConta']?>
            </strong></p>
          <p>Favorecido: <strong>
            <?=$linhaEc['favorecido']?>
          </strong></p>
          <p>CPF Favorecido: <strong>
            <?=$linhaEc['cpfFavorecido']?>
            <br />
          </strong></p>
          <p>&nbsp;</p></td>
        <td width="32%" valign="top"><input type="button" value="Gerar Consignação" name="new_button" id="new_button" onclick="location.href='gera-consignacao.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:45px;"><br /><br /><input type="button" value="Cadastrar Peças Leilão" name="new_button" id="new_button" onclick="location.href='envia-leilao.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:45px;"><br /><br /><input type="button" value="Retirada Peça" name="new_button" id="new_button" onclick="location.href='retirada-peca-comitente.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:45px;">
        </td>
      </tr>
    </table>
    </div>
  	<div id="conteudo-cadastros-menu" style="margin-top:450px;">
    	<div id="busca-invoices-ativo">
        Nova peça</div>
       <div id="busca-cadastros"></div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:500px !important; width:1000px;">
      <form id="form1" name="form1" method="post" action="cadastra-peca.php?idCadastro=<?=$_GET['idCadastro']?>" enctype="multipart/form-data" ><table width="100%" border="0">
  <tr>
    <td width="362" valign="top">Descrição da peça:<br /><textarea name="descricao" cols="" rows="" id="input_text" style="width:350px; height:130px;"></textarea></td>
    <td width="265" valign="top">Valor inicial do lance:</span><br>R$ <input name="valor" type="text" id="input_text" style="width:150px; padding:10px; " /><br />
      <br />
      Foto principal da Pe&ccedil;a:<br />
      <input type="file" name="fotoUpload" id="fotoUpload" /></td>
    <td width="359" valign="top"><p>Comissão sobre peça:</p>
      <p>
        <input name="tipoComissao" type="radio" id="radio" style="width:30px;" value="normal" checked="checked" />
        Comissão: 
        <input name="comissao" type="text" id="input_text" style="width:100px; padding:10px; " size="2" /> 
        %
      </p>
      <p>
        <input name="tipoComissao" type="radio" id="radio2" style="width:30px;" value="overprice" />
        Overprice: R$
        <input name="overprice" type="text" id="input_text" style="width:100px; padding:10px; " />
      </p></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Localização da peça:
      <input name="localizacaoPeca" type="text" id="input_text" style="width:210px; padding:10px; " />
      Iphan:
      <input name="iphan" type="radio" id="radio3" style="width:30px;" value="sim" checked="checked" />
Sim
<input name="iphan" type="radio" id="radio4" style="width:30px;" value="nao" />
Não</td>
    <td valign="bottom">Website:
      <input name="website" type="radio" id="radio5" style="width:30px;" value="sim" checked="checked" />
Sim
<input name="website" type="radio" id="radio6" style="width:30px;" value="nao" />
Não</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Observações importantes da peça:<br />
      <textarea name="obsImp" cols="" rows="" id="input_text" style="width:350px; height:80px;"></textarea></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Artista: 
      <select name="artista" id="input_text" style="width:300px; padding:10px; ">
      <option value=""><?=$linha['nome']?>Nenhum...</option>
     <?
	  
	  $queryCs = "Select * from artistas order by nome asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
       <option value="<?=$linha['idArtista']?>"><?=$linha['nome']?></option>
       <? }}?>
      </select></td>
    <td valign="top">&nbsp;</td>
  </tr>
      </table>
      <input type="submit" value="Cadastrar Peça" name="new_button" id="new_button" style="margin-left:-1px;">
      </form>
    </div>
    <div id="conteudo-cadastros-menu" style="margin-top:970px;">
    	<div id="busca-invoices-ativo">
        Peças cadastradas</div>
       <div id="busca-cadastros"></div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:1050px !important; ">
      <div id="tabelaBuscaCadastros">
    <table width="1000" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:10px !important; margin-bottom:50px !important;">
      <tr>
        <td width="10%">Foto</td>
        <td width="15%">ID Peça</td>
        <td width="50%">Descrição</td>
        <td width="15%">Valor inicial</td>
        <td width="10%">Estatus</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	  $queryCs = "Select * from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' and idCadastro = '".$_GET['idCadastro']."' order by idPeca asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-acervo.php?idPeca=<?=$linha['idPeca']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linha['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linha['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linha['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linha['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linha['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-acervo.php?idPeca=<?=$linha['idPeca']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="6" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum peça encontrada...</em></td>
        </tr>
    </table>
    <? }?>
    
    </div>
    </div>
    
</div>

<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idpeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
