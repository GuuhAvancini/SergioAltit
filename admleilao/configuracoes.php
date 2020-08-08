<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if($_GET['op'] == "desativar"){

$query = mysql_query("UPDATE `users` SET `isAtivo` = '0' WHERE `idUser` = '".$_GET['id']."' ") or die(mysql_error());

$queryEc = "Select * from users where codigoCliente = '".$_SESSION['codigoCliente']."' and idUser = '".$_GET['id']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Desativou o usuário: ".$linhaEc['nomeUsuario'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);
	
}

if($_GET['op'] == "ativar"){

$query = mysql_query("UPDATE `users` SET `isAtivo` = '1' WHERE `idUser` = '".$_GET['id']."' ") or die(mysql_error());

$queryEc = "Select * from users where codigoCliente = '".$_SESSION['codigoCliente']."' and idUser = '".$_GET['id']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Ativou o usuário: ".$linhaEc['nomeUsuario'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);
	
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
      <input type="button" value="+ Novo usuário" name="new_button" id="new_button" style="margin-left:10px !important; float:none !important;" onclick="location.href='novo-usuario.php'"> <input type="button" value="Categorias" name="new_button" id="new_button" style="margin-left:10px !important; float:none !important;" onclick="location.href='categorias.php'">
    </div>
    </div>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:140px !important;">
     <tr>
        <td width="15%">Nome</td>
        <td width="15%">Usuário</td>
        <td width="15%">Senha</td>
        <td width="15%">Último Login</td>
        <td width="20%">Funcionalidades</td>
        <td width="10%" align="center">Estatus</td>
        <td width="5%" align="center"></td>
        <td width="5%" align="center"></td>
      </tr>
      <?
	  $queryLotes = "Select * from users where codigoCliente = '".$_SESSION['codigoCliente']."' and usuarioAcesso <> 'rvicentine' order by nomeUsuario asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linhaLotes['nomeUsuario']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLotes['usuarioAcesso']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLotes['senhaAcesso']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLotes['ultimoLogin']?></td>
        <td style="color:#787878 !important; font-size:11px;" >
        Acervo - Visualizar: 
        <? if($linhaLotes['acervoAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?>
          - Editar: 
         <? if($linhaLotes['acervoEditar'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        Comitentes - Visualizar: 
        <? if($linhaLotes['comitenteAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?>
         - Editar: <? if($linhaLotes['comitenteEditar'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        Compradores - Visualizar: 
        <? if($linhaLotes['compradorAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?>
         - Editar: <? if($linhaLotes['compradorEditar'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        Leilões - Visualizar: 
        <? if($linhaLotes['leilaoAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?>
         - Editar: <? if($linhaLotes['leilaoEditar'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        Financeiro - Visualizar: 
        <? if($linhaLotes['financeiroAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        Configurações - Visualizar/Editar: 
		<? if($linhaLotes['configsAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        Web Site - Visualizar/Editar: 
        <? if($linhaLotes['websiteAcesso'] == '1'){?><img src="images/if_icon_accept_4838.gif" width="16" height="16" border="0" align="absmiddle" /><? }else{?>
        <img src="images/if_action_stop_4804.gif" width="16" height="16"  border="0" align="absmiddle"/><? }?><br />
        </td>
        <td style="color:#787878 !important;" align="center" ><? if($linhaLotes['isAtivo'] == '1'){?>Ativo<? }else{?>Inativo<? }?></td>
        <td style="color:#787878 !important;" align="center" ><a href="edita-usuario.php?id=<?=$linhaLotes['idUser']?>"><img src="images/1395668715_document-print.png" width="22" height="22" /></a></td>
        <td style="color:#787878 !important;" align="center" >
        <? if($linhaLotes['isAtivo'] == '1'){?>
        <a href="?op=desativar&id=<?=$linhaLotes['idUser']?>" onclick="return confirm('Tem certeza que deseja desativar o usuário?')"><img src="images/Icone-OK.png" width="22" height="22" /></a>
        <? }else{?>
        <a href="?op=ativar&id=<?=$linhaLotes['idUser']?>" onclick="return confirm('Tem certeza que deseja ativar o usuário?')"><img src="images/1395427388_unlock.png" width="22" height="22" /></a>
        <? }?>
        </td>
      </tr>
      <?
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="8" style=" border-right:none !important; color:#787878 !important;"><em>Nenhum usuário do sistema cadastrado...</em></td>
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
<? if($_GET['op'] == "ativar"){?>
<div id="message" align="center" style="z-index:100">
Usuário ativado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Usuário cadastrado com sucesso! <br /><br />
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
