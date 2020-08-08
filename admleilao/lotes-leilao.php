<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

if($_GET['op'] == "mudalotemanu"){
	
if($_POST['lotefinal'] == ""){
	$erro = "alert('Campo Lote não preenchido, favor preencher.')";
}else{
	
	//$queryEc = "Select * from lotesLeiloes where numLote = '".$_POST['lotefinal']."' and codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
	//$resultadoEc = mysql_query($queryEc);
	//$linhaEc = mysql_fetch_array($resultadoEc);
	//$idlotelugar = $linhaEc['idLote'];
	
//header("Location: muda-lote-manual.php?idleilao=".$_GET['id']."&idLote=".$_GET['idLote']."&atual=".$_GET['atual']."&lotefinal=".$_POST['lotefinal']."&idlotelugar=".$idlotelugar."");

	
	$query = mysql_query("UPDATE `lotesLeiloes` SET `numLote` = '".$_POST['lotefinal']."', loteExt = '".$_POST['loteExt']."' WHERE `idLote` = '".$_GET['idLote']."' ") or die(mysql_error());


}}

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
        <a href="index-home.php"><img src="images/1400355878_arrow-return-180.png" width="16" height="16"  align="absmiddle"/></a></span><span style="float:right"><a href="random.php?idleilao=<?=$_GET['id']?>" style="text-decoration:none; color:#000;"><img src="images/1400029799_arrow_switch.png" width="32" height="32" align="absmiddle" border="0"> Ramdom</a></span></p>
    </div>
    </div>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:130px !important;">
      <tr>
        <td width="10%">Lote</td>
        <td width="5%">Id Peça</td>
        <td width="15%">Foto</td>
        <td width="40%">Descrição</td>
        <td width="25%">Valor inicial</td>
        <td style="border-right:none !important;" width="1">&nbsp;</td>
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
        <td style="color:#787878 !important;" ><?=$linhaLotes['numLote']?><?=$linhaLotes['loteExt']?><a href="#" onClick="return adicionar(<?=$linhaLotes['idLote']?>)"><img src="images/1395668715_document-print.png" width="14" height="14" border="0" align="absmiddle" hspace="5"></a>
        <div id="mudalote<?=$linhaLotes['idLote']?>" style="display:none;">
            
              <form name="form4" id="form4" method="post" action="?op=mudalotemanu&id=<?=$_GET['id']?>&idLote=<? echo $linhaLotes['idLote'];?>&atual=<? echo $linhaLotes['numLote'];?>">
                <input type="text" name="lotefinal" id="lotefinal" style="padding:10px; width:30px; color:#666; font-size:14px;" value="<? echo $linhaLote['numLote'];?>"> <input type="text" name="loteExt" id="loteExt" style="padding:10px; width:30px; color:#666; font-size:14px;" value="<? echo $linhaLote['loteExt'];?>">
                <input type="submit" name="Submit" id="button4" value="ok" style="padding:5px; background-color:#666666; border:0px; color:#FFF; cursor:pointer; width:50px;" />
                 &nbsp;<a href="#" onClick="return adicionar2(<?=$linhaLotes['idLote']?>)"><img src="images/1400355878_arrow-return-180.png" width="16" height="16" border="0" align="absmiddle"></a>
              </form>
            </div> 
        </td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><a href="edita-acervo.php?idPeca=<?=$linhaLot['idPeca']?>&pagina=leilao&id=<?=$_GET['id']?>"><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></a></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?> <a href="edita-acervo.php?idPeca=<?=$linhaLot['idPeca']?>&pagina=leilao&id=<?=$_GET['id']?>"><img src="images/1395668715_document-print.png" width="16" height="16" /></a></td>
        <td style="color:#787878 !important;" >R$ <?=$linhaLot['valor']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="exclui-lote.php?idleilao=<?=$_GET['id']?>&idLote=<? echo $linhaLotes['idLote'];?>&numLote=<? echo $linhaLotes['numLote'];?>"><img src="images/1326211204_remove.png" width="16" height="16" /></a></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="6" style=" border-right:none !important; color:#787878 !important;"><em>Nenhum lote cadastrado...</em></td>
        </tr>
    
    <? }?>
    <tr bgcolor="#FFFFFF">
        <td colspan="5" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><br />Buscar acervo:
        <form action="?op=buscaCadastro&id=<?=$_GET['id']?>" method="POST">
            <input type="text" name="search_text" id="search_text" placeholder="Buscar"/>
            <input type="submit" value="" name="search_button" id="search_button">
            <select name="categoria" id="input_text" style="width:160px; padding:10px;float:left; margin-left:10px; " onchange="location = this.value;">
              <option value="lotes-leilao.php?tipoBusca=categorias&categoria=0&op=buscaCadastro&id=<?=$_GET['id']?>"">Categoria...</option>
              <?
              $queryCs = "Select * from categorias order by categoria asc";
                $resultadoCs = mysql_query($queryCs);
              if (mysql_num_rows($resultadoCs)!=0) {
                while ($linha = mysql_fetch_array($resultadoCs)) {
              ?>
                <option value="lotes-leilao.php?tipoBusca=categorias&categoria=<?=$linha['idCategoria']?>&op=buscaCadastro&id=<?=$_GET['id']?>" <? if($_GET['categoria'] == $linha['idCategoria']){?>selected="selected"<? }?>><?=$linha['categoria']?></option>
                <? }}?>
            </select>
            <?
		$query1 = "Select distinct mid(descricao,1,1) as iniciais from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' order by mid(descricao,1,1)";
		$resultado1 = mysql_query($query1);
		while ($linha1 = mysql_fetch_array($resultado1)){
		?>
    <div  style="padding-top:15px; float:left; padding-left:10px;"><strong><a href="?inicial=<? echo $linha1['iniciais'];?>&op=buscaCadastro&tipoBusca=inicio&id=<?=$_GET['id']?>" style="font-size:15px; text-decoration:none; color:#999"><? echo strtoupper($linha1['iniciais']);?></a></strong></div>
    <? }?>
        </form>
        <? if($_GET['op'] == "buscaCadastro"){?>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:70px !important;">
      <tr>
        <td width="5%">Foto</td>
        <td width="10%">ID Peça</td>
        <td width="55%">Descrição</td>
        <td width="20%">Valor inicial</td>
        <td width="10%">Estatus</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	    if($_GET['tipoBusca'] == "inicio"){
            $queryBC = "Select * from acervo where descricao like '".$_GET['inicial']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by descricao asc";
        }elseif($_GET['tipoBusca'] == "categorias"){
            $queryBC = "Select * from acervo where categoria = '".$_GET['categoria']."' and codigoCliente = '".$_SESSION['codigoCliente']."' order by descricao asc";
		}else{
	  		$queryBC = "Select * from acervo where idPeca like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or descricao like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or idCadastro like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by descricao asc";
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
        <td style="border-right:none !important; color:#787878 !important;" ><input type="button" value="inserir Lote" name="new_button" id="new_button" onclick="location.href='adiciona-lote.php?id=<?=$_GET['id']?>&idPeca=<?=$linhaBC['idPeca']?>'" style="margin-left:0px !important;"></td>
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
