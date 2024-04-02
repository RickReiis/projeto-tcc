<?php 
include_once("config.php");

$acao = addslashes($_GET['acao']);

	if ($acao == 'recuperar_senha') {
		$email = addslashes(trim($_POST['emailRecupera']));		

		$consultaUsuarioDB = mysql_query("SELECT * FROM administrador WHERE email = '$email'");	

		if (mysql_num_rows($consultaUsuarioDB) <= 0) {
				echo "<script>alert('E-mail não cadastrado no sistema!');history.back();</script>";
		} else {
			while ($dadosUsuarioDB = mysql_fetch_array($consultaUsuarioDB)) {
				
				$nome = utf8_decode($dadosUsuarioDB['nome']);
				$senha = utf8_decode($dadosUsuarioDB['senha']);

				$email_enviar = utf8_decode("Ensinar");
				$assunto = "Recuperar Senha";

				$fromMail = "From: $email_enviar";

				$extensaoEmail = explode('@', $dadosUsuarioDB['email']);

				if ($extensaoEmail[1] == 'hotmail.com') {
					$fromMail = "From: ".$nome." <".$email_enviar.">";
				} else if ($extensaoEmail[1] == 'gmail.com') {
					$fromMail = "From: $email_enviar";
				} else {
					$fromMail = "From: $email_enviar";
				}

				$cabecalho = 'MIME-Version: 1.0' . "\r\n";
				$cabecalho .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
				$cabecalho .= "Return-Path: $email_enviar \r\n";
				$cabecalho .= "$fromMail \r\n";
				$cabecalho .= "Reply-To: $email_enviar \r\n";

				$mensagem = utf8_decode("

				<div style='width: 100%; background: #e08e0b; text-align: center; padding: 7px;'>

					<h3 style='color: #fff;'>Já posso ensinar - Recuperação de Senha</h3>

				</div>

				<div style='width: 100%; background: #fff; text-align: center; padding: 7px;'>

					<p style='color: #000 !important;'>
						Foi feita a solitição de recuperação de senha para o email<br /><b><span style='display: none;'>--</span>".$email."<span style='display: none;'>--</span></b><br/><br/>
						Veja a seguir o email e a sua senha para fazer o acesso ao sistema.
					</p>

					<p style='color: #000 !important;'>
						Email: <b><span style='display: none;'>--</span><span style='color: #000;'>".$email."</span><span style='display: none;'>--</span></b>
					</p>

					<p style='color: #000 !important;'>
						Senha: <b><span style='display: none;'>--</span><span style='color: #000;'>".$senha."</span><span style='display: none;'>--</span></b>
					</p>

				</div>

				");

				if (mail($email, $assunto, $mensagem, $cabecalho)) {
                    echo "<script>alert('Senha recuperada com sucesso, verifique seu E-mail!');history.back();</script>";
				}
			}
		}
	}

?>