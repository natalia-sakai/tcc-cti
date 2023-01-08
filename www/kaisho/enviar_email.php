<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <title>Sr Kaisho</title>
        <script src='https://code.jquery.com/jquery-3.1.0.min.js'></script>
        <script type="text/javascript" src="./main.js"></script>
	</head>
	<body>
    <?php
		$nome =$_POST['name'];
		$em = $_POST['email'];
		$tel = $_POST['phone'];
		$cidade = $_POST['city'];
		
        // Define os dados técnicos da Mensagem
        require_once("./phpmailer/class.phpmailer.php");
        require_once("./phpmailer/class.smtp.php");
        $mail = new PHPMailer();
		$mail->IsSMTP();// Define que a mensagem será SMTP
		$mail->SMTPDebug = 1; // usar o valor '1' ou '2' para ativar e mostrar na tela possíveis erros; usar o valor '0' para desativar.
		$mail->SMTPAuth = true;	
		$mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP
		$mail->Port = 465;
		$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
        $mail->Username = 'srkaisho@gmail.com'; // Usuário do servidor SMTP
        $mail->Password = 'deliveryjapa'; // Senha do servidor SMTP
   
		$mail->SetFrom('srkaisho@gmail.com','Sr Kaishó'); //Remetente

        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
        $mail->Subject  = "Novo franqueado"; // Assunto da mensagem
        
        
		// Define os destinatário(s)
		$mail->AddAddress('leev.fernandes@gmail.com', '');

		//Corpo da mensagem
		$mail->Body .= "Nome: ".$nome."<br>Email: ".$em."<br>Telefone: ".$tel."<br>Cidade: ".$cidade;
		

        $enviado = $mail->Send();

		// Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        // Exibe uma mensagem de resultado
        if ($enviado) 
        {
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.html?enviado'>";
        } 
        else 
        {
            echo "<script type='text/javascript'>";
            echo "alert('Erro ao enviar email');";
            echo "</script>";

            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.html'>";
        }

    ?>
    </body>
</html>