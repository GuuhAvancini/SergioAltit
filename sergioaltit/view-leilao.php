<?php 
error_reporting(0);
ini_set(“display_errors”, 0 );
include("../admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '4'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);

if($_GET['op'] == "ok"){$erro = "alert('Lance prévio enviado com sucesso, aguarde nosso contato...')";}


$mobile = FALSE;

$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");

foreach($user_agents as $user_agent){

    if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;

        $modelo = $user_agent;

        break;
    }
}
if ($mobile){
	header("Location: /mobile/view-leilao.php?id=".$_GET['id']."");
  }

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
<title>Sérgio Altit - Leiloeiro</title>
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
	margin-top:1000px;
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
	
	
}
#conteudoTxt{
	margin-bottom:40px;
	
	
}
#imgArtista{
	width: 	225px;
	height:236px;
	float:left;
}
#tituloArtistas{
	background: rgba(225, 225, 225, .8);
	height:20px;
	margin-top:-35px;
	width: 	205px;
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

#redesSociais{
	position: absolute;
	top: 5px;
	padding-left:830px;
	
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
 
.fechar{display:block; text-align:right; text-decoration:none;}
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
    float:left;
  margin:10px;
  }
</style>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script language="javascript">
$(document).ready(function(){
	
	$("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");
 
        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
     
        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(1000); 
        $('#mascara').fadeTo("slow",0.8);
 
        var left = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
        //$(id).css({'top':top,'left':left});
        $(id).show();   
    });
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
	
	
});



</script>
</head>

<body onload="<?=$erro?>">
<div id="topo">
 <div id="conteudo">
  <img src="images/logo-altit.png" width="227" height="103" />
  <div id="redesSociais"><span style="margin-right:50px; font-weight:bold; font-size:18px;"><a href="https://www.facebook.com/sergioaltitileiloes/" target="_blank"><img src="images/face-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <a href="https://www.instagram.com/sergioaltitleiloes/" target="_blank"><img src="images/insta-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <img src="images/tel-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /> Telefone: (11) 3721 9676</span></div>
  <ul class="menu-ag">
      <li><a href="contato.php">CONTATO</a></li>
      <li><a href="leiloes.php">LEILÕES</a></li>
      <li><a href="artistas.php">ARTISTAS</a></li>
      <li><a href="leiloeiro.php">O LEILOEIRO</a></li>
      <li><a href="index.php">HOME</a></li>
    </ul>
  </div>
</div>
<div id="fotoHome" style="position: relative;">
	<div id="conteudo">
    	<div id="conteudoTxt">
            <h2>Leilões:</h2>
        	<hr size="1" color="#999999">
            <?
			$querySt = "Select * from website where codigoCliente = '".$_SESSION['codigoCliente']."' and idPagina = '4'";
			$resultadoSt = mysql_query($querySt);
			$linhaSt = mysql_fetch_array($resultadoSt);
			if($linhaSt['link'] == "sim"){
			?>
          <p align="center"><img src="images/captaacaao.jpg" width="1004" height="567" /></p>
			</div><? }else{?>
            <table width="100%" border="0">
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
            
            <tr>
              <td width="496" valign="top"><a href="view-leilao.php?id=<?=$linha['idLeilao']?>"><img src="http://www.agescritoriodearte.com.br/images/<?=$linha['convite']?>"   width="764" height="429" /></a></td>
              <td width="694" valign="top">
                <h1> <?=$linha['descricao']?></h1>
                <h3>Data do Leilão:<br />
<? echo $dia." DE ".$mes." DE ".$ano;?></h3>
                <? if($_GET['op'] == "buscar"){?><input name="" type="submit" value="Catálogo Completo" style="width:150px;" onclick="location.href='view-leilao.php?id=<?=$_GET['id']?>'"><? }?>
				<? if($linha['catalogopdf'] <> ""){?><input name="" type="button" value="Catálogo em PDF" style="width:150px;" onClick="window.open('http://www.agescritoriodearte.com.br/convites/<?=$linha['catalogopdf']?>');"><? }?></p>
                </td>
              </tr>
            
<? }else{
header("Location: leiloes.php");	
}?>
            </table>
            <? }?><table width="100%" border="0">
  <tr>
    <td width="37%"><h2>Lotes:</h2></td>
    <td width="63%" align="right">
    <form id="form1" name="form1" method="post" action="?id=<?=$_GET['id']?>&op=buscar">
    Buscar:
<input name="busca" type="text" style="width:400px;" placeholder="Buscar artista, lote..." /> <input name="" type="submit" value="buscar" style="width:150px;">
</form>
</td>
  </tr>
</table>
            
            <hr size="1" color="#999999">
      <p align="center" style="width:1200px; margin-bottom:40px;">
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
               <table width="100%" border="0">
            <?
			
	  
			$EndImagem = "http://www.agescritoriodearte.com.br/admleilao/fotos/".$linhaLot['foto']; 
			$TamanhoImagem = getimagesize($EndImagem);
			if($TamanhoImagem[0] > $TamanhoImagem[1]){
				$imgTam = "width=300";
			}else{
				$imgTam = "height=300";
			}
			$imgTam = "width=300";
			
			?>
            
            <tr>
             <td width="340" height="340" rowspan="2" align="center">
             <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" class="imgLotes" /></a>
                &nbsp;&nbsp; <? if($linhaLot['foto1'] <> ""){?>
                <a href="admleilao/fotos/<?=$linhaLot['foto1']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto2'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto3'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" class="imgLotesTumb" /></a>
                <? }?>
              </td>
              <td valign="top"><h2>Lote <?=$linhaLotes['numLote']?></h2>
                <p><br />
              <?=$linhaLot['descricao']?></p></td>
              </tr>
            <tr>
              <td valign="top">Valor Base: <strong>R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?>
                <a href="#janela<?=$linhaLotes['idLote']?>" rel="modal"><input name="input" type="button" value="Dê seu lance" style="width:150px;" id="myBtn" /></a>
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
            </div>
              </td>
    </tr>
            </table>   <hr size="1" color="#999999">  
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
                       <table width="100%" border="0">
            <?
	  
			$EndImagem = "http://www.agescritoriodearte.com.br/admleilao/fotos/".$linhaLot['foto']; 
			$TamanhoImagem = getimagesize($EndImagem);
			if($TamanhoImagem[0] > $TamanhoImagem[1]){
				$imgTam = "width=300";
			}else{
				$imgTam = "height=300";
			}
			$imgTam = "width=300";
			
			?>
            
            <tr>
              <td width="340" height="340" rowspan="2" align="center">
              <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" class="imgLotes" /></a>
                &nbsp;&nbsp; <? if($linhaLot['foto1'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto2'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto3'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" class="imgLotesTumb" /></a>
                <? }?></td>
              <td valign="top"><h2>Lote <?=$linhaLotes['numLote']?></h2>
                <p><br />
              <?=$linhaLot['descricao']?></p></td>
              </tr>
            <tr>
              <td valign="top">Valor Base: <strong>R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?>     
              <a href="#janela<?=$linhaLotes['idLote']?>" rel="modal"><input name="input" type="button" value="Dê seu lance" style="width:150px;" id="myBtn" /></a>
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
            </div>
              
              </td>
    </tr>
            </table>  <hr size="1" color="#999999">
                         
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
                    <table width="100%" border="0">
            <?
	  
			$EndImagem = "http://www.agescritoriodearte.com.br/admleilao/fotos/".$linhaLot['foto']; 
			$TamanhoImagem = getimagesize($EndImagem);
			if($TamanhoImagem[0] > $TamanhoImagem[1]){
				$imgTam = "width=300";
			}else{
				$imgTam = "height=300";
			}
			
			$imgTam = "width=300";
			?>
            
            <tr>
              <td width="340" height="340" rowspan="2" align="center">
             <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto']?>" class="imgLotes" /></a>
                &nbsp;&nbsp; <? if($linhaLot['foto1'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto1']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto2'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto2']?>" class="imgLotesTumb" /></a>
                <? }
                   if($linhaLot['foto3'] <> ""){?>
                <a href="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" target="_blank"><img src="http://www.agescritoriodearte.com.br/admleilao/fotos/<?=$linhaLot['foto3']?>" class="imgLotesTumb" /></a>
                <? }?></td>
              <td valign="top"><h2>Lote <?=$linhaLotes['numLote']?></h2>
                <p><br />
              <?=$linhaLot['descricao']?></p></td>
              </tr>
            <tr>
              <td valign="top">Valor Base: <strong>R$ <?=number_format(str_replace(".","",$linhaLot['valor']), 2, ',', '.')?>
                <a href="#janela<?=$linhaLotes['idLote']?>" rel="modal"><input name="input" type="button" value="Dê seu lance" style="width:150px;" id="myBtn" /></a>
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
            </div>
              
              </td>
    </tr>
            </table><hr size="1" color="#999999">
                <? }}}?>
            </p>
            
	  </div>
         </div>
</div>
<div style="height:80px; position:relative; clear:both; ">&nbsp;</div>
<div id="mascara"></div>
</body>
</html>