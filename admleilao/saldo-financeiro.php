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
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script language="javascript">
function fechaMessage(){
	document.getElementById("message").style.display = "none";
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
      Saldo Financeiro</div>
       <div id="busca-cadastros">&nbsp;</div>
    </div>
    <div id="conteudo-home-busca-cadastros" style="display:block !important; margin-top:50px !important;">
    <div id="searchPaginas">
      <form id="form1" name="form1" method="post" action="?op=buscar">
        <select name="id" id="input_text" style="width:250px;"> 
          <option value="">Selecione o Leilão:</option>
                <?
	  $queryBL = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' order by data desc limit 12";
	  $resultadoBL = mysql_query($queryBL);
	  if (mysql_num_rows($resultadoBL)!=0) {
		  while ($linhaBL = mysql_fetch_array($resultadoBL)) {
	  ?>
      <option value="<?=$linhaBL['idLeilaoN']?>"><?=$linhaBL['descricao']?></option>
      <? }}?>
                
      </select><input type="submit" value="Buscar" name="new_button" id="new_button" style="margin-left:10px !important; float:none !important;">  </form>
    </div>
    </div>
    <? if($_GET['op'] == "buscar"){
		
		$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Visualizou o relatório financeiro.\n";
		escrevelog($linhalog,$_SESSION['codigoCliente']);
		
		$queryLeilao = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_POST['id']."'";
		$resultadoLeilao = mysql_query($queryLeilao);
		$linhaLeilao = mysql_fetch_array($resultadoLeilao);
		
		?>
    <div style="margin-top:130px; position:absolute;"><?=$linhaLeilao['idLeilaoN']?> - <?=$linhaLeilao['descricao']?> - <?=$linhaLeilao['dataLeilao']?> - <?=$linhaLeilao['horario']?></div>
    <div id="tabelaBuscaCadastros">
    <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tabelaBusca"  style="margin-top:170px !important;">
     <tr>
        <td width="5%">Lote</td>
        <td width="5%">Id Peça</td>
        <td width="5%">Foto</td>
        <td width="25%">Descrição</td>
        <td width="10%">Valor inicial</td>
        <td width="20%">Arrematado por</td>
        <td width="10%" align="center">Valor arremate</td>
        <td width="10%" align="center">Comissão Leiloeiro</td>
        <td width="10%" align="center">Comissão Galeria</td>
      </tr>
      <?
	  $queryLotes = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_POST['id']."' order by numLote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotes['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
	  ?>
      <tr bgcolor="#fffdea">
        <td style="color:#787878 !important;" ><?=$linhaLotes['numLote']?><?=$linhaLotes['loteExt']?></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['idAcervo']?></td>
        <td style="color:#787878 !important;" ><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
        <td style="color:#787878 !important;" ><?=$linhaLot['descricao']?></td>
        <td style="color:#787878 !important;" >R$ <?=$linhaLot['valor']?></td>
        <td style="color:#787878 !important;" ><?
        $queryArre = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_POST['id']."' and lote = '".$linhaLotes['numLote']."' order by lote asc";
        $resultadoArre = mysql_query($queryArre);
		if (mysql_num_rows($resultadoArre)!=0) {
	    $linhaArr = mysql_fetch_array($resultadoArre);
		
			$queryLot = "Select * from lotesLeiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_POST['id']."' and numLote = '".$linhaArr['lote']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
		
			$queryAc = "Select * from acervo where idPeca = '".$linhaLot['idPeca']."'";
			$resultadoAc = mysql_query($queryAc);
			$linhaAc = mysql_fetch_array($resultadoAc);
		
			$queryComp = "Select * from compradores where idCadastro = '".$linhaArr['idComprador']."'";
			$resultadoComp = mysql_query($queryComp);
			$linhaComp = mysql_fetch_array($resultadoComp);
			
			
		
		?><?=$linhaArr['cartela']?> - <?=$linhaComp['nome']?><? }?></td>
        <td style="color:#787878 !important;" align="center" >R$ <?=number_format($linhaArr['valor'], 2, ',', '.')?></td>
        <td style="color:#787878 !important;" align="center" >R$ <? $comissao = ($linhaArr['valor']*$linhaArr['comissao'])/100;
			echo  number_format($comissao, 2, ',', '.');
			?></td>
        <td style="color:#787878 !important;" align="center" >R$ <?
        	if($linhaAc['tipoComissao'] == "normal"){
				  $totalGaleria = (($linhaArr['valor']*$linhaAc['comissao'])/100);
			  }elseif($linhaAc['tipoComissao'] == "overprice"){
				  $totalGaleria = ($linhaArr['valor']-$linhaAc['overprice']);
			  }
			  echo number_format($totalGaleria, 2, ',', '.');
		
		?></td>
      </tr>
      <?
	  $valorTotalArremate = $valorTotalArremate+$linhaArr['valor'];
	  $valorTotalComissaoLeiloeiro = $valorTotalComissaoLeiloeiro+$comissao;
	  $valorTotalGaleria = $totalGaleria+$valorTotalGaleria;
		  }
	  }else{
	  ?>
      <tr bgcolor="#fffdea">
        <td colspan="9" style=" border-right:none !important; color:#787878 !important;"><em>Nenhum lote cadastrado...</em></td>
        </tr>
    
    <? }?>
   		<tr bgcolor="#fffdea">
        <td style="color:#787878 !important; border-right:none;" >&nbsp;</td>
        <td style="color:#787878 !important; border-right:none;"" >&nbsp;</td>
        <td style="color:#787878 !important; border-right:none;"" >&nbsp;</td>
        <td style="color:#787878 !important; border-right:none;"" >&nbsp;</td>
        <td style="color:#787878 !important; border-right:none;"" >&nbsp;</td>
        <td style="color:#787878 !important;" align="right" >Saldo Financeiro:</td>
        <td style="color:#787878 !important;" align="center" >R$ <?=number_format($valorTotalArremate, 2, ',', '.')?></td>
        <td style="color:#787878 !important;" align="center">R$ <?=number_format($valorTotalComissaoLeiloeiro, 2, ',', '.')?></td>
        <td style="color:#787878 !important;" align="center">R$ <?=number_format($valorTotalGaleria, 2, ',', '.')?></td>
      </tr>
    </table>
    <? }?>
    </div>
</div>
<? if($_GET['op'] == "cadok"){?>
<div id="message" align="center" style="z-index:100">
Leilão cadastrado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altstok"){?>
<div id="message" align="center" style="z-index:100">
Estatus do leilão alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
<? if($_GET['op'] == "altok"){?>
<div id="message" align="center" style="z-index:100">
Leilão alterado com sucesso! <br /><br />
<input type="button" value="X Fechar" name="close_button" id="close_button" onclick="javascript:fechaMessage();">
</div>
<? }?>
</body>
</html>
