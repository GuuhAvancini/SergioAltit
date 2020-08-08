<?php 
include("admleilao/seguranca.php"); // Inclui o arquivo com o sistema de segurança
$querySt = "Select * from website where codigoCliente = '1' and idPagina = '1'";
$resultadoSt = mysql_query($querySt);
$linhaSt = mysql_fetch_array($resultadoSt);

$queryAltit = "Select * from website where codigoCliente = '1' and idPagina = '2'";
$resultadoAltit = mysql_query($queryAltit);
$linhaAltit = mysql_fetch_array($resultadoAltit);

if($_GET['op'] == "ok"){$erro = "alert('Dados enviado com sucesso, aguarde nosso contato...')";}

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
	header("Location: /mobile/artistas.php");
  }
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127428658-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'UA-127428658-1');
</script>
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
	font-family: Helvetica, Sans-Serif;
    font-size: 15px;
    line-height: 1.428571429;
    -webkit-font-smoothing: antialiased;
}
#topo{
	height:170px;
	background-color:#000000;
	color:#FFF;	
}
#conteudo{
    width: 1200px;
    margin: 0 auto;
}
#rodape{
	margin-top:20px;
	font-size:12px;
		
}
.menu-ag, .menu-ag * {
	list-style:		none;
	float:			right;
	text-decoration: none;
  	font-size: 		15px;
	margin-left:	10px;
	margin-right:	10px;
	margin-top:		5px;
	right:			10px;
	color:			#FFF;
	padding:		5px;
	font-weight:	bold;
	
	
}
#redesSociais{
	float:right;
	margin-top:30px;
	margin-right:30px;
	
	
}
#fotoHome{
	margin-top:20px;
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
#butBusca{
    width: 25px;
    height: 25px;
    margin-top:25px;
    margin-left:-35px;
    position:absolute;
    
}

</style>
</head>

<body>
<div id="topo">
 <div id="conteudo">
 <img src="images/logo-altit.png" width="227" height="103" />
  <div id="redesSociais"><a href="https://www.facebook.com/ag.escritoriodearte/" target="_blank"><img src="images/face-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <a href="https://www.instagram.com/ag.escritoriodearte/?hl=pt-br" target="_blank"><img src="images/insta-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /></a> <img src="images/tel-ico.png" width="30" height="30" hspace="3" border="0" align="absmiddle" /> <span style="font-weight:bold; font-size:22px;">(11) 3721 9676</span></div>
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
    	<div id="conteudoTxt">
            <h2>Artistas:</h2>
        	<hr size="1" color="#999999">
            <form action="?op=busca" id="form1" name="form1" method="post">
            <input name="busca" type="text" style="width:400px;" placeholder="Buscar artista..." /> <input type="image" src="images/if_11_Search_106236.png" id="butBusca" style="float:left; " >
			<div  style="margin-top:-30px; margin-right:200px;">
			<?
		$query1 = "Select distinct mid(nome,1,1) as iniciais from artistas order by nome desc";
		$resultado1 = mysql_query($query1);
		while ($linha1 = mysql_fetch_array($resultado1)){
		?>
    <div  style="float:right;"><strong><a href="?inicial=<? echo $linha1['iniciais'];?>&op=busca&tipoBusca=inicio" style="font-size:15px; text-decoration:none; color:#999; margin:8px;"><? echo strtoupper($linha1['iniciais']);?></a></strong></div>
    <? }?></div>
            </form>
            <p align="center" style="width:1200px; margin-bottom:40px;">
				<?
                      if($_GET['op'] == "busca"){
						if($_GET['tipoBusca'] == "inicio"){
					  		$queryCs = "Select * from artistas where nome like '".$_GET['inicial']."%' ORDER BY nome asc";
						}else{
							$queryCs = "Select * from artistas where nome like '%".$_POST['busca']."%' ORDER BY nome asc";
						}
					}elseif($_GET['op'] == "todos"){
						$queryCs = "Select * from artistas ORDER BY nome asc";
					  }else{
					  	$queryCs = "Select * from artistas ORDER BY rand() limit 20";
					  }
					  
					  $resultadoCs = mysql_query($queryCs);
                      if (mysql_num_rows($resultadoCs)!=0) {
                          while ($linha = mysql_fetch_array($resultadoCs)) {
                
                ?>
                    <div id="imgArtista">
                        <a href="artista-perfil.php?id=<?=$linha['idArtista']?>"><img src="../images/<?=$linha['foto']?>" width="215" height="226" style="margin:5px;" /></a>
                        <div id="tituloArtistas"><?=$linha['nome']?></div>
                    </div>
                <? }}?>
            </p>
	  </div>
         </div>
</div>
</body>
</html>
