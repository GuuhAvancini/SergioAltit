<?
if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Sobre a clínica - Hair Transplante SP - Transplante Capilar</title>
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
    <link rel="stylesheet" type="text/css" href="hair-cabelo.css" />
</head>
<body onload="<?=$erro?>">
<div id="topoMenu">
        <div id="conteudo">
        	<?php include("topo.php");?>
        </div>
</div>
<div id="conteudosPaginas">
		<div id="conteudo">
        <div align="center" style="margin-top:160px;"><img src="images/logo_clinica-cinza.png" width="350" height="150"></div>
         <div style="margin-top:20px; padding-right:80px;">
           <p>Nosso atendimento é realizado na: VILA MARIANA (Segunda-feira: das 14hs até 16hs, Terça-feira: das 18hs até 19:30hs e Quarta-feira: das 11hs até 14hs) que é um dos bairros mais tradicionais da cidade. O bairro conta com grande infraestrutura permitindo fácil acesso: seja de carro, metrô ou mesmo de ônibus. Abaixo, as principais referências:</p>
           <ul>
             <li><strong>Carro:</strong> Próximo da Av. Paulista;</li>
             <li><strong>Metrô:</strong> Próximo ao metrô;</li>
             <li><strong>Ônibus:</strong> Há diversas linhas de ônibus. Sugerimos verificar a melhor opção na Sptrans (<a href="http://www.sptrans.com.br/" target="_blank" style="color:#666">http://www.sptrans.com.br/</a>).</li>
           </ul>
           <p>Para maiores informações, ligue para <strong>11 9.4495-1907 (WhatsApp).</strong></p>
           <p align="justify">&nbsp;</p>
           <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
        </div>
</div>
<div id="rodapePaginas">
	<div id="conteudo" >
    	<?php include("rodape.php");?>
    </div>
</div>
</body>
</html>