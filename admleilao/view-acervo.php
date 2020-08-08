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
	
	
	if(obj.descricao.value == ""){
		alert("Campo de descrição vazio, favor preencher.")
		obj.descricao.focus()
		return
	}
	if(obj.fotoUpload.value == ""){
		alert("Selecione o arquivo a ser cadastrado.")
		obj.fotoUpload.focus()
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
  $EndImagem = "fotos/".$linha['foto']; 
  $TamanhoImagem = getimagesize($EndImagem);
  if($TamanhoImagem[0] > $TamanhoImagem[1]){
    $imgTam = "width=230";
  }else{
    $imgTam = "height=230";
  }
	}else{
  echo "1400782209_photo.png";
  $imgTam = "width=230 height=230";
	}?>" <?=$imgTam?> border="1"></td>
    <td width="537" height="140" valign="top">Id da peça: <?=$linhaEc['idAcervo']?><br /><br /><?=$linhaEc['descricao']?></td>
    <td width="588" rowspan="2" valign="top"><p>Comitente Vendedor: <a href="editar-comitente-vendedor.php?idPeca=<? echo $_GET['idPeca'];?>"><img src="images/1395668715_document-print.png" width="16" height="16"></a></p>
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
    <td valign="top"><p>Localização: 
      <?=$linhaEc['localizacaoPeca']?>
    </p>
      <p>Valor inicial: R$

        <?=$linhaEc['valor']?>
         <span style="font-size:9px">- Valor de cadastro da peça: R$ <?=$linhaEc['valorInicial']?></span><br /><br />
        Estatus da peça:     <?=$linhaEc['estatus']?></p>
      <p style="font-size:11px;">Observações importantes da peça:<br />
        <?=$linhaEc['obsImp']?>
      </p></td>
  </tr>
    </table>
     <div id="conteudo-cadastros-menu" style="margin-top:20px;">
    	<div id="busca-invoices-ativo">
      Banco de Arquivos</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="arquivosBanco" style="margin-top:70px;">
    <form id="form1" name="form1" method="post" action="cadastra-novo-arquivo.php?idPeca=<?=$_GET['idPeca']?>" enctype="multipart/form-data" >
    <p>Novo arquivo: <input type="text" name="descricao" id="input_text" style="width:225px;"/>  <input type="file" name="fotoUpload" id="fotoUpload" /> <input type="button" value="Cadastrar" name="new_button" id="new_button" style="float:none;"  onClick="javascript:validaForm()"></p>
    <?
		$queryA = "Select * from bancoArquivos where idPeca = '".$_GET['idPeca']."'";
		$resultadoA = mysql_query($queryA);
		if (mysql_num_rows($resultadoA)!=0) {
		while ($linhaA = mysql_fetch_array($resultadoA)) {
      $extensao = substr($linhaA['arquivo'], -4);
      if($extensao == ".JPG" or $extensao == ".jpg" or $extensao == "JPEG" or $extensao == "jpeg" or $extensao == ".png" or $extensao == ".PNG"){
        $local = "arquivosAc/".$linhaA['arquivo'];
      }else{
        $local = "images/view-ico.png";
      }?><div style="height:100px;float:left; margin-right:10px;">
    <a href="arquivosAc/<?=$linhaA['arquivo']?>" target="blank" style="color:#000;"><img src="<?=$local?>" height="100" border="1" onmouseover="document.getElementById('tituloArquivo<?=$linhaA['idArquivo']?>').style.display = 'block';" onmouseout="document.getElementById('tituloArquivo<?=$linhaA['idArquivo']?>').style.display = 'none';"></a><div style="position:absolute; padding:5px; background-color:#FFFACD; font-size:11px; display:none; margin-top:-101px;margin-left:1px;" id="tituloArquivo<?=$linhaA['idArquivo']?>"><?=$linhaA['descricao']?></div></div>
    <? }}?>
    </form>
    </div>
    <div id="conteudo-cadastros-menu" style="margin-top:140px;">
    	<div id="busca-invoices-ativo">
      Funções</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div style="margin-top:210px;">
    <? if($linhaEc['estatus'] == "Em estoque"){?>
    <input type="button" value="Venda avulsa" name="new_button" id="new_button" onclick="location.href='venda-avulsa.php?idPeca=<?=$_GET['idPeca']?>'"> <input type="button" value="Retirada da peça" name="new_button" id="new_button" onclick="location.href='retirada-peca.php?idPeca=<?=$_GET['idPeca']?>'"><input type="button" value="Voltar para o acervo" name="new_button" id="new_button" onclick="alert('Estatus: Em estoque\n\nNão é possível executar a função: Voltar para o acervo.')">
    <? }?>
    <? if($linhaEc['estatus'] == "Vendida"){?>
    <input type="button" value="Venda avulsa" name="new_button" id="new_button" onclick="alert('Estatus: Vendida\n\nNão é possível executar a função: Venda avulsa')"> <input type="button" value="Retirada da peça" name="new_button" id="new_button" onclick="alert('Estatus: Vendida\n\nNão é possível executar a função: Retirada de peça. \n\nPara retirada de peças arrematadas acesse o cadastro de comprador.')"><input type="button" value="Voltar para o acervo" name="new_button" id="new_button" onclick="location.href='voltar-acervo.php?idPeca=<?=$_GET['idPeca']?>'">
    <? }?>
    <? if($linhaEc['estatus'] == "Emprestada"){?>
    <input type="button" value="Venda avulsa" name="new_button" id="new_button" onclick="alert('Estatus: Emprestada\n\nNão é possível executar a função: Venda avulsa')"> <input type="button" value="Retirada da peça" name="new_button" id="new_button" onclick="alert('Estatus: Emprestada\n\nNão é possível executar a função: Retirada de peça.')"><input type="button" value="Voltar para o acervo" name="new_button" id="new_button" onclick="location.href='voltar-acervo.php?idPeca=<?=$_GET['idPeca']?>'">
    <? }?>
    <? if($linhaEc['estatus'] == "Retirada"){?>
    <input type="button" value="Venda avulsa" name="new_button" id="new_button" onclick="alert('Estatus: Retirada\n\nNão é possível executar a função: Venda avulsa')"> <input type="button" value="Retirada da peça" name="new_button" id="new_button" onclick="alert('Estatus: Retirada\n\nNão é possível executar a função: Retirada de peça.')"><input type="button" value="Voltar para o acervo" name="new_button" id="new_button" onclick="location.href='voltar-acervo.php?idPeca=<?=$_GET['idPeca']?>'">
    <? }?>
    
    </div>
    <div id="conteudo-cadastros-menu" style="margin-top:100px;"><div id="busca-invoices-ativo">
      Histórico</div>
       <div id="busca-cadastros" style="margin-left:10px !important;"></div>
       
    </div>
    <div style="margin-top:370px; width:90%;">
    <?
		$query1 = "Select * from historicoAcervo where idPeca = '".$linhaEc['idAcervo']."' order by date desc, idHist desc";
		$resultado1 = mysql_query($query1);
		if (mysql_num_rows($resultado1)!=0) {
		while ($linhaH = mysql_fetch_array($resultado1)) {
	?>
    <p style="background-color:#FFF"> - <?=$linhaH['data']?> - <?=$linhaH['descricao']?></p>
    <? }}?>
    <p style="background-color:#FFF"> - <?=$linhaEc['datacadastro']?> - Cadastro da peça no acervo.</p>
    </div></div>
</div>


<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "vendaok"){?>
<div id="message" align="center" style="height:150px !important;">
Venda avulsa realizada com sucesso! <br /><br />ID Peça: <?=$_GET['idPeca']?><br />
<input type="button" value="Imprimir Recibo Venda" name="close_button" id="close_button"  onclick="window.open('recibo-venda-avulsa.php?id=<?=$_GET['idPeca']?>&idComp=<?=$_GET['idComp']?>')" style="width:200px !important;"><br />
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
