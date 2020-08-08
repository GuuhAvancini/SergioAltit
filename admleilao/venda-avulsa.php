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
 
  function validaForm(){
	var obj = document.form1
	
	
	if(obj.idComprador.value == ""){
		alert("Campo id do comprador vazio, favor preencher.")
		obj.idComprador.focus()
		return
	}
	if(obj.valor.value == ""){
		alert("Campo valor de venda vazio, favor preencher.")
		obj.valor.focus()
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
      Acervo</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <input type="button" value="Editar Acervo" name="new_button" id="new_button" onclick="location.href='edita-acervo.php?idPeca=<?=$_GET['idPeca']?>'" style="float:right; margin-right:50px;" />
    <table width="100%" border="0">
  <tr>
    <td width="241" rowspan="2" valign="top"><img src="fotos/<? 
	if ($linhaEc['foto'] <> ""){
	echo $linhaEc['foto'];
	}else{
	echo "1400782209_photo.png";
	}?>" width="210" height="230" border="1"></td>
    <td width="537" height="140" valign="top">Id da peça: <?=$linhaEc['idAcervo']?><br /><br /><?=$linhaEc['descricao']?></td>
    <td width="588" rowspan="2" valign="top"><p>Comitente Vendedor: <a href="editar-comitente-vendedor.php?idpeca=<? echo $_GET['idpeca'];?>"><img src="images/1395668715_document-print.png" width="16" height="16"></a></p>
            <p>Nome: <strong>
              <?=$linhaVe['nome']?>
            </strong></p>
            <p>Telefone: <strong>
              <?=$linhaVe['telefone']?></strong></p>
            <p>Celular: <strong>
                <?=$linhaVe['celular']?>
              </strong></p>
            <p>CPF: <strong>
              <?=$linhaVe['cpf']?>
              </strong> </p>
            <p>E-mail: <strong>
                <?=$linhaVe['email']?>
            </strong></p></td>
  </tr>
  <tr>
    <td valign="top">Valor inicial: R$ <?=$linhaEc['valor']?><br /><br />
    Estatus da peça: <?=$linhaEc['estatus']?></td>
  </tr>
    </table>
     <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
      Venda Avulsa</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div style="margin-top:50px;">
      <table width="100%" border="0">
          <tr>
            <td width="22%" valign="top"><form id="form1" name="form1" method="post" action="cadastra-venda-avulsa.php?idPeca=<?=$_GET['idPeca']?>">
              <p>Id da comprador:
                <input type="text" name="idComprador" id="idComprador"  class="inputsTxt" style="width:150px;" value="<?=$_GET['idComprador']?>"/>
            </p>
            <p>Valor da Venda: R$ <input type="text" name="valor" id="valor"  class="inputsTxt" style="width:135px;" /><br />
            </p>
            <p><input type="button" value="cadastrar venda" name="envia_button" id="envia_button" onClick="javascript:validaForm()" style=" margin-left:5px; float:none !important;"></p>
            </form>
            </td>
            <td width="78%" valign="top"><form id="form2" name="form2" method="post" action="?idPeca=<?=$_GET['idPeca']?>&op=busca"><p>ou Buscar comprador:
            <input type="text" name="nomeBusca" id="nomeBusca"  class="inputsTxt" style="width:220px;"/><input type="submit" value="buscar" name="envia_button" id="envia_button"  style=" margin-left:5px; float:none !important;"></p></form>
            <? if($_GET['op'] == "busca"){?>
    <div id="tabelaBuscaCadastros">
    <table width="700" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:30px !important; margin-bottom:50px;">
      <tr>
        <td width="16%">ID Comprador</td>
        <td width="52%">Nome</td>
        <td width="21%">CPF</td>
        </tr>
      <?
	  $queryCs = "Select * from compradores where idCadastro like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or nome like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or email like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or cpf like '%".$_POST['nomeBusca']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='?idPeca=<?=$_GET['idPeca']?>&idComprador=<?=$linha['idComprador']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><?=$linha['idComprador']?></td>
        <td style="color:#787878 !important;" ><?=$linha['nome']?></td>
        <td style="color:#787878 !important;" ><?=$linha['cpf']?></td>
        </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="4" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum comprador encontrado...</em></td>
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
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center">
Cadastro alterado com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
