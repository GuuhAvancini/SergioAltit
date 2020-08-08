<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from compradores where idCadastro = '".$_GET['idCadastro']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

if ($_SESSION['codigoCliente'] <> $linhaEc['codigoCliente']){header("Location: index.php");}

if ($_SESSION['idTemp'] == ""){$_SESSION['idTemp'] = rand();}

if($_GET['op'] == "adiciona"){
	
$query = mysql_query("INSERT INTO vendaAvulsaTemp (codigoCliente, idTemp, idComprador, idPeca) VALUES ('".$_SESSION['codigoCliente']."', '".$_SESSION['idTemp']."', '".$_GET['idCadastro']."', '".$_GET['idPeca']."')") or die(mysql_error());

}

if($_GET['op'] == "excluir"){
	
$query = mysql_query("DELETE FROM vendaAvulsaTemp WHERE idVenda = '".$_GET['idVenda']."' ") or die(mysql_error());

}

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
      Venda Avulsa</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important; width:90%;">
    <table width="100%" border="0">
  <tr>
    <td><h2><?=$linhaEc["nome"]?>
        <a href="view-comprador.php?idCadastro=<?=$_GET['idCadastro']?>" style="margin-left:50px;"><img src="images/1400355878_arrow-return-180.png" width="16" height="16" /></a></h2></td>
    <td align="right"></td>
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
          </strong></p></td>
        <td width="35%" valign="top"><p>&nbsp;</p></td>
        <td width="23%" valign="top">&nbsp;</td>
      </tr>
    </table>
    </div>
  	
    <div id="conteudo-cadastros-menu" style="margin-top:300px;">
    	<div id="busca-invoices-ativo">
        Peças Selecionadas</div>
       <div id="busca-cadastros"></div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:350px !important; ">
      <div id="tabelaBuscaCadastros">
    <table width="1000" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:10px !important; margin-bottom:50px !important;">
      <tr>
        <td width="78">Foto</td>
        <td width="95">ID Peça</td>
        <td width="496">Descrição</td>
        <td width="130">Valor Venda</td>
        <td style="border-right:none !important;" width="35">&nbsp;</td>
      </tr>
      <?
	  $queryCs = "Select * from vendaAvulsaTemp where codigoCliente = '".$_SESSION['codigoCliente']."' and idComprador = '".$_GET['idCadastro']."' and idTemp = '".$_SESSION['idTemp']."'";
	  $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linha['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linhaLot['valor']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="?op=excluir&idVenda=<?=$linha['idVenda']?>&idCadastro=<?=$_GET['idCadastro']?>"><img src="images/1326211204_remove.png" width="16" height="16" /></a></td>
      </tr>
      <? }}?>
      <tr>
      <td colspan="5" >
      <? if (mysql_num_rows($resultadoCs)!=0) {?>
      <input type="button" value="Concluir Venda Avulsa" name="new_button" id="new_button" onclick="location.href='venda-avulsa-selecao-pecas-finaliza.php?idCadastro=<?=$_GET['idCadastro']?>'" style="float:right; margin-bottom:40px;"><br /><br /><br /><? }?>
      Buscar peças no acervo:<br /><form action="?op=buscaCadastro&idCadastro=<?=$_GET['idCadastro']?>" method="POST">
            <input type="text" name="search_text" id="search_text" placeholder="Buscar"/>
            <input type="submit" value="" name="search_button" id="search_button">
            <?
		$query1 = "Select distinct mid(descricao,1,1) as iniciais from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' order by mid(descricao,1,1)";
		$resultado1 = mysql_query($query1);
		while ($linha1 = mysql_fetch_array($resultado1)){
		?>
    <div  style="padding-top:15px; float:left; padding-left:20px;"><strong><a href="?inicial=<? echo $linha1['iniciais'];?>&op=buscaCadastro&tipoBusca=inicio&idCadastro=<?=$_GET['idCadastro']?>" style="font-size:15px; text-decoration:none; color:#999"><? echo strtoupper($linha1['iniciais']);?></a></strong></div>
    <? }?>
        </form>
        <? if($_GET['op'] == "buscaCadastro"){?>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:70px !important;">
      <tr>
        <td width="5%">Foto</td>
        <td width="10%">ID Peça</td>
        <td width="50%">Descrição</td>
        <td width="20%">Valor Venda</td>
        <td width="15%">Estatus</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	  if($_GET['tipoBusca'] == "inicio"){
			$queryBC = "Select * from acervo where descricao like '".$_GET['inicial']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' order by descricao asc";
		}else{
	  		$queryBC = "Select * from acervo where idPeca like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' or descricao like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' or idCadastro like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' and estatus = 'Em estoque' order by descricao asc";
		}
      $resultadoBC = mysql_query($queryBC);
	  if (mysql_num_rows($resultadoBC)!=0) {
		  while ($linhaBC = mysql_fetch_array($resultadoBC)) {
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaBC['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaBC['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaBC['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linhaBC['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linhaBC['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linhaBC['estatus']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><input type="button" value="inserir venda" name="new_button" id="new_button" onclick="location.href='?op=adiciona&idCadastro=<?=$_GET['idCadastro']?>&idPeca=<?=$linhaBC['idPeca']?>'" style="margin-left:0px !important;"></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="7" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum acervo encontrado...</em></td>
        </tr>
    </table>
    <? }?>
    <? }?>
      </td>
      </tr>
    </table>
    
    </div>
    
    </div>
    
</div>

<? if($_GET['op'] == "adiciona"){?>
<div id="message" align="center">
Peça inserida na venda com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "excluir"){?>
<div id="message" align="center">
Peça excluída da venda! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>

</body>
</html>
