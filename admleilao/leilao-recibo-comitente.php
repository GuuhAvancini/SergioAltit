<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usuário: ".$_SESSION['usuarioNome']." - Visualizou o relatório de venda por compradores.\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);

$queryCs = "Select * from leiloes where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."'";
$resultadoCs = mysql_query($queryCs);
$linha = mysql_fetch_array($resultadoCs);

class clsTexto 
{
	public static function removerFormatacaoNumero( $strNumero )
    {
 
        $strNumero = trim( str_replace( "R$", null, $strNumero ) );
 
        $vetVirgula = explode( ",", $strNumero );
        if ( count( $vetVirgula ) == 1 )
        {
            $acentos = array(".");
            $resultado = str_replace( $acentos, "", $strNumero );
            return $resultado;
        }
        else if ( count( $vetVirgula ) != 2 )
        {
            return $strNumero;
        }
 
        $strNumero = $vetVirgula[0];
        $strDecimal = mb_substr( $vetVirgula[1], 0, 2 );
 
        $acentos = array(".");
        $resultado = str_replace( $acentos, "", $strNumero );
        $resultado = $resultado . "." . $strDecimal;
 
        return $resultado;
 
    }
 
    public static function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
    {
 
        $valor = self::removerFormatacaoNumero( $valor );
 
        $singular = null;
        $plural = null;
 
        if ( $bolExibirMoeda )
        {
            $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
        else
        {
            $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
            $plural = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        }
 
        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
 
 
        if ( $bolPalavraFeminina )
        {
 
            if ($valor == 1) 
            {
                $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }
            else 
            {
                $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
            }
 
 
            $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
 
 
        }
 
 
        $z = 0;
 
        $valor = number_format( $valor, 2, ".", "." );
        $inteiro = explode( ".", $valor );
 
        for ( $i = 0; $i < count( $inteiro ); $i++ ) 
        {
            for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ ) 
            {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }
 
        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $rt = null;
        $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
        for ( $i = 0; $i < count( $inteiro ); $i++ )
        {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
 
            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count( $inteiro ) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ( $valor == "000")
                $z++;
            elseif ( $z > 0 )
                $z--;
 
            if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
 
            if ( $r )
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }
 
        $rt = mb_substr( $rt, 1 );
 
        return($rt ? trim( $rt ) : "zero");
 
    }
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$_SESSION['clienteNome']?></title>
<link rel="stylesheet" href="myAuction.css" type="text/css" />
<style type="text/css">
.break { page-break-before: always; }
</style>
</head>

<body>
<?
$queryLotes = "Select DISTINCT idComitente from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' order by lote asc";
      $resultadoLotes = mysql_query($queryLotes);
	  if (mysql_num_rows($resultadoLotes)!=0) {
		  while ($linhaLotes = mysql_fetch_array($resultadoLotes)) {
			  
			   $ValorTotal = 0;
			  $valorcomissaoTotal = 0;
			  $ValorLiquido = 0;
?>
<table width="100%" border="0">
  <tr>
    <td width="12%"><img src="images/logoSergio.jpg" width="79" height="100" /></td>
    <td width="88%"><div id="tituloRelatorio" align="center">Recibo de Peças Vendidas - Comitente<br />Leilão: <?=$linha['idLeilaoN']?> - <?=$linha['descricao']?> - <?=$linha['dataLeilao']?> - <?=$linha['horario']?></div></td>
  </tr>
</table>
<br />
<?
	  
			  
			$queryEc = "Select * from comitentes where idCadastro = '".$linhaLotes['idComitente']."'";
			$resultadoEc = mysql_query($queryEc);
			$linhaEc = mysql_fetch_array($resultadoEc);
			
	  ?>
      <div  >Comitente: <?=$linhaEc['nome']?><br />Telefone: <?=$linhaEc['telefone']?> - Celular: <?=$linhaEc['celular']?> - E-mail: <?=$linhaEc['email']?><br /></div>
  <br />
<table width="100%" border="0" style="font-size:12px;">
      <?
	  
	  $queryLotesB = "Select * from arremates where codigoCliente = '".$_SESSION['codigoCliente']."' and idLeilaoN = '".$_GET['id']."' and idComitente = '".$linhaLotes['idComitente']."' order by lote asc";
      $resultadoLotesB = mysql_query($queryLotesB);
	  if (mysql_num_rows($resultadoLotesB)!=0) {
		  while ($linhaLotesB = mysql_fetch_array($resultadoLotesB)) {
			  
			$queryLot = "Select * from acervo where idPeca = '".$linhaLotesB['idPeca']."'";
			$resultadoLot = mysql_query($queryLot);
			$linhaLot = mysql_fetch_array($resultadoLot);
			
			$tipoComissao = $linhaLot['tipoComissao'];
			$comissaoPeca = $linhaLot['comissao'];
			$overPrice = $linhaLot['overprice'];
			
			
			
	  ?>
        <tr>
          <td width="7%" valign="top">LOTE: <?=$linhaLotesB['lote']?><?=$linhaLotesB['loteExt']?></td>
          <td width="5%" valign="top"><img src="fotos/<? 
	if ($linhaLot['foto'] == ""){
		echo "1400782209_photo.png";
	}else{
		echo $linhaLot['foto'];}?>" width="52" height="56" /></td>
          <td width="43%" valign="top">Descrição do Lote:<br />
          <?=$linhaLot['descricao']?></td>
          <td width="42%" valign="top">
            Valor do Lance: R$ <?=number_format($linhaLotesB['valor'], 2, ',', '.')?><br />
            Comissão: R$ 
          <? 
		  	
		  	if($tipoComissao == "normal"){
				
				$comissao = ($linhaLotesB['valor']*$comissaoPeca)/100;
				
			}
			if($tipoComissao == "overprice"){
				
				$comissao = $linhaLotesB['valor']-$overPrice;
				
			}
		  
		  
		  
			echo  number_format($comissao, 2, ',', '.');
			?> &nbsp;&nbsp;&nbsp; Total à receber: R$ <?=number_format($linhaLotesB['valor']-$comissao, 2, ',', '.')?></td>
        </tr>
        <? 
		$ValorTotal = $ValorTotal+$linhaLotesB['valor'];
		$valorcomissaoTotal = $valorcomissaoTotal+$comissao;
		}}
		$ValorLiquido = $ValorTotal-$valorcomissaoTotal;
		?>
        
      </table>
      <br />
<table width="324" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td width="179" bgcolor="#F8F8F8">Total de arremata&ccedil;&atilde;o: </td>
    <td width="119" bgcolor="#F8F8F8">R$
      <?=number_format($ValorTotal, 2, ',', '.')?></td>
  </tr>
  <tr>
    <td bgcolor="#F8F8F8">Comiss&atilde;o Leiloeiro: </td>
    <td bgcolor="#F8F8F8">R$ 
      <?=number_format($valorcomissaoTotal, 2, ',', '.')?></td>
  </tr>
  <tr>
    <td bgcolor="#F8F8F8">Total à Receber:</td>
    <td bgcolor="#F8F8F8">R$ 
      <? echo number_format($ValorLiquido, 2, ',', '.');
	  ?></td>
  </tr>
</table>
<p>Eu, <?=$linhaEc['nome']?>, recebi da <?=$_SESSION['clienteNome']?> a import&acirc;ncia de R$

<?=number_format($ValorLiquido, 2, ',', '.')?> 
(<?=clsTexto::valorPorExtenso(number_format($ValorLiquido, 2, ',', '.'), true, false);?>) referente a venda em leilão do(s) iten(s) acima relacionado(s).</p>
<p>&nbsp;</p><p>&nbsp;</p>
  <table width="100%">
<tr>
  <td><hr  width="250" align="left" style="margin-bottom:-20px;"/><br />
  <?=$linhaEc['nome']?></td>
  <td><hr  width="250" align="left" style="margin-bottom:-20px;"/><br />
  <?=$_SESSION['clienteNome']?></td>
  </tr>
  </table>
<p><br /><br /><br />Data: _______/_______________/________
</p>
<p class="break"></p>
<? }}?>
</body>
</html>
