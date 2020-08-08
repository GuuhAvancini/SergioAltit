<?php
include("../../admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '3'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127523056-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127523056-1');
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sergio Altit</title>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="stylesheet" href="stylem.css">
<style type="text/css">
body {
	background-color: #F7F7F7;
    margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	color: #999999;
}

#buscatag{
    width:80%;
    margin-bottom:30px;
    font-size:16px;
    padding:20px;
    color:#ed462f;
    border-radius:5px;
    border:1px solid #CCC;
}
.inputTxt{
    width:450px;
    font-size:16px;
    padding:10px;
    color:#ed462f;
    border-radius:5px;
    border:1px solid #CCC;
}
#butBusca{
    width: 25px;
    height: 25px;
    margin-top:20px;
    margin-left:-40px;
    position:absolute;
    
}
#bot {
    border: none !important;
    padding: 10px;
    color: #FFF !important;
    background-color: #ed462f !important;
    cursor: pointer;
    border-radius: 5px;
    font-size: 15px !important;
    height: 40px;
    width:80% !important;
    -webkit-appearance: none;
    margin:5px  !important;
}
.voltaTopo {
    width: 100px;
    height: 100px;
    position: fixed;
    z-index: 1000;
    right: 1rem;
    bottom: 1rem;
    display:none;
}
#home{
    height:800px;
}
#quem-somos{
    height:750px;
    color:#000;
    padding-top:50px;
}
#como-funciona{
    height:750px;
    color:#000;
    padding-top:50px;
}
#cadastre-se{
    height:760px;
    color:#000;
    padding-top:40px;
}
#duvidas{
    height:770px;
    color:#000;
    padding-top:20px;
}
#central-atendimento{
    height:800px;
}
#rodapeHome{
    height:20px;
    background-color:#f2f2f2;
    position:absolute;
    bottom: 1px;
    width:100%;
    border-top: 1px solid #CCC;
    font-size:13px;
    padding-top:20px;
    padding-bottom:20px;
}
#rodapeHome a{
    text-decoration:none;
    color: #999999;
}
#conteudo{
    width: 1100px;
    margin: 0 auto;
}
#textQuemSomos{
    width:500px;
    font-size: 1.0em;
    line-height: 1.5em;
    float:left;

}
#quadroComo{
    width:230px;
    float:left;
    padding:20px;
}
#rodapeComofunciona{
    width:100%;
    padding-top:375px;
}
#quadroCadastro{
    width:500px;
    float:left;
}
#rodapeCadastrese{
    width:100%;
    padding-top:150px;
}
.respostasPerguntas{
    padding:10px;
    background-color:#fee3df;
    border-radius:5px;
}
#loginQuadro{
    position:fixed;
    top:10px;
    right:10px;
    width:300px;
    height:60px;
}
#loginForm{
    position:absolute;
    width:260px;
    height:300px;
    border-radius:5px;
    background-color:#FFF;
    margin-top:5px;
    margin-right:10px;
    padding:10px;
    border:1px solid #000;
}
#rodapeMenu{
    position:absolute;
    bottom:20px;
}
#rodapeMenu a{
    text-decoration:none;
    color: #999999;
}
#rodape{
    margin-top:30px;
    font-size:12px;
}
h2{
    font-size:16px;
    margin-top:20px;
}
#imgArtista{
    margin-bottom:20px;
}
#tituloArtistas{
	background: rgba(225, 225, 225, .8);
	height:20px;
	margin-top:-35px;
	width: 90%;
	position:relative;
	z-index:100;
	margin-left:5px;
	padding:5px;
}
#tituloArtistas{
	background: rgba(225, 225, 225, .8);
	height:20px;
	margin-top:-35px;
	
	position:relative;
	z-index:100;
	margin-left:5px;
	padding:5px;
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
    background-color: #CCC;
    -webkit-appearance: none;
	cursor: pointer;
	 margin-top:20px;
	 margin-left:10px;
}
input[type=button] {
    
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
    background-color: #CCC;
    -webkit-appearance: none;
	cursor: pointer;
	 margin-top:20px;
	 margin-left:10px;
}
#butBusca{
    width: 25px;
    height: 25px;
    margin-top:25px;
    margin-left:-35px;
    position:absolute;
    
}
.window{
    display:none;
    width:600px;
    height:440px;
    position:fixed;
    left:50%;
	top:50%;
    background:#FFF;
    z-index:9900;
    padding:10px;
    border-radius:10px;
	overflow:auto;
	margin-left:-300px;
	margin-top:-220px;
}
 
#mascara{
    display:none;
    position:absolute;
    left:0;
    top:0;
    z-index:9000;
    background-color:#000;
}
  .imgLotes{
    max-width:310px;
    max-height:310px;
    width: auto;
    height: auto;
  }
.imgLotesTumb{
    max-width:90px;
    max-height:90px;
    width: auto;
    height: auto;
   margin:10px;
  }
.fechar{display:block; text-align:right; text-decoration:none;}
</style>
<script type="text/javascript">

$(document).ready(function(){
    $('.menu-anchor').on('click touchstart', function(e){
        $('html').toggleClass('menu-active');
        e.preventDefault();
    });
    })
</script>
</head>
<body onload="<?=$erro?>">
<header><span class="menu-anchor"></span>
<p align="center">
<img src="../images/logo-altit.png" width="227" height="103" /></p>
</header>
<menu>
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="leiloeiro.php">O LEILOEIRO</a></li>
        <li><a href="artistas.php">ARTISTAS</a></li>
        <li><a href="leiloes.php">LEILÕES</a></li>
        <li><a href="contato.php">CONTATO</a></li>
    </ul>
    <div id="rodapeMenu" align="center">
    <p align="center" style="margin-left:10px;">
    <img src="http://www.agescritoriodearte.com.br/images/tel-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /> <span style="font-weight:bold; font-size:22px;">(11) 3721 9676</span></p>
    <p>&nbsp;</p>
    </div>
</menu>
<section class="main">

<?
			$querySt = "Select * from website where codigoCliente = '".$_SESSION['codigoCliente']."' and idPagina = '4'";
			$resultadoSt = mysql_query($querySt);
			$linhaSt = mysql_fetch_array($resultadoSt);
			if($linhaSt['link'] == "sim"){
			?>
          <p align="center"><img src="http://www.agescritoriodearte.com.br/images/captaacaao.jpg" width="90%" /></p>
			</div><? }else{?>
            
            <?
	  $queryCs = "Select * from leiloes where idLeilao = '".$_GET['id']."' and convite <> '' and estatus = 'Pregão'";
      $resultadoCs = mysql_query($queryCs);
	  if (mysql_num_rows($resultadoCs)!=0) {
		  $linha = mysql_fetch_array($resultadoCs);
			$idleilaoDestaque = $linha['idLeilao'];
			
			$pieces = explode("/", $linha['dataLeilao']);
			$dia = $pieces[0];
			$mes = $pieces[1];
			$ano = $pieces[2];
			
			switch ($mes){
				 
				case 1: $mes = "JANEIRO"; break;
				case 2: $mes = "FEVEREIRO"; break;
				case 3: $mes = "MARÇO"; break;
				case 4: $mes = "ABRIL"; break;
				case 5: $mes = "MAIO"; break;
				case 6: $mes = "JUNHO"; break;
				case 7: $mes = "JULHO"; break;
				case 8: $mes = "AGOSTO"; break;
				case 9: $mes = "SETEMBRO"; break;
				case 10: $mes = "OUTUBRO"; break;
				case 11: $mes = "NOVEMBRO"; break;
				case 12: $mes = "DEZEMBRO"; break;
				 
				}
			
			?>
            
            <p style="margin-left:15px; margin-right:15px; margin-top:20px;" align="center"><a href="view-leilao.php?id=<?=$linha['idLeilao']?>"><img src="http://www.agescritoriodearte.com.br/images/<?=$linha['convite']?>"  width="90%"  /></a><p>
             
                <h1 style="margin-left:30px; margin-right:30px;"> <?=$linha['descricao']?></h1>
                <h3 style="margin-left:30px; margin-right:30px;">Data do Leilão:<br />
<? echo $dia." DE ".$mes." DE ".$ano;?></h3>
                <? if($_GET['op'] == "buscar"){?><input name="" type="submit" value="Catálogo Completo" style="width:150px;" onclick="location.href='view-leilao.php?id=<?=$_GET['id']?>'"><? }?>
				<? if($linha['catalogopdf'] <> ""){?><input name="" type="button" value="Catálogo em PDF" style="width:150px;" onClick="window.open('http://www.agescritoriodearte.com.br/convites/<?=$linha['catalogopdf']?>');"><? }?>
                
            
<? }else{
header("Location: leiloes.php");	
}?>
           
            <? }?>
    <p>&nbsp;</p>
    <h2 style="margin-left:30px; margin-right:30px;">Lotes:</h2>
    
            <hr size="1" color="#999999"style="margin-left:15px; margin-right:15px; margn-top:20px;">
      <p align="center" style="margin-bottom:40px;margin-left:15px; margin-right:15px; margin-top:20px;">
				<?
				
				$queryCs = "Select * from leiloes where idLeilao = '".$_GET['id']."' and convite <> '' and estatus = 'Pregão' and siteSergio = '1'";
      			$resultadoCs = mysql_query($queryCs);
				if (mysql_num_rows($resultadoCs)!=0) {
		  		$linha = mysql_fetch_array($resultadoCs);
				$idleilaoDestaque = $linha['idLeilaoN'];
				}else{
				header("Location: leiloes.php");	
				}
				
				
				
				if($_GET['op'] == "buscar"){
                     if (is_numeric($_POST['busca'])){
						  $queryLotes = "Select * from lotesLeiloes where numLote = '".$_POST['busca']."' and idLeilaoN = '".$idleilaoDestaque."' ORDER BY numLote asc"; 
						  $resultadoLotes = mysql_query($queryLotes);
						  if (mysql_num_rows($resultadoLotes)!=0) {
							  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
								  
								  
									$queryLot = "Select * from acervo  where idPeca = '".$linhaLotes['idPeca']."'";
									$resultadoLot = mysql_query($queryLot);
									$linhaLot = mysql_fetch_array($resultadoLot);
									
								
                ?>
               
           <p style="margin-left:15px; margin-right:15px;">
  <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" class="imgLotes" /></a></p>
  <p style="width:310px;"> 
    <? if($linhaLot['foto1'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto2'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto3'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" class="imgLotesTumb" /></a>
                <? }?>
            </p><p>&nbsp;</p>
              <h2 style="margin-left:30px; margin-right:30px;">Lote <?=$linhaLotes['numLote']?></h2>
                <p style="margin-left:30px; margin-right:30px;"><br />
              <?=$linhaLot['descricao']?></p><p style="margin-left:30px; margin-right:30px;">Valor Base: <strong>R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?>
                <a href="#janela<?=$linhaLotes['idLote']?>" rel="modal"><input name="input" type="button" value="Dê seu lance" style="width:150px;" id="myBtn" /></a></p>
              </strong>
              <div class="window" id="janela<?=$linhaLotes['idLote']?>">
            <a href="#" class="fechar" style="color:#000 !important;">X Fechar</a>
            <form id="form2" name="form2" method="post" action="envia-lance-previo.php?id=<?=$_GET['id']?>">
		  <h4>Lance Prévio - <?=$linha['descricao']?> - <? echo $dia." DE ".$mes." DE ".$ano;?></h3>
          <h4>Lote: <?=$linhaLotes['numLote']?> - Valor Base: R$ <?=$linhaLot['valor']?></h4>
          <h4>Nome: <input name="nome" type="text" style="width:430px;"/></h4>
          <h4>E-mail: <input name="email" type="text" style="width:170px;"/> Telefone: <input name="telefone" type="text" style="width:170px;"/></h4>
          <h4>Valor do Lance: R$ <input name="valor" type="text" style="width:170px;"/> <input name="tipo" type="radio" value="Único" checked="checked" /> Único <input name="tipo" type="radio" value="Até valor" /> Até valor</h4><input name="lote" type="hidden" value="<?=$linhaLotes['numLote']?>" /><input name="leilao" type="hidden" value="<?=$linha['descricao']?> - <? echo $dia." DE ".$mes." DE ".$ano;?>" />
          <input name="input" type="submit" value="Enviar lance" style="width:150px;" />
          </form>
            </div>  <hr size="1" color="#999999" style="margin-left:15px; margin-right:15px; margin-top:20px; margin-bottom:20px;">
                <? 			}
						  }else{echo "<i>Nenhum lote encontrado para a busca...</i>";}
					 }else{
						 $erro = 0;
						 $queryLotes = "Select * from lotesLeiloes where idLeilaoN = '".$idleilaoDestaque."' ORDER BY numLote asc"; 
						  $resultadoLotes = mysql_query($queryLotes);
						  if (mysql_num_rows($resultadoLotes)!=0) {
							  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
								  
								  
									$queryLot = "Select * from acervo  where idPeca = '".$linhaLotes['idPeca']."'";
									$resultadoLot = mysql_query($queryLot);
									$linhaLot = mysql_fetch_array($resultadoLot);
									
									
										if (strpos($linhaLot['descricao'],$_POST['busca']) !== FALSE){
						 ?>
                      
           <p align="center" style="margin-left:15px; margin-right:15px;"><a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" class="imgLotes" /></a></p>
  <p style="width:310px;"> 
    <? if($linhaLot['foto1'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto2'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto3'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" class="imgLotesTumb" /></a>
                <? }?>
            </p><p>&nbsp;</p>
              <h2 style="margin-left:30px; margin-right:30px;">Lote <?=$linhaLotes['numLote']?></h2>
                <p style="margin-left:30px; margin-right:30px;"><br />
              <?=$linhaLot['descricao']?></p><p style="margin-left:30px; margin-right:30px;">Valor Base: <strong>R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?>
                <a href="#janela<?=$linhaLotes['idLote']?>" rel="modal"><input name="input" type="button" value="Dê seu lance" style="width:150px;" id="myBtn" /></a></p>
              </strong>
              <div class="window" id="janela<?=$linhaLotes['idLote']?>">
            <a href="#" class="fechar" style="color:#000 !important;">X Fechar</a>
            <form id="form2" name="form2" method="post" action="envia-lance-previo.php?id=<?=$_GET['id']?>">
		  <h4>Lance Prévio - <?=$linha['descricao']?> - <? echo $dia." DE ".$mes." DE ".$ano;?></h3>
          <h4>Lote: <?=$linhaLotes['numLote']?> - Valor Base: R$ <?=$linhaLot['valor']?></h4>
          <h4>Nome: <input name="nome" type="text" style="width:430px;"/></h4>
          <h4>E-mail: <input name="email" type="text" style="width:170px;"/> Telefone: <input name="telefone" type="text" style="width:170px;"/></h4>
          <h4>Valor do Lance: R$ <input name="valor" type="text" style="width:170px;"/> <input name="tipo" type="radio" value="Único" checked="checked" /> Único <input name="tipo" type="radio" value="Até valor" /> Até valor</h4><input name="lote" type="hidden" value="<?=$linhaLotes['numLote']?>" /><input name="leilao" type="hidden" value="<?=$linha['descricao']?> - <? echo $dia." DE ".$mes." DE ".$ano;?>" />
          <input name="input" type="submit" value="Enviar lance" style="width:150px;" />
          </form>
            </div> <hr size="1" color="#999999" style="margin-left:15px; margin-right:15px; margin-top:20px; margin-bottom:20px;">
                         
						 <?
							 		 	}else{$erro = 1;}
						 
							  }
						  }
						 
						 
					 }
						  
						  
				}else{?>
                <?
                $queryLotes = "Select * from lotesLeiloes where idLeilaoN = '".$idleilaoDestaque."' ORDER BY numLote asc"; 
					  $resultadoLotes = mysql_query($queryLotes);
                      if (mysql_num_rows($resultadoLotes)!=0) {
                          while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
							  
							  
								$queryLot = "Select * from acervo  where idPeca = '".$linhaLotes['idPeca']."'";
					  			$resultadoLot = mysql_query($queryLot);
                      			$linhaLot = mysql_fetch_array($resultadoLot);
									
								
                ?>
                   
            <p align="center" style="margin-left:15px; margin-right:15px;"><a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" class="imgLotes" /></a></p>
  <p style="width:310px;"> 
    <? if($linhaLot['foto1'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto2'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto3'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" class="imgLotesTumb" /></a>
                <? }?>
            </p><p>&nbsp;</p>
              <h2 style="margin-left:30px; margin-right:30px;">Lote <?=$linhaLotes['numLote']?></h2>
                <p style="margin-left:30px; margin-right:30px;"><br />
              <?=$linhaLot['descricao']?></p><p style="margin-left:30px; margin-right:30px;">Valor Base: <strong>R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?>
                <a href="#janela<?=$linhaLotes['idLote']?>" rel="modal"><input name="input" type="button" value="Dê seu lance" style="width:150px;" id="myBtn" /></a></p>
              </strong>
              <div class="window" id="janela<?=$linhaLotes['idLote']?>">
            <a href="#" class="fechar" style="color:#000 !important;">X Fechar</a>
            <form id="form2" name="form2" method="post" action="envia-lance-previo.php?id=<?=$_GET['id']?>">
		  <h4>Lance Prévio - <?=$linha['descricao']?> - <? echo $dia." DE ".$mes." DE ".$ano;?></h3>
          <h4>Lote: <?=$linhaLotes['numLote']?> - Valor Base: R$ <?=$linhaLot['valor']?></h4>
          <h4>Nome: <input name="nome" type="text" style="width:430px;"/></h4>
          <h4>E-mail: <input name="email" type="text" style="width:170px;"/> Telefone: <input name="telefone" type="text" style="width:170px;"/></h4>
          <h4>Valor do Lance: R$ <input name="valor" type="text" style="width:170px;"/> <input name="tipo" type="radio" value="Único" checked="checked" /> Único <input name="tipo" type="radio" value="Até valor" /> Até valor</h4><input name="lote" type="hidden" value="<?=$linhaLotes['numLote']?>" /><input name="leilao" type="hidden" value="<?=$linha['descricao']?> - <? echo $dia." DE ".$mes." DE ".$ano;?>" />
          <input name="input" type="submit" value="Enviar lance" style="width:150px;" />
          </form>
            </div><hr size="1" color="#999999" style="margin-left:15px; margin-right:15px; margin-top:20px; margin-bottom:20px;">
                <? }}}?>
            </p>
<p align="center" id="rodape">Copyright © 2018 - Sergio Altit.<br>Todo o conteúdo deste site é de uso exclusivo.<br />
R. Amélia Corrêa Fontes Guimarães, 49<br>Jardim Guedala - Morumbi, São Paulo - SP<br>Tel: 55 11 3721 9676
</p>
</section>
</body>
</html>
