<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if($_GET['op'] == "excluir"){
    $query = mysql_query("DELETE FROM categorias WHERE idCategoria = '".$_GET['idCategoria']."' ") or die(mysql_error());
}

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
      Configurações</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
      <input type="button" value="Configurações" name="new_button" id="new_button" style="margin-left:10px !important; float:none !important;" onclick="location.href='configuracoes.php'"> <input type="button" value="Categorias" name="new_button" id="new_button" style="margin-left:10px !important; float:none !important;" onclick="location.href='categorias.php'">
    </div>
    <form action="nova-categoria-ok.php" method="POST" id="form1" name="form1">
    <p>Nova Categoria: <input name="categoria" type="text" id="input_text" style="width:200px; padding:10px; " /> <input type="submit" value="Cadastrar" name="new_button" id="new_button" style="margin-left:10px !important; float:none !important;"></p></form>
    </div>
    <div id="tabelaBuscaCadastros">
    <table width="50%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:180px !important;">
     <tr>
        <td width="90%">Categoria</td>
        <td width="10%" align="center"></td>
      </tr>
      <?
	  $queryLotes = "Select * from categorias";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
	  ?>
      <tr bgcolor="#fffdea">
        
        <td style="color:#787878 !important;" ><?=$linhaLotes['categoria']?></td>
        <td style="color:#787878 !important; font-size:11px;" >
        <a href="?op=excluir&idCategoria=<?=$linhaLotes['idCategoria']?>"><img src="images/1466447515_remove.png" width="20" height="20"></a>
        </td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="2" style=" border-right:none !important; color:#787878 !important;"><em>Nenhuma categoria cadastrada no sistema...</em></td>
        </tr>
    
    <? }?>
    </table>
    </div>
</div>
<? if($_GET['op'] == "desativar"){?>
<div id="message" align="center" style="z-index:100">
Usuário desativado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "excluir"){?>
<div id="message" align="center" style="z-index:100">
Categoria excluída com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Categoria cadastrada com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center" style="z-index:100">
Usuário alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
