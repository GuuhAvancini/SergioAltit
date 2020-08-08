<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$queryEc = "Select * from compradores where idCadastro = '".$_GET['idCadastro']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

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
	
	
	if(obj.nome.value == ""){
		alert("Campo de nome vazio, favor preencher.")
		obj.nome.focus()
		return
	}
	
	
	obj.submit()
}
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#estado").val("...");
                        //$("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#estado").val(dados.uf);
                                //$("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

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
        Novo Comitente</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="cadastro" align="right">
        <form action="novo-comitente-ok.php" method="POST" id="form1" name="form1">
            <p>Nome Completo:
              <input type="text" name="nome" id="input_text" style="width:500px;" value="<?=$linhaEc['nome']?>"/><br />
              E-mail: 
              <input type="text" name="email" id="input_text" style="width:235px;" value="<?=$linhaEc['email']?>"/> CPF/CNPJ: <input type="text" name="cpf" id="input_text" style="width:190px;" value="<?=$linhaEc['cpf']?>"/><br />
              Cep: 
              <input type="text" name="cep" id="cep" style="width:150px; " class="inputsTxt" value="<?=$linhaEc['cep']?>"/><img src="images/if_Search-Globe_49619.png" width="32" height="32" border="0" align="absmiddle" style="margin-right:310px; margin-left:5px; cursor:pointer;" />              <br />
              Endereço:
<input type="text" name="endereco" id="endereco" style="width:233px;" class="inputsTxt" value="<?=$linhaEc['endereco']?>"/> Número: <input type="text" name="numero" id="input_text" style="width:50px;" value="<?=$linhaEc['numero']?>"/> Comp.: <input type="text" name="complemento" id="input_text" style="width:100px;" value="<?=$linhaEc['complemento']?>"/><br />
              Bairro: 
              <input type="text" name="bairro" id="bairro" style="width:135px; " class="inputsTxt" value="<?=$linhaEc['bairro']?>"/>
              Cidade:
<input type="text" name="cidade" id="cidade" style="width:200px;" class="inputsTxt" value="<?=$linhaEc['cidade']?>"/> Estado: <input name="estado" type="text" id="estado" style="width:50px;" maxlength="2" class="inputsTxt" value="<?=$linhaEc['estado']?>"/><br />
              Telefone: 
              <input type="text" name="telefone" id="input_text" style="width:225px;" value="<?=$linhaEc['telefone']?>"/> 
              Celular: 
              <input type="text" name="celular" id="input_text" style="width:220px;" value="<?=$linhaEc['celular']?>"/><br />
            </p>
            <p align="left" style="width:500px;">
            Dados bancários: <hr width="500" align="right" />
            </p>
            <p>
              Banco: 
              <input type="text" name="banco" id="input_text" style="width:155px;"/> 
              Agência: 
              <input type="text" name="agencia" id="input_text" style="width:120px;"/> Conta: 
              <input type="text" name="conta" id="input_text" style="width:120px;"/><br />
              Tipo de conta: <select name="tipoConta" id="input_text" style="width:135px;"> 
                <option value="Conta Corrente">Conta Corrente</option>
                <option value="Conta Poupança">Conta Poupança</option>
              </select> Favorecido: 
              <input type="text" name="favorecido" id="input_text" style="width:290px;"/><br />
              CPF/CNPJ: 
              <input type="text" name="cpfFavorecido" id="input_text" style="width:260px; margin-right:250px;"/>
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
