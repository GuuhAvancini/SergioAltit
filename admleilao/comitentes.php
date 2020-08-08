<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

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
        Comitentes</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div style="float:right"><input type="button" value="Gerar Excel" name="new_button" id="new_button" onclick="window.open('excel-comitentes.php')" style="margin-right:70px; margin-top:-10px; position:relative; z-index:600;"></div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <form action="?op=buscaCadastro" method="POST">
            <input type="text" name="search_text" id="search_text" placeholder="Buscar"/>
            <input type="submit" value="" name="search_button" id="search_button">
            <input type="button" value="+ Novo Comitente" name="new_button" id="new_button" onclick="location.href='novo-comitente.php'">
            <?
		$query1 = "Select distinct mid(nome,1,1) as iniciais from comitentes where codigoCliente = '".$_SESSION['codigoCliente']."' order by mid(nome,1,1)";
		$resultado1 = mysql_query($query1);
		while ($linha1 = mysql_fetch_array($resultado1)){
		?>
    <div  style="padding-top:15px; float:left; padding-left:10px;"><strong><a href="?inicial=<? echo $linha1['iniciais'];?>&op=buscaCadastro&tipoBusca=inicio" style="font-size:15px; text-decoration:none; color:#999"><? echo strtoupper($linha1['iniciais']);?></a></strong></div>
    <? }?>
        </form>
    </div>
    </div>
    <? if($_GET['op'] == "buscaCadastro"){?>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:130px !important;">
      <tr>
        <td width="10%">ID</td>
        <td width="30%">Nome</td>
        <td width="20%">Telefone</td>
        <td width="20%">Celular</td>
        <td width="20%">E-mail</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	  if($_GET['tipoBusca'] == "inicio"){
			$queryCs = "Select * from comitentes where nome like '".$_GET['inicial']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
		}else{
	  		$queryCs = "Select * from comitentes where idComitente like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or nome like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or cpf like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or email like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by nome asc";
		}
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-comitente.php?idCadastro=<?=$linha['idCadastro']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><?=$linha['idComitente']?></td>
        <td style="color:#787878 !important;" ><?=$linha['nome']?></td>
        <td style="color:#787878 !important;" ><?=$linha['telefone']?></td>
        <td style="color:#787878 !important;" ><?=$linha['celular']?></td>
        <td style="color:#787878 !important;" ><?=$linha['email']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-comitente.php?idCadastro=<?=$linha['idCadastro']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="7" style="border-bottom:none !important; border-right:none !important; color:#787878 !important;"><em>Nenhum comitente encontrado...</em></td>
        </tr>
    </table>
    <? }?>
    </div>
    <? }?>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID Comitente: <?=$_GET['id']?><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center">
Cadastro alterado com sucesso!<br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "caddup"){?>
<div id="message" align="center">
Cadastro já existente no sistema!<br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();" style="background-color:#F00 !important;">
</div>
<? }?>
<? if($_GET['op'] == "exok"){?>
<div id="message" align="center">
Cadastro excluído com sucesso!<br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
