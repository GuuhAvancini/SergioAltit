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
 function checkAll(o){
	var boxes = document.getElementsByTagName("input");
	for (var x=0;x<boxes.length;x++){			
		var obj = boxes[x];
		if (obj.type == "checkbox"){
			if (obj.name!="chkAll") obj.checked = o.checked;
		}
	}
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
    <td align="right">&nbsp;</td>
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
      <form id="form1" name="form1" method="post" action="retirada-peca-comprador-ok.php?idCadastro=<?=$_GET['idCadastro']?>" target="_blank">
<table width="1000" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:10px !important; margin-bottom:50px !important;">
  <tr>
        <td width="70">Foto</td>
        <td width="75">ID Peça</td>
        <td width="396">Descrição</td>
        <td>&nbsp;</td>
        <td style="border-right:none !important;" width="65"><input type="checkbox" name="chkAll" onClick="checkAll(this)" style="width:40px;" /> </td>
      </tr>
      <?
	  
	  $queryCs = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."' and retirada = '0' order by idLeilaoN, lote";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			$queryLe = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$linha['idLeilaoN']."'";
			$resultadole = mysql_query($queryLe);
			$linhaLe = mysql_fetch_array($resultadole);
			
			$queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$linha['idLeilaoN']."' and numLote = '".$linha['lote']."' order by numLote asc";
			$resultadoLotes = mysql_query($queryLotes);
			$linhaLotes = mysql_fetch_array($resultadoLotes);
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
	  ?>
      <tr bgcolor="#fffdea">
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
        <td style="border-right:none !important; color:#787878 !important;" ><input name="sel_<? echo $linhaLot['idPeca'];?>" type="checkbox" id="sel_<? echo $linhaLot['idPeca'];?>" value="sim" style="width:40px;"></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="5" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum peça arrematada...</em></td>
        </tr>
    <? }?>
    <tr bgcolor="#fffdea"  >
        <td colspan="5" style="border-bottom:none !important; border-right:none !important;" align="right"><input type="submit" value="Retirada de Peça" name="new_button" id="new_button"  style="float:right;" onClick="location.href='view-comprador.php?idCadastro=<?=$_GET['idCadastro']?>'" /></td>
      </tr>
  </table>
  </form>
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
Empréstimo realizado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>

</body>
</html>
