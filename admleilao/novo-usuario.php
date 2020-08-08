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
<style type="text/css">
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
#checkbox{
	width:20px;
}
</style>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
<script>
jQuery(function($){
	$("[name=celular]").mask("(99) 9 9999-9999");
	$("[name=telefone]").mask("(99) 9999-9999");
	$("[name=cep]").mask("99999-999");
});
function validaForm(){
	var obj = document.form1
	
	
	if(obj.nomeUsuario.value == ""){
		alert("Campo de nome vazio, favor preencher.")
		obj.nomeUsuario.focus()
		return
	}
	if(obj.usuarioAcesso.value == ""){
		alert("Campo usuário vazio, favor preencher.")
		obj.usuarioAcesso.focus()
		return
	}
	if(obj.senhaAcesso.value == ""){
		alert("Campo senha vazio, favor preencher.")
		obj.senhaAcesso.focus()
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
<div id="conteudo">
    <div id="conteudo-cadastros-menu">
    	<div id="busca-invoices-ativo">
        Confirgurações</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="cadastro" align="right">
        <form action="novo-usuario-ok.php" method="POST" id="form1" name="form1">
            <p>Nome:
              <input type="text" name="nomeUsuario" id="input_text" style="width:500px;"/><br />
              Usuário: 
              <input type="text" name="usuarioAcesso" id="input_text" style="width:240px;"/> 
              Senha: 
              <input type="text" name="senhaAcesso" id="input_text" style="width:210px;"/><br />
            </p>
            <p align="left" style="width:500px;">
            Funcionalidades: <hr width="500" align="right" />
            <p style="margin-right:250px;">Acervo: 
            <input name="acervoAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar
            <input name="acervoEditar" type="checkbox" id="checkbox" value="1" /> Editar
            </p>
            <p style="margin-right:250px;">Comitentes: 
            <input name="comitenteAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar
            <input name="comitenteEditar" type="checkbox" id="checkbox" value="1" /> Editar
            </p>
            <p style="margin-right:250px;">Compradores: 
            <input name="compradorAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar
            <input name="compradorEditar" type="checkbox" id="checkbox" value="1" /> Editar
            </p>
            <p style="margin-right:250px;">Leilões: 
            <input name="leilaoAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar
            <input name="leilaoEditar" type="checkbox" id="checkbox" value="1" /> Editar
            </p>
            <p style="margin-right:322px;">Financeiro: 
            <input name="financeiroAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar
            </p>
            <p style="margin-right:275px;">Configurações: 
            <input name="configsAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar/Editar
            </p>
            <p style="margin-right:275px;">Web Site: 
            <input name="websiteAcesso" type="checkbox" id="checkbox" value="1" /> Visualizar/Editar
            </p>
            
            <p>
              <input type="button" value="Cadastrar" name="envia_button" id="envia_button" onClick="javascript:validaForm()">
            </p>
        </form>
    </div>
    </div>
</div>
</body>
</html>
