<?php
include"config.php"; 


//login
if (isset($_GET['logar']))
{
	//Start em uma sessao
	session_start();
	// Pegar os valores de login e senha
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	//Criar variavel que vai receber o retorno do select
	$sql = mysql_query("SELECT * FROM administrador WHERE email = '$email' and senha = '$senha'");

	if (mysql_num_rows($sql)>0) 
	{
		$_SESSION['email'] = $email;
		$_SESSION['senha'] = $senha;
		header('refresh:1; perfil.php');
	}
	else
	{
		$_SESSION['$email'] = $email;
		$_SESSION['$senha'] = $senha;
		echo "<script>alert('Usuario ou senha incorreto!');history.back();</script>";;
		header('refresh:1; login.php');
	}
}

//saida
if (isset($_GET['logout'])) 
{
	session_start();

	session_destroy();
	header("refresh:2; login.php");
}

//--------------------------------------------------SUGESTAO-------------------------------------------------------------------


//excluir
if (isset($_GET['excluirsug'])) 
{
	$idsugestao = $_GET['id'];
	$sql = mysql_query("DELETE FROM sugestao WHERE idsugestao='$idsugestao'");
	if ($sql) 
	{
		echo "<script>alert('Excluido com sucesso!');history.back();</script>";
		header("Refresh:1; sugestao.php");
	}
	else
	{
		echo "Falha ao excluir registro";
	}
}


//------------------------------------------------COMENTARIO----------------------------------------------------------------

////excluir
if (isset($_GET['excluircom'])) 
{
	$idcomentario = $_GET['id'];
	$sql = mysql_query("DELETE FROM comentario WHERE idcomentario='$idcomentario'");
	if ($sql) 
	{
		echo "<script>alert('Excluido com sucesso!');history.back();</script>";
		header("Refresh:1; comentarios.php");
	}
	else
	{
		echo "Falha ao excluir registro";
	}
}

//------------------------------------------------ADMIN----------------------------------------------------------------------
//cadastro

if (isset($_GET['cadastrar'])) 
{
   $nome = $_POST['nome'];
   $email = $_POST['email'];
   $senha = $_POST['senha'];
   $confirmar = $_POST['confirmar'];
   

      if(empty($nome) || empty($email) || empty($senha)|| empty($confirmar))

      {
         echo "<script>alert('Preencha todo os campos!');history.back();</script>";
         header("Refresh:1; cadastrar.php");

      }

      else

      {
         $query = mysql_num_rows(mysql_query(" SELECT * FROM administrador WHERE email = '$email'"));

         if ($query>=1)

         {
            echo "<script>alert('Email ja cadastrado!');history.back();</script>";
         }
         if ($confirmar == $senha) 
         {
         	$sql=mysql_query("INSERT INTO administrador(nome, email, senha) VALUES ('$nome', '$email','$senha')");

            if($sql>0)
            {
               echo "<script>alert('Cadastro efetuado com sucesso!');history.back();</script>";
               header(" administrador.php");

            }
         }

         else
         {
            echo "<script>alert('As senhas nao correspondem!');history.back();</script>";
         }

      }

}

//excluir
if (isset($_GET['excluiradm'])) 
{
	$idadministrador = $_GET['id'];
	$sql = mysql_query("DELETE FROM administrador WHERE idadministrador='$idadministrador' and idadministrador > 1");
	
	if ($sql) 
	{
		echo "<script>alert('Excluido com sucesso!');history.back();</script>";
		header("Refresh:1; administrador.php");
	}
	else
	{
		echo "<script>alert('Falha ao excluir registro!');history.back();</script>";
	}
	if ('$idadministrador' == 1) 
	{
		echo "<script>alert('Administrador padrão não pode ser excluido!');history.back();</script>";
	}
	
}
//editar
if (isset($_GET['editaradm'])) 
{
 	$idadministrador = $_GET['id'];
 	$email = $_POST['email'];
 	 	
 
 	$sql = mysql_query("UPDATE administrador SET email = '$email' where idadministrador = '$idadministrador' ");
 
 	if ($sql) 
 	{
 		echo"<script>alert('Registro atualizado com sucesso!');history.back();</script>";
 		header("Refresh:1; administrador.php");
 	}
 	else
 	{
 		echo "<script>alert('Erro ao atualizar registro.');history.back();</script>";
 	}
}

//--------------------------------------------------SOBRE----------------------------------------------------------------

if (isset($_GET['editarsobre'])) 
{
	
	$texto = $_POST['texto'];

	$sql = mysql_query("UPDATE `sobre` SET `texto`= '$texto' WHERE idsobre= 1;");

	if ($sql) 
	{
		echo"<script>alert('Registro atualizado com sucesso!');history.back();</script>";
		header(" sobre.php");
	}
	else
	{
		echo"<script>alert('Erro ao atualizar registro!');history.back();</script>";
	}
}


 // --------------------------- VALIDAR USUARIOS ----------------------------------//

//validar true
if (isset($_GET['validarform']))

{
	$status = $_GET['status'];

	$novo = 1;

	

	if ($status > 0) 
	{
		$sql = mysql_query("UPDATE usuario SET status = '$novo' WHERE  idusuario = '$status' ");

		echo "<script>alert('Sucesso ao validar usuario!');history.back();</script>";
		header("usuario.php");
	}
	else
	{
		echo "<script>alert('Falha ao validar usuario.');history.back();</script>";
	}


}
//--------------------------USUÁRIOS---------------------------------//

if (isset($_GET['excluirform']))

{
	$idusuario = $_GET['id'];
	$sql = mysql_query("DELETE FROM usuario WHERE idusuario='$idusuario'");
	if ($sql) 
	{
		echo "<script>alert('Registro excluido com sucesso!');history.back();</script>";
		header("Refresh:1; validados.php");
	}
	else
	{
		echo "Falha ao excluir registro";
	}

}
if (isset($_GET['editarform'])) 
{
 	$idusuario = $_GET['id'];
 	$usuario = $_POST['usuario'];
 	$turma = $_POST['turma'];
 	$email = $_POST['email'];
 	$telefone = $_POST['telefone'];
 	$materia = $_POST['materia'];
 	$saberes = $_POST['idsaberes'];
 	
 
 	$sql = mysql_query("UPDATE usuario SET usuario = '$usuario',
 	 turma= '$turma', email= '$email', telefone= '$telefone', materia= '$materia', 
 	 saberes_idsaberes = '$saberes' where idusuario= '$idusuario' ");
 
 	if ($sql) 
 	{
 		echo"<script>alert('Registro atualizado com sucesso!');history.back();</script>!";
 		header("Refresh:1; validados.php");
 	}
 	else
 	{
 		echo "<script>alert('Erro ao atualizar registro.');history.back();</script>";
 	}
}

//------------------------------GALERIA---------------------------------
if (isset($_GET['excluirfoto'])) 
{
	$idgaleria = $_GET['id'];
	$sql = mysql_query("DELETE FROM galeria WHERE idgaleria='$idgaleria'");
	if ($sql) 
	{
		echo "<script>alert('Registro excluido com sucesso!');history.back();</script>";
		header("Refresh:1; galeria.php");
	}
	else
	{
		echo "<script>alert('Falaha ao excluir imagem!');history.back();</script>";
	}
}
//----------------------------------------FUNDO------------------------------
if(isset($_GET['fundo']))
{
                
    // Recupera os dados dos campos
       
        $imagem = $_FILES["imagem"];



        // Se a foto estiver sido selecionada
        if (!empty($imagem["name"])) {
          
          // Largura máxima em pixels
          $largura = 1500;
          // Altura máxima em pixels
          $altura = 1800;
          // Tamanho máximo do arquivo em bytes
          $tamanho = 1000000;
       
          $error = array();
       
            // Verifica se o arquivo é uma imagem
            if(!preg_match("/^image\/(pjpeg|jpeg|png)$/", $imagem["type"])){
               $error[1] = "Isso não é uma imagem.";
            } 
        
          // Pega as dimensões da imagem
          $dimensoes = getimagesize($imagem["tmp_name"]);
        
          // Verifica se a largura da imagem é maior que a largura permitida
          if($dimensoes[0] > $largura) {
            $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
          }
       
          // Verifica se a altura da imagem é maior que a altura permitida
          if($dimensoes[1] > $altura) {
            $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
          }
          
          // Verifica se o tamanho da imagem é maior que o tamanho permitido
          if($imagem["size"] > $tamanho) {
              $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
          }
       
          // Se não houver nenhum erro
          if (count($error) == 0) {
          
            // Pega extensão da imagem
            preg_match("/\.(png|jpg|jpeg){1}$/i", $imagem["name"], $ext);
       
                // Gera um nome único para a imagem
                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
       
                // Caminho de onde ficará a imagem
                $caminho_imagem = "fotosfundo/" . $nome_imagem;
       
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);

            $sql = mysql_query("INSERT INTO fundo (imagem) VALUES ('".$nome_imagem."')");

            if ($sql){
              echo "<script>alert('Imagem cadastrada com sucesso!');</script>";
              header("Refresh:1; fundo.php");
            }
          }
          // Se houver mensagens de erro, exibe-as
          if (count($error) != 0) {
            foreach ($error as $erro) {
              echo $erro . "<br />";
            }
          }
        }
      }
//------------------------------------------------------RECUPERAÇÃO-----------------------------------------
if (isset($_GET['recuperar'])) 
{
	$email = $_POST['email'];
	//busca no db o usuario com o email 
	$result = mysql_query("SELECT * FROM administrador WHERE email='$email'");
	//conta quantos tem
	$num_rows = mysql_num_rows($result);
	//se tiver  + de 1 cadastrado
	if($num_rows=='1')
	{
		//faz um while para vc coloar os dados nas variavels
		while($Row_email = mysql_fetch_array($result))
		{
			$rowemail = $Row_email['email'];
			$rowsenha = $Row_email['senha'];
		}
			
		//enviar um email para variavel email juntamente com a variável senha;
		$mensage ="Você solicitou a recuperação de senhha confira seu dados.";
		$mensage .="E-mail= " . $rowemail;
		$mensage .="Senha:" . $rowsenha;
		mail($rowemail, "Já Posso Ensinar, recuperação de senha", $mensage);

		echo"<script>alert(Sua senha foi enviada para o e-mail indicado.),window.open('recuperar_senha_enviado.php','_self')</script>";
	}

	else
	{
		echo"<script>alert('E-mail não cadastrado em nosso sistema'),window.open('recuperar_senha.php','_self')</script>";
		
	}
}
?>
