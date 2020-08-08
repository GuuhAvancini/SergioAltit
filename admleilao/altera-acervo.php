<?php 
include("seguranca.php"); // Inclui o arquivo com o sistema de seguran�a
if ($_SESSION['codigoCliente'] == ""){header("Location: index.php");}


$query = mysql_query("UPDATE `acervo` SET `descricao` = '".str_replace("\n",'<br />', addslashes(htmlspecialchars($_POST['descricao'])))."', `valor` = '".$_POST['valor']."', `tipoComissao` = '".$_POST['tipoComissao']."', `comissao` = '".$_POST['comissao']."', `overprice` = '".$_POST['overprice']."', `localizacaoPeca` = '".$_POST['localizacaoPeca']."', `iphan` = '".$_POST['iphan']."', obsImp = '".$_POST['obsImp']."', website = '".$_POST['website']."', artista = '".$_POST['artista']."', categoria = '".$_POST['categoria']."' WHERE `idPeca` = '".$_GET['idPeca']."' ") or die(mysql_error());


$queryEc = "Select * from acervo where idPeca = '".$_GET['idPeca']."'";
$resultadoEc = mysql_query($queryEc);
$linhaEc = mysql_fetch_array($resultadoEc);

$linhalog = "- ".date('d/m/Y - H:m:s')." - Usu�rio: ".$_SESSION['usuarioNome']." - Alterou os dados da pe�a: ".$linhaEc['descricao'].".\n";
escrevelog($linhalog,$_SESSION['codigoCliente']);



if($_GET['pagina'] == "acervo"){
header("Location: acervo.php?op=altok");
}elseif($_GET['pagina'] == "leilao"){
header("Location: lotes-leilao.php?op=altok&id=".$_GET['id']."");
}else{
header("Location: view-acervo.php?op=altok&idPeca=".$_GET['idPeca']."");
}
?>

