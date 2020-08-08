<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

if($_POST['dia'] == ""){$dia = date('d');}else{$dia = $_POST['dia'];}
if($_POST['mes'] == ""){$mes = date('m');}else{$mes = $_POST['mes'];}
if($_POST['ano'] == ""){$ano = date('Y');}else{$ano = $_POST['ano'];}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sistema > <?=$_SESSION['clienteNome']?></title> 
<link id="page_favicon" href="favicon.ico" rel="icon" type="image/x-icon" />
<link rel="stylesheet" href="myAuction.css" type="text/css" />
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
	
	
	if(obj.descricao.value == ""){
		alert("Campo de descricao vazio, favor preencher.")
		obj.descricao.focus()
		return
	}
	if(obj.dia.value == ""){
		alert("Campo dia não selecionado, favor selecionar.")
		obj.dia.focus()
		return
	}
	if(obj.mes.value == ""){
		alert("Campo mês não selecionado, favor selecionar.")
		obj.mes.focus()
		return
	}
	if(obj.ano.value == ""){
		alert("Campo ano não selecionado, favor selecionar.")
		obj.ano.focus()
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
        Novo Leilão</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="cadastro" align="right">
        <form action="novo-leilao-ok.php" method="POST" id="form1" name="form1">
            <p>Descrição:
              <input type="text" name="descricao" id="input_text" style="width:500px;"/><br />
              Data: 
              <select name="dia" id="input_text" style="width:90px;  padding:10px; ">
          <option value="01" <? if($dia == "01"){?>selected<? }?>>01</option>
          <option value="02" <? if($dia == "02"){?>selected<? }?>>02</option>
          <option value="03" <? if($dia == "03"){?>selected<? }?>>03</option>
          <option value="04" <? if($dia == "04"){?>selected<? }?>>04</option>
          <option value="05" <? if($dia == "05"){?>selected<? }?>>05</option>
          <option value="06" <? if($dia == "06"){?>selected<? }?>>06</option>
          <option value="07" <? if($dia == "07"){?>selected<? }?>>07</option>
          <option value="08" <? if($dia == "08"){?>selected<? }?>>08</option>
          <option value="09" <? if($dia == "09"){?>selected<? }?>>09</option>
          <option value="10" <? if($dia == "10"){?>selected<? }?>>10</option>
          <option value="11" <? if($dia == "11"){?>selected<? }?>>11</option>
          <option value="12" <? if($dia == "12"){?>selected<? }?>>12</option>
          <option value="13" <? if($dia == "13"){?>selected<? }?>>13</option>
          <option value="14" <? if($dia == "14"){?>selected<? }?>>14</option>
          <option value="15" <? if($dia == "15"){?>selected<? }?>>15</option>
          <option value="16" <? if($dia == "16"){?>selected<? }?>>16</option>
          <option value="17" <? if($dia == "17"){?>selected<? }?>>17</option>
          <option value="18" <? if($dia == "18"){?>selected<? }?>>18</option>
          <option value="19" <? if($dia == "19"){?>selected<? }?>>19</option>
          <option value="20" <? if($dia == "20"){?>selected<? }?>>20</option>
          <option value="21" <? if($dia == "21"){?>selected<? }?>>21</option>
          <option value="22" <? if($dia == "22"){?>selected<? }?>>22</option>
          <option value="23" <? if($dia == "23"){?>selected<? }?>>23</option>
          <option value="24" <? if($dia == "24"){?>selected<? }?>>24</option>
          <option value="25" <? if($dia == "25"){?>selected<? }?>>25</option>
          <option value="26" <? if($dia == "26"){?>selected<? }?>>26</option>
          <option value="27" <? if($dia == "27"){?>selected<? }?>>27</option>
          <option value="28" <? if($dia == "28"){?>selected<? }?>>28</option>
          <option value="29" <? if($dia == "29"){?>selected<? }?>>29</option>
          <option value="30" <? if($dia == "30"){?>selected<? }?>>30</option>
          <option value="31" <? if($dia == "31"){?>selected<? }?>>31</option>
        </select>
        <select name="mes" id="input_text" style="width:150px;  padding:10px; ">
          <option value="01" <? if($mes == "01"){?>selected<? }?>>Janeiro</option>
          <option value="02" <? if($mes == "02"){?>selected<? }?>>Fevereiro</option>
          <option value="03" <? if($mes == "03"){?>selected<? }?>>Mar&ccedil;o</option>
          <option value="04" <? if($mes == "04"){?>selected<? }?>>Abril</option>
          <option value="05" <? if($mes == "05"){?>selected<? }?>>Maio</option>
          <option value="06" <? if($mes == "06"){?>selected<? }?>>Junho</option>
          <option value="07" <? if($mes == "07"){?>selected<? }?>>Julho</option>
          <option value="08" <? if($mes == "08"){?>selected<? }?>>Agosto</option>
          <option value="09" <? if($mes == "09"){?>selected<? }?>>Setembro</option>
          <option value="10" <? if($mes == "10"){?>selected<? }?>>Outubro</option>
          <option value="11" <? if($mes == "11"){?>selected<? }?>>Novembro</option>
          <option value="12" <? if($mes == "12"){?>selected<? }?>>Dezembro</option>
        </select>
        <select name="ano" id="input_text" style="width:90px;  padding:10px; ">
          <option value="<?=date('Y')-1?>" <? if($ano == date('Y')-1){?>selected<? }?>>
            <?=date('Y')-1?>
          </option>
          <option value="<?=date('Y')?>" <? if($ano == date('Y')){?>selected<? }?>>
            <?=date('Y')?>
          </option>
          <option value="<?=date('Y')+1?>" <? if($ano == date('Y')+1){?>selected<? }?>>
            <?=date('Y')+1?>
          </option>
      </select> Horário: <input type="text" name="horario" id="input_text" style="width:100px;"/>
            <p>
              <input type="button" value="Cadastrar" name="envia_button" id="envia_button" onClick="javascript:validaForm()">
            </p>
        </form>
    </div>
    </div>
</div>
</body>
</html>
