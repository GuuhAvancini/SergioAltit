<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema > <?=$_SESSION['clienteNome']?></title> 
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script language="javascript">
function fechaMessage(){
	document.getElementById("message").style.display = "none";
}
function adicionar(id){
			$('#mudalote'+id).show();
			$('#lote'+id).hide();
			return false;
	}
function adicionar2(id){
			$('#mudalote'+id).hide();
			$('#lote'+id).show();
			return false;
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
<div id="conteudo">
    <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
        Lotes - Leilão</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <p><?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?> <span style="margin-left:50px;">Estatus: <?=$linha['estatus']?> 
        <a href="index-home.php"><img src="images/1400355878_arrow-return-180.png" width="16" height="16"  align="absmiddle"/></a></span></p>
    </div>
    </div>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:130px !important;">
      <tr>
        <td width="5%">Lote</td>
        <td width="5%">Id Peça</td>
        <td width="15%">Foto</td>
        <td width="40%">Descrição</td>
        <td width="15%">Valor inicial</td>
      </tr>
      <?
	  $queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linhaLotes['numLote']?><?=$linhaLotes['loteExt']?>
          <div id="mudalote<?=$linhaLotes['idLote']?>" style="display:none;">
            
              <form name="form4" id="form4" method="post" action="?op=mudalotemanu&id=<?=$_GET['id']?>&idLote=<? echo $linhaLotes['idLote'];?>&atual=<? echo $linhaLotes['numLote'];?>">
                <input type="text" name="lotefinal" id="lotefinal" style="padding:10px; width:60px; color:#666; font-size:14px;" value="<? echo $linhaLote['numLote'];?>">
                <input type="submit" name="Submit" id="button4" value="ok" style="padding:5px; background-color:#666666; border:0px; color:#FFF; cursor:pointer; width:50px;" />
                 &nbsp;<a href="#" onClick="return adicionar2(<?=$linhaLotes['idLote']?>)"><img src="images/1400355878_arrow-return-180.png" width="16" height="16" border="0" align="absmiddle"></a>
              </form>
            </div> 
        </td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linhaLot['valor']?></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="5" style=" border-right:none !important; color:#787878 !important;"><em>Nenhum lote cadastrado...</em></td>
        </tr>
    
    <? }?>
    </table>
    </div>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Lote cadastrado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center" style="z-index:100">
Lote alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "randok"){?>
<div id="message" align="center" style="z-index:100">
Ramdom executado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "exok"){?>
<div id="message" align="center" style="z-index:100">
Lote excluído com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>

</body>
</html>
