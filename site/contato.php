<?php 
include("../admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '2'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);

if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AG - Escritório de Arte</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #f4f4f5;
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: 15px;
    line-height: 1.428571429;
    -webkit-font-smoothing: antialiased;
	color:#666666;
}
#topo{
	height:120px;
	background-color:#231f20;
	color:#FFF;	
}
#conteudo{
    width: 1200px;
    margin: 0 auto;
}
#rodape{
	margin-top:420px;
	font-size:12px;
		
}

.menu-ag, .menu-ag * {
	list-style:		none;
	float:			right;
	text-decoration: none;
  	font-size: 		15px;
	margin-left:	3px;
	margin-right:	3px;
	margin-top:		20px;
	right:			10px;
	color:			#FFF;
	padding:		5px;
	font-weight:	bold;
	
}
#conteudoTxt{
	margin-bottom:40px;	
}
input[type=text] {
    
    padding: .313em 0;
    letter-spacing: normal;
    text-indent: .25em;
	color: #666666;
	font-size: 13px !important;
    padding: 10px !important;
	border: 1px solid #999 !important;
	box-sizing: border-box;
	border-radius: 0;
    outline: 0;
    background-color: #fff;
    -webkit-appearance: none;
	cursor: text;
	 margin-top:20px;
}
textarea {
    
    padding: .313em 0;
    letter-spacing: normal;
    text-indent: .25em;
	color: #666666;
	font-size: 13px !important;
    padding: 10px !important;
	border: 1px solid #999 !important;
	box-sizing: border-box;
	border-radius: 0;
    outline: 0;
    background-color: #fff;
    -webkit-appearance: none;
	cursor: text;
	 margin-top:20px;
}
input[type=submit] {
    
    padding: .313em 0;
    letter-spacing: normal;
    text-indent: .25em;
	color: #000000;
	font-size: 13px !important;
    padding: 10px !important;
	border: 1px solid #000000 !important;
	box-sizing: border-box;
	border-radius: 0;
    outline: 0;
    background-color: #fff;
    -webkit-appearance: none;
	cursor: pointer;
	 margin-top:20px;
}
#faleHome{
	width:590px;
	margin-left:350px;
}
#faleHomeMapa{
	float:right;
	width:600px;
}
#avaliacao{
	display:none;	
}
#redesSociais{
	position: absolute;
	top: 5px;
	padding-left:790px;
	
}
</style>
<script>
    function showElement() {
        document.getElementById("avaliacao").style.display = "block";
    }
    function hideElement() {
        document.getElementById("avaliacao").style.display = "none";
    }
    
</script>
</head>

<body>
<div id="topo">
 <div id="conteudo">
  <img src="images/logo-altit.png" width="227" height="103" />
  <div id="redesSociais"><span style="margin-right:50px; font-weight:bold; font-size:18px;">Telefone: (11) 3721 9676</span><img src="images/face-ico.png" width="38" height="25" hspace="3" border="0" align="absmiddle" /> <img src="images/insta-ico.png" width="38" height="25" hspace="3" border="0" align="absmiddle" /> <img src="images/twiter-ico.png" width="38" height="25" hspace="3" border="0" align="absmiddle" /></div>
  <ul class="menu-ag">
      <li><a href="contato.php">CONTATO</a></li>
      <li><a href="leiloeiro.php">O LEILOEIRO</a></li>
      <li><a href="exposicoes.php">EXPOSIÇÕES</a></li>
       <li><a href="leiloes.php">LEILÕES</a></li>
      <li><a href="artistas.php">ARTISTAS</a></li>
      <li><a href="acervo.php">ACERVO</a></li>
      <li><a href="escritorio-de-arte.php">ESCRITÓRIO DE ARTE</a></li>
      <li><a href="index.php">HOME</a></li>
    </ul>
  </div>
</div>
<div id="fotoHome">
	<div id="conteudo">
    	<h2>Fale Conosco</h2>
        <hr size="1" color="#999999">
        <div id="faleHome">
        <h2 align="center"><strong>Entre em contato através do telefone (11) 3721 9676 ou preencha o formulário abaixo:</strong></h2>
          <form action="#" method="post" enctype="multipart/form-data" name="form1">
           <input type="text" name="nome" id="nome" value="Nome *" style="width:500px;" onfocus="this.value='';">
           <input type="text" name="email" id="email" value="E-mail *" style="width:250px;" onfocus="this.value='';"><input type="text" name="telefone" id="telefone" value="Telefone *" style="width:230px; margin-left:20px;" onfocus="this.value='';"><input type="text" name="celular" id="celular" value="Celular *" style="width:230px;" onfocus="this.value='';"><input type="text" name="cidade" id="cidade" value="Cidade *" style="width:165px; margin-left:15px;" onfocus="this.value='';"><input type="text" name="estado" id="estado" value="Estado *" style="width:80px; margin-left:10px;" onfocus="this.value='';"><p>Gostaria de deixar alguma peça para avaliação? <input name="avaliacao" type="radio" id="radio6" style="width:30px;" value="nao" checked="checked"  onclick="javascript:hideElement();"/>
Não <input name="avaliacao" type="radio" id="radio5" style="width:30px;" value="sim" onclick="javascript:showElement();" />
Sim</p>
<div id="avaliacao">
 Anexar foto: <input type="file" name="fotoUpload" id="fotoUpload" />
</div>
           <textarea name="mensagem" rows="3" id="mensagem" style="width:500px;" onfocus="this.value='';">Mensagem *</textarea><br><input name="" type="submit" value="Enviar" style="width:150px;">
          </form>
        </div>
      
    </div>
</div>
<div id="mapa" style="margin-top:50px;">
<h2 align="center"><strong>R. Amélia Corrêa Fontes Guimarães, 49 - Jardim Guedala - Morumbi, São Paulo - SP</strong></h2>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.459061056005!2d-46.71939558502162!3d-23.587863884669705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce56e511231293%3A0x3553699869c2d3a!2sR.+Am%C3%A9lia+Corr%C3%AAa+Fontes+Guimar%C3%A3es%2C+49+-+Vila+Progredior%2C+S%C3%A3o+Paulo+-+SP%2C+05617-010!5e0!3m2!1spt-BR!2sbr!4v1511265735414" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen></iframe></div>
		  <div style="margin-top:50px;">      
            <p align="center">Copyright © 2018 - AG - Escritorio de Arte. Todo o conteúdo deste site é de uso exclusivo.<br />
            R. Amélia Corrêa Fontes Guimarães, 49 - Jardim Guedala - Morumbi, São Paulo - SP - Tel: 55 11 3721 9676
            </p>
    	</div>
</body>
</html>
