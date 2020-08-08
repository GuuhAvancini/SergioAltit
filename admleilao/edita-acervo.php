<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}

$queryVe = "Select * from comitentes where idCadastro = '".$linhaEc['idCadastro']."'";
$resultadoVe = mysql_query($queryVe);
$linhaVe = mysql_fetch_array($resultadoVe);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema > <?=$_SESSION['clienteNome']?></title> 
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<style type="text/css">
.titulosDados {font-size: 14px;}

.inputsTxt{
	padding: 10px 0 10px 15px;
    font-size: 13px;
    font-family: Montserrat, sans-serif;
	border:1px #CCCCCC solid;
    height: 36px;
    color: #999;
    outline: none;
    background: #FFF;
    box-sizing: border-box;
    transition: all 0.15s;
	border-radius:0px;
	margin-top:10px;	
}
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    var availableTags = [
      <? 
	  $queryComprs = "Select * from comitentes where nome like '%".$_GET['nome']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
      $resultadoComprs = mysql_query($queryComprs);
	  if (mysql_num_rows($resultadoComprs)!=0) {
		  while ($linhaoComprs = mysql_fetch_array($resultadoComprs)) {?>
			  "<?=$linhaoComprs['nome'];?>",
	  <? }}?>
    ];
    $( "#txtCliente" ).autocomplete({
      source: availableTags
    });
	
	
	
	
	
  } );
  
  
  
  function showElement() {
        document.getElementById("hiddenEl").style.display = "block";
    }
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
      Editar Peça</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
  <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important; width:1000px;">
      <form id="form1" name="form1" method="post" action="altera-acervo.php?idPeca=<?=$_GET['idPeca']?>&pagina=<?=$_GET['pagina']?>&id=<?=$_GET['id']?>" ><table width="100%" border="0">
  <tr>
    <td colspan="3" valign="top">Comitente: <?=$linhaVe['nome']?></td>
    </tr>
  <tr>
    <td width="362" valign="top">Descrição da peça:<br /><textarea name="descricao" cols="" rows="" id="input_text" style="width:350px; height:130px;"><?=str_replace("<br />",'', $linhaEc['descricao'])?></textarea></td>
    <td width="265" valign="top">Valor inicial do lance:</span><br>R$ <input name="valor" type="text" id="input_text" style="width:150px; padding:10px; " value="<?=$linhaEc['valor']?>" />
      <br /><br /><span style="font-size:9px">Valor de cadastro da peça: R$ <?=$linhaEc['valorInicial']?></span>
      <br />
      <br /></td>
    <td width="359" valign="top"><p>Comissão sobre peça:</p>
      <p>
        <input name="tipoComissao" type="radio" id="radio" style="width:30px;" value="normal" <? if($linhaEc['tipoComissao'] == "normal"){?>checked="checked"<? }?> />
        Comissão: 
        <input name="comissao" type="text" id="input_text" style="width:100px; padding:10px; " size="2" value="<?=$linhaEc['comissao']?>" /> 
        %
      </p>
      <p>
        <input name="tipoComissao" type="radio" id="radio2" style="width:30px;" value="overprice" <? if($linhaEc['tipoComissao'] == "overprice"){?>checked="checked"<? }?> />
        Overprice: R$
        <input name="overprice" type="text" id="input_text" style="width:100px; padding:10px; " value="<?=$linhaEc['overprice']?>" />
      </p></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Localização da peça:
      <input name="localizacaoPeca" type="text" id="input_text" style="width:210px; padding:10px; " value="<?=$linhaEc['localizacaoPeca']?>" /> 
      Iphan: 
      <input name="iphan" type="radio" id="radio3" style="width:30px;" value="sim" <? if($linhaEc['iphan'] == "sim"){?>checked="checked"<? }?> />
      Sim 
      <input name="iphan" type="radio" id="radio4" style="width:30px;" value="nao" <? if($linhaEc['iphan'] == "nao"){?>checked="checked"<? }?>/>
      Não</td>
    <td valign="bottom">Website:
      <input name="website" type="radio" id="radio5" style="width:30px;" value="sim" <? if($linhaEc['website'] == "sim"){?>checked="checked"<? }?> />
Sim
<input name="website" type="radio" id="radio6" style="width:30px;" value="nao" <? if($linhaEc['website'] == "nao"){?>checked="checked"<? }?> />
Não</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Observações importantes da peça:<br />
      <textarea name="obsImp" cols="" rows="" id="input_text" style="width:350px; height:80px;"><?=$linhaEc['obsImp']?></textarea></td>
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
       <option value="<?=$linha['idArtista']?>" <? if($linhaEc['artista'] == $linha['idArtista']){?>selected="selected"<? }?>><?=$linha['nome']?></option>
       <? }}?>
      </select>
      </td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Categoria: 
     <select name="categoria" id="input_text" style="width:280px; padding:10px; ">
     <option value="">Selecione...</option>
     <?
	  
	  $queryCs = "Select * from categorias order by categoria asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
       <option value="<?=$linha['idCategoria']?>" <? if($linhaEc['categoria'] == $linha['idCategoria']){?>selected="selected"<? }?> ><?=$linha['categoria']?></option>
       <? }}?>
      </select></td>
    <td valign="top">&nbsp;</td>
  </tr>
      </table>
      <input type="submit" value="Alterar Peça" name="new_button" id="new_button" style="margin-left:-1px;">
      </form>
      <p>&nbsp;</p><p>&nbsp;</p>
      <p>Alterar 1a foto:</p>
      <form id="form2" name="form2" method="post"  action="altera-acervo-foto.php?idPeca=<?=$_GET['idPeca']?>&pagina=<?=$_GET['pagina']?>&id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <table width="100%" border="0">
          <tr>
            <td width="22%"><img src="fotos/<? 
	if ($linhaEc['foto'] <> ""){
	echo $linhaEc['foto'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="210" height="230" border="1" /></td>
            <td width="78%" valign="top"><p>Altera foto principal da Pe&ccedil;a:<br />
              <input type="file" name="fotoUpload" id="fotoUpload" />
            </p>
            <p>
              <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style="margin-left:-1px;" />
            </p></td>
          </tr>
        </table>
      </form>
  <p>&nbsp;</p>
      <p>Alterar 2a foto:</p>
      <form id="form2" name="form2" method="post"  action="altera-acervo-foto1.php?idPeca=<?=$_GET['idPeca']?>&pagina=<?=$_GET['pagina']?>&id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <table width="100%" border="0">
          <tr>
            <td width="22%"><img src="fotos/<? 
	if ($linhaEc['foto1'] <> ""){
	echo $linhaEc['foto1'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="210" height="230" border="1" /></td>
            <td width="78%" valign="top"><p>Altera foto principal da Pe&ccedil;a:<br />
              <input type="file" name="fotoUpload" id="fotoUpload" />
            </p>
            <p>
              <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style="margin-left:-1px;" />
            </p></td>
          </tr>
        </table>
      </form>
  <p>&nbsp;</p>
      <p>Alterar 3a foto:</p>
      <form id="form2" name="form2" method="post"  action="altera-acervo-foto2.php?idPeca=<?=$_GET['idPeca']?>&pagina=<?=$_GET['pagina']?>&id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <table width="100%" border="0">
          <tr>
            <td width="22%"><img src="fotos/<? 
	if ($linhaEc['foto2'] <> ""){
	echo $linhaEc['foto2'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="210" height="230" border="1" /></td>
            <td width="78%" valign="top"><p>Altera foto principal da Pe&ccedil;a:<br />
              <input type="file" name="fotoUpload" id="fotoUpload" />
            </p>
            <p>
              <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style="margin-left:-1px;" />
            </p></td>
          </tr>
        </table>
      </form>
  <p>&nbsp;</p>
      <p>Alterar 4a foto:</p>
      <form id="form2" name="form2" method="post"  action="altera-acervo-foto3.php?idPeca=<?=$_GET['idPeca']?>&pagina=<?=$_GET['pagina']?>&id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <table width="100%" border="0">
          <tr>
            <td width="22%"><img src="fotos/<? 
	if ($linhaEc['foto3'] <> ""){
	echo $linhaEc['foto3'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="210" height="230" border="1" /></td>
            <td width="78%" valign="top"><p>Altera foto principal da Pe&ccedil;a:<br />
              <input type="file" name="fotoUpload" id="fotoUpload" />
            </p>
            <p>
              <input type="submit" value="Alterar Foto" name="new_button" id="new_button" style="margin-left:-1px;" />
            </p></td>
          </tr>
        </table>
      </form>
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
