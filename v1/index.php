<?php 
include("admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '2'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);

if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>AG - Escritório de Arte</title>
	<meta name="Resource-type" content="Document" />
	<link rel="stylesheet" type="text/css" href="jquery.fullPage.css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<!--[if IE]>
		<script type="text/javascript">
			 var console = { log: function() {} };
		</script>
	<![endif]-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="vendors/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="jquery.fullPage.js"></script>
	<script type="text/javascript" src="examples.js"></script>
    <script type="text/javascript" src="altit.js"></script>
    <link rel="stylesheet" type="text/css" href="altit.css" />
</head>
<body onload="<?=$erro?>">
<div id="topoMenu">
        <div id="conteudo">
        	<?php include("topo.php");?>
        </div>
</div>
<div id="fullpage">
	<div class="section " id="section0" style=" background-repeat:no-repeat; background-image:url(images/<?=$linhaSt['foto']?>); background-position:right;">
		
        
        <div id="seta" align="center"><a href="#escritorio-de-arte"><img src="images/seta.png" width="50" height="28"  style="transition:all 100ms linear; z-index:999;" id="pisca" border="0" /></a></div>
        
	</div>
	
		
	<div class="section" id="section1">
        <div id="conteudo">
         <div align="center" style="margin-top:140px;"><img src="images/logo-horizontal.png" width="480" height="100"></div>
         <div style="margin-top:20px; padding-right:80px;"><img src="images/<?=$linhaAltit['foto']?>" width="160" height="225" hspace="80" align="left" style="margin-bottom:200px;">
           <p align="justify"><?=$linhaAltit['texto']?></p>
           
         </div>
         
      </div>
      <div id="seta" align="center"><a href="#leiloes"><img src="images/seta.png" width="50" height="28"  style="transition:all 100ms linear; z-index:999;" id="pisca2" border="0" /></a></div>
	</div>
    
    <div class="section" id="section2" style=" background-repeat:no-repeat; background-image:url(images/fundo-home-leilao.jpg); background-position:right;">
	    <div id="conteudo"><p>&nbsp;</p>
        <h1 style="color:#FFF; font-size:16px;">PRÓXIMO LEILÃO</h1>
        <h1 style="color:#FFF;">00 de novembro de 2017 - 20hs</h1>
        <p>Lote em destaque:<br><img src="images/destaqueLote.jpg" width="430" height="300" style="border:1px #000000 solid"><br>OST 100 x 70 cm "Paris" ass. Cândido Oliveira<br><br></p>
        <p><a href="#" class="buttlink" style="color:#666;"> > CONFIRA OS LOTES</a></p>
      </div>
     	<div id="seta" align="center"><a href="#contato"><img src="images/seta.png" width="50" height="28"  style="transition:all 100ms linear; z-index:999;" id="pisca3" border="0" /></a></div>           
    </div>
    
    <div class="section" id="section3">
    <div id="conteudo">
	    <h2>Fale Conosco</h2>
        <hr size="1" color="#999999">
        <div id="faleHome">
          <form name="form1" method="post" action="#">
           <input type="text" name="nome" id="nome" value="Nome *" style="width:500px;" onfocus="this.value='';">
           <input type="text" name="email" id="email" value="E-mail *" style="width:250px;" onfocus="this.value='';"><input type="text" name="telefone" id="telefone" value="Telefone *" style="width:230px; margin-left:20px;" onfocus="this.value='';"><input type="text" name="celular" id="celular" value="Celular *" style="width:230px;" onfocus="this.value='';"><input type="text" name="cidade" id="cidade" value="Cidade *" style="width:165px; margin-left:15px;" onfocus="this.value='';"><input type="text" name="estado" id="estado" value="Estado *" style="width:80px; margin-left:10px;" onfocus="this.value='';">
           <textarea name="mensagem" rows="3" id="mensagem" style="width:500px;" onfocus="this.value='';">Mensagem *</textarea><br><input name="" type="submit" value="Enviar" style="width:150px;">
          </form>
        </div>
      <div id="faleHomeMapa">
        <h2><strong>R. Amélia Corrêa Fontes Guimarães, 49 - Jardim Guedala - Morumbi, São Paulo - SP</strong></h2>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.459061056005!2d-46.71939558502162!3d-23.587863884669705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce56e511231293%3A0x3553699869c2d3a!2sR.+Am%C3%A9lia+Corr%C3%AAa+Fontes+Guimar%C3%A3es%2C+49+-+Vila+Progredior%2C+S%C3%A3o+Paulo+-+SP%2C+05617-010!5e0!3m2!1spt-BR!2sbr!4v1511265735414" width="500" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
    </div>
    <div id="rodapeHome">
    	<div id="conteudo">
        <?php include("rodape.php");?>
   	  </div>
    </div>
    
	
</div>
</body>
</html>