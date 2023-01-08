<?php
session_start();
setlocale(LC_CTYPE,"pt_BR");
function sendMail($para,$de,$mensagem,$assunto){
//DADOS SMTP
$smtp    = "empresasnainternet.com.br"; //      < ---- Alterar o smtp
$usuario = "teste@empresasnainternet.com.br"; //      < ---- Alterar o email
$senha   = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"; //      < ---- Alterar a senha
// NAO ALTERAR
require_once 'smtp/smtp.php';
$mail = new smtp;
$mail->Delivery('relay');
$mail->Relay($smtp, $usuario, $senha, 465, 'login', true);
$mail->TimeOut(10);
$mail->Priority('high');
$mail->From($de);
$mail->AddTo($para);
$mail->Html($mensagem);
	if($mail->Send($assunto)){

		//echo "MENSAGEM ENVIADA COM SUCESSO";
		$_SESSION['feedback'] = "MENSAGEM ENVIADA COM SUCESSO";
		header ("Location: index.php");
		//return true;
	}else {

		//echo "MENSAGEM FALHOU AO SER ENVIADA, TENTE MAIS TARDE";
		$_SESSION['feedback'] = "MENSAGEM FALHOU AO SER ENVIADA, TENTE MAIS TARDE";
		header ("Location: index.php");
		//return false;
	}
} 

	// Recebe os valores mandado pelo formulario
	$empresa        = $_POST['empresa'];
	$pessoa_contato = $_POST['pessoa_contato'];
	$telefone       = $_POST['telefone'];
	$telefone_alternativo = $_POST['telefone_alternativo'];
	$email          = $_POST['email'];
	$assunto        = $_POST['assunto'];
	$observacao     = $_POST['observacao'];
	
// Variavel guarda todo o html com a informações que será o corpo do email
$corpo='
<html>
<head>
<title>Contato</title>
</head>
<body>
  <table width="700" border="1">
      <tr>
        <td><label id="lb_empresa">Empresa:</label></td>
        <td>'.$empresa.'</td>
        <td><label>Pessoa de Contato:</label></td>
        <td>'.$pessoa_contato.'</td>
      </tr>
      <tr>
        <td><label>DDD+Telefone:</label></td>
        <td>'.$telefone.'</td>
        <td><label>Telefone Alternativo:</label></td>
        <td>'.$telefone_alternativo.'</td>
      </tr>
      <tr>
        <td><label>Email:</label></td>
        <td>'.$email.'</td>
        <td><label>CEP:</label></td>
        <td>'.$assunto.'</td>
      </tr>
      <tr>
        <td><label>OBS:</label></td>
        <td colspan="3">'.$observacao.'</td>
      </tr>
    </table>
</body>
</html>';


// Chama a função para enviar o email.
// Ex: sendMail("Email que recebe","Email que envia","Corpo do email","Titulo do email");
sendMail($email,"atendimento@empresasnainternet.com.br",$corpo,'Formulário de Contato'); // < ---- Alterar os dados de envio do email

?>
