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
 
 function validaForm(){
	var obj = document.form1
	
	
	if(obj.idPeca.value == ""){
		alert("Campo id da peça vazio, favor preencher.")
		obj.idPeca.focus()
		return
	}
	if(obj.motivo.value == ""){
		alert("Campo motivo do empréstimo vazio, favor preencher.")
		obj.motivo.focus()
		return
	}
	
	
	
	obj.submit()
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
      Comprador</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important; width:90%;">
    <table width="100%" border="0">
  <tr>
    <td><h2><?=$linhaEc["nome"]?></h2></td>
    <td align="right"><input type="button" value="Editar Comprador" name="new_button" id="new_button" onclick="location.href='edita-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px;">
    <input type="button" value="Retirada de Peça" name="new_button" id="new_button" onclick="location.href='retirada-peca-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px; position:absolute; margin-top:60px;"><input type="button" value="Empréstimo de Peça" name="new_button" id="new_button" onclick="location.href='emprestimo-peca-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-right:50px; position:absolute; margin-top:120px;"></td>
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
        Empréstimo</div>
       <div id="busca-cadastros"></div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:420px !important; ">
      <div id="tabelaBuscaCadastros">
        <table width="100%" border="0">
          <tr>
            <td width="34%" valign="top"><form id="form1" name="form1" method="post" action="cadastra-emprestimo.php?idCadastro=<?=$_GET['idCadastro']?>">
              <p>Id da peça:
              <input type="text" name="idPeca" id="idPeca"  class="inputsTxt" style="width:150px;" value="<?=$_GET['idPeca']?>"/>
            </p>
            <p>Motivo do empréstimo: <br />
              <textarea name="motivo" class="inputsTxt" id="motivo" style="width:230px; height:100px !important;"></textarea>
            </p>
            <p><input type="button" value="cadastrar" name="envia_button" id="envia_button" onClick="javascript:validaForm()" style=" margin-left:5px; float:none !important;"></p>
            </form>
            </td>
            <td width="66%" valign="top"><form id="form2" name="form2" method="post" action="?idCadastro=<?=$_GET['idCadastro']?>&op=busca"><p>ou Buscar peça:
            <input type="text" name="nomeBusca" id="nomeBusca"  class="inputsTxt" style="width:220px;"/><input type="submit" value="buscar" name="envia_button" id="envia_button"  style=" margin-left:5px; float:none !important;"></p></form>
            <? if($_GET['op'] == "busca"){?>
    <div id="tabelaBuscaCadastros">
    <table width="700" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:30px !important; margin-bottom:50px;">
      <tr>
        <td width="5%">Foto</td>
        <td width="10%">ID Peça</td>
        <td width="55%">Descrição</td>
        <td width="20%">Valor inicial</td>
        <td width="10%">Estatus</td>
        </tr>
      <?
	  $queryCs = "Select * from acervo where idPeca like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' or descricao like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' or idCadastro like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' order by descricao asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='?idPeca=<?=$linha['idAcervo']?>&idCadastro=<?=$_GET['idCadastro']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linha['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linha['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linha['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linha['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linha['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
        </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="6" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum acervo encontrado...</em></td>
        </tr>
    </table>
    <? }?>
    </div>
    <? }?>
            </td>
          </tr>
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
<? if($_GET['op'] == "emperrok"){?>
<div id="message" align="center">
Id da peça não encontrado! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();" style="background-color:#F00 !important;">
</div>
<? }?>
</body>
</html>
