<?
//  Configurações do Script
// ==============================
$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['servidor'] = 'localhost';    // Servidor MySQL
$_SG['usuario'] = 'hairpsp_hair';          // Usuário MySQL
$_SG['senha'] = 'pspq1w2e3';                // Senha MySQL
$_SG['banco'] = 'hairpsp_hair';            // Banco de dados MySQL
$_SG['tabela'] = 'logadmin';       // Nome da tabela onde os usuários são salvos
// ==============================
// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================
// Verifica se precisa fazer a conexão com o MySQL
if ($_SG['conectaServidor'] == true) {
$_SG['link'] = mysql_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."].");
mysql_select_db($_SG['banco'], $_SG['link']) or die("MySQL: Não foi possível conectar-se ao banco de dados [".$_SG['banco']."].");
}

$query = mysql_query("INSERT INTO contatosSite (data, nome, email, telefone, celular, cidade, estado, mensagem) VALUES ('".date('d/m/Y - H:m:s')."', '".$_POST['nome']."', '".$_POST['email']."', '".$_POST['telefone']."', '".$_POST['celular']."', '".$_POST['cidade']."', '".$_POST['estado']."', '".$_POST['mensagem']."')") or die(mysql_error());

$conteudoEmail = "Contato enviado pelo site - Hair Transplante SP<br><br>Dados preenchidos:<br><br>Nome: ".$_POST['nome']."<br>E-mail: ".$_POST['email']."<br>Telefone: ".$_POST['telefone']."<br>Celular: ".$_POST['celular']."<br>Cidade: ".$_POST['cidade']." - Estado: ".$_POST['estado']."<br><br>Mensagem:<br>".$_POST['mensagem']."";
			
$cabecalho = "From: ".$_POST['nome']."<envia@hairtransplantesp.com.br>\nReply-To: ".$_POST['email']."\nContent-type: text/html; charset=utf-8";
mail("evandro@hairtransplantesp.com.br", "Contato enviado pelo site - Hair Transplante SP", $conteudoEmail, $cabecalho);
mail("rafael@hadnet.com.br", "Contato enviado pelo site", $conteudoEmail, $cabecalho);

header("Location: /entre-em-contato-clinica-transplante-capilar/?op=ok");

?>