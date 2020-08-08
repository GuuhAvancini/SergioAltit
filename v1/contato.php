<?
if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Sobre a clínica - Hair Transplante SP - Transplante Capilar</title>
	<meta name="Resource-type" content="Document" />
	<link rel="stylesheet" type="text/css" href="jquery.fullPage.css" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<!--[if IE]>
		<script type="text/javascript">
			 var console = { log: function() {} };
		</script>
	<![endif]-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/hair-cabelo.css" />
</head>
<body onload="<?=$erro?>">
<div id="topoMenu">
        <div id="conteudo">
        	<?php include("topo.php");?>
        </div>
</div>
<div id="conteudosPaginas" style=" min-height:600px;">
		<div id="conteudo" style="margin-top:150px;">
        <p>&nbsp;</p>
        <h2>ENTRE EM CONTATO</h2>
        <hr size="1" color="#999999">
        <div id="faleHome">
          <form name="form1" method="post" action="/envia-formulario">
           <input type="text" name="nome" id="nome" value="Nome *" style="width:500px;" onfocus="this.value='';">
           <input type="text" name="email" id="email" value="E-mail *" style="width:250px;" onfocus="this.value='';"><input type="text" name="telefone" id="telefone" value="Telefone *" style="width:230px; margin-left:20px;" onfocus="this.value='';"><input type="text" name="celular" id="celular" value="Celular *" style="width:230px;" onfocus="this.value='';"><input type="text" name="cidade" id="cidade" value="Cidade *" style="width:165px; margin-left:15px;" onfocus="this.value='';"><input type="text" name="estado" id="estado" value="Estado *" style="width:80px; margin-left:10px;" onfocus="this.value='';">
           <textarea name="mensagem" rows="3" id="mensagem" style="width:500px;" onfocus="this.value='';">Mensagem *</textarea><br><input name="" type="submit" value="Enviar" style="width:150px;">
          </form>
        </div>
          <div id="faleHomeMapa">
          <h2><img src="/images/1476585721_phone1.png" width="18" height="18" hspace="10" border="0" align="absmiddle"><span style="font-size:13px">(11)</span> 9.7501-6559</h2>
          <h2><strong>Temos duas unidades de atendimento:</strong></h2>
          <p><img src="/images/1476585747_thefreeforty_location.png" width="18" height="18" hspace="10" border="0" align="absmiddle"> VILA MARIANA (somente às segundas feiras das 12hs até 14hs) </p>
          <p><img src="/images/1476585747_thefreeforty_location.png" width="18" height="18" hspace="10" border="0" align="absmiddle"> MOÓCA (atendimento médico de terça e quarta das 11hs até 16hs)</p>
          </div>
        </div>
</div>
<div id="rodapePaginas">
	<div id="conteudo" >
    	<?php include("rodape.php");?>
    </div>
</div>
</body>
</html>