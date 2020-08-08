<? //include("seguranca.php");

@$conteudo = "Lance Prévio enviado pelo site - Ag Escritorio de Arte<br><br>Leilao:".$_POST['leilao']."<br>Lote: ".$_POST['lote']."<br><br>Nome: ".$_POST['nome']."<br>E-mail: ".$_POST['email']."<br>Telefone: ".$_POST['telefone']."<br><br>Valor do Lance: R$ ".$_POST['valor']."<br>Tipo de lance: ".$_POST['tipo']."";

// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: contato@agescritoriodearte.com.br\r\n"; // remetente
$headers .= "Return-Path: ".$_POST['email']."\r\n"; // return-path

$envio = mail("rafael@hadnet.com.br", "Lance Previo pelo site - Sergio Altit", $conteudo, $headers);
$envio = mail("contato@agescritoriodearte.com.br", "Lance Previo pelo site - Ag Escritorio de Arte", $conteudo, $headers);
 
if($envio)
 header("Location: view-leilao.php?op=ok&id=".$_GET['id']."");
 //echo "Mensagem enviada";
else
 echo "A mensagem não pode ser enviada";
?>