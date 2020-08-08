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
        Acervo</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div style="float:right"><input type="button" value="Gerar Excel" name="new_button" id="new_button" onclick="window.open('excel-acervo.php')" style="margin-right:70px; margin-top:-10px; position:relative; z-index:600;"></div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
        <form action="?op=buscaCadastro" method="POST">
            <input type="text" name="search_text" id="search_text" placeholder="Buscar"/>
            <input type="submit" value="" name="search_button" id="search_button"> 
            <select name="categoria" id="input_text" style="width:160px; padding:10px;float:left; margin-left:10px; " onchange="location = this.value;">
              <option value="acervo.php?tipoBusca=categorias&categoria=0&op=buscaCadastro"">Categoria...</option>
              <?
              $queryCs = "Select * from categorias order by categoria asc";
                $resultadoCs = mysql_query($queryCs);
              if (mysql_num_rows($resultadoCs)!=0) {
                while ($linha = mysql_fetch_array($resultadoCs)) {
              ?>
                <option value="acervo.php?tipoBusca=categorias&categoria=<?=$linha['idCategoria']?>&op=buscaCadastro" <? if($_GET['categoria'] == $linha['idCategoria']){?>selected="selected"<? }?>><?=$linha['categoria']?></option>
                <? }}?>
            </select>
            <input type="button" value="+ Nova Peça" name="new_button" id="new_button" onclick="location.href='nova-peca.php'">
            <?
		$query1 = "Select distinct mid(descricao,1,1) as iniciais from acervo where codigoCliente = '".$_SESSION['codigoCliente']."' order by mid(descricao,1,1)";
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
        <td width="5%">Foto</td>
        <td width="10%">ID Peça</td>
        <td width="55%">Descrição</td>
        <td width="20%">Valor inicial</td>
        <td width="10%">Estatus</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	  if($_GET['tipoBusca'] == "inicio"){
			$queryCs = "Select * from acervo where descricao like '".$_GET['inicial']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by descricao asc";
		}elseif($_GET['tipoBusca'] == "categorias"){
      $queryCs = "Select * from acervo where categoria = '".$_GET['categoria']."' and codigoCliente = '".$_SESSION['codigoCliente']."' order by descricao asc";
    }else{
	  		$queryCs = "Select * from acervo where idAcervo like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or descricao like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or idCadastro like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' or nomeComitente like '%".$_POST['search_text']."%' and codigoCliente = '".$_SESSION['codigoCliente']."' order by descricao asc";
		}
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-acervo.php?idPeca=<?=$linha['idPeca']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" >
        <? if ($linha['foto'] == ""){?>
        <a href="edita-acervo.php?idPeca=<?=$linha['idPeca']?>&pagina=acervo"><img src="fotos/1400782209_photo.png" width="52" height="56" /></a>
        <? }else{?>
        <img src="fotos/<?=$linha['foto']?>" width="52" height="56" />
        <? }?></td>
        <td style="color:#787878 !important;" ><?=$linha['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linha['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linha['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-acervo.php?idPeca=<?=$linha['idPeca']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
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
    </div>
    <? }else{?>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:130px !important; margin-bottom:100px !important;">
      <tr>
        <td width="5%">Foto</td>
        <td width="10%">ID Peça</td>
        <td width="55%">Descrição</td>
        <td width="20%">Valor inicial</td>
        <td width="10%">Estatus</td>
        <td style="border-right:none !important;" width="5">&nbsp;</td>
      </tr>
      <?
	  
	  $queryCs = "Select * from acervo where estatus = 'Em estoque' order by descricao asc";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  while ($linha = mysql_fetch_array($resultadoCs)) {
	  ?>
      <tr bgcolor="#fffdea" onClick="location.href='view-acervo.php?idPeca=<?=$linha['idPeca']?>'" style="cursor:pointer;">
        <td style="color:#787878 !important;" ><? if ($linha['foto'] == ""){?>
          <a href="edita-acervo.php?idPeca=<?=$linha['idPeca']?>&amp;pagina=acervo"><img src="fotos/1400782209_photo.png" width="52" height="56" /></a>
          <? }else{?>
          <img src="fotos/<?=$linha['foto']?>" width="52" height="56" />
        <? }?></td>
        <td style="color:#787878 !important;" ><?=$linha['idAcervo']?></td>
        <td style="color:#787878 !important;" ><?=$linha['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linha['valor']?></td>
        <td style="color:#787878 !important;" ><?=$linha['estatus']?></td>
        <td style="border-right:none !important; color:#787878 !important;" ><a href="view-acervo.php?idPeca=<?=$linha['idPeca']?>"><img src="images/1464975410_old-edit-find.png" width="25" height="26" border="0" /></a></td>
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
    </div>
    
  <? }?>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center">
Cadastro realizado com sucesso! <br /><br />ID peça: <?=$_GET['idpeca']?><br />
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
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
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
