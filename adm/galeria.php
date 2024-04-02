<?php
require_once "config.php";
session_start();
if ((isset($_SESSION['email']) == false) OR (isset($_SESSION['senha']) == false))
{
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  header('location:login.php');
}

$logado = $_SESSION['email'];


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Galeria | Administrador </title>
  <link rel="shortcut icon" href="imagens/favicon.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="adminlte-2.3.11/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte-2.3.11/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="adminlte-2.3.11/dist/css/skins/_all-skins.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-yellow sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="perfil.php" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Administrador</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"> 
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
    <h4 align="right" style="margin-right: 20px;" ><a href="controle.php?logout" style="color:black; ">
    <i class="glyphicon glyphicon-log-out" style="color:black; margin-right: 7px;  "></i>SAIR</a></h4>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- pesquisa -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU ADMINISTRATIVO</li>

        <li><a href="usuario.php"><i class="glyphicon glyphicon-user"></i> <span>Validar usuários</span></a></li>
        <li><a href="validados.php"><i class="glyphicon glyphicon-user"></i> <span>Usuários</span></a></li>
        <li><a href="saberes.php"><i class="glyphicon glyphicon-book"></i> <span>Saberes</span></a></li>
        <li><a href="sobre.php"><i class="glyphicon glyphicon-edit"></i> <span>Sobre</span></a></li>
        <li><a href="galeria.php"><i class="glyphicon glyphicon-picture"></i> <span>Galeria</span></a></li>
        <li><a href="fundo.php"><i class="glyphicon glyphicon-picture"></i> <span>Plano de Fundo</span></a></li>
        <li><a href="comentarios.php"><i class="glyphicon glyphicon-comment"></i> <span>Comentarios</span></a></li>
        <li><a href="sugestao.php"><i class="glyphicon glyphicon-comment"></i> <span>Sugestôes</span></a></li>
        <li><a href="administrador.php"><i class="glyphicon glyphicon-user"></i> <span>Administradores</span></a></li>
        <li><a href="cadastrar.php"><i class="glyphicon glyphicon-plus"></i> <span>Adicionar Administrador</span></a></li>

        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Galeria
        <small>Já Posso Ensinar!</small>
      </h1><br>
    </section>
    <section>

      <!-- Default box -->
      <div class="box">
        
                    <div class="box-body">
            <form method="post" enctype="multipart/form-data" name="cadastro" >
            Legenda:<br />
            <textarea class="form-control" id="exampleTextarea" rows="4" cols="40" name="descricao"></textarea>
            <br>
            Inserir imagem:<br />
            <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="foto"><br>
            <button type="submit" class="btn btn-info" name="cadastrar">Adicionar</button>
            </form>
            </body>
            </html>
            <?php
            include"config.php"; 
            // Se o usuário clicou no botão cadastrar efetua as ações
            if (isset($_POST['cadastrar'])) {
              
              // Recupera os dados dos campos
              $descricao = $_POST['descricao'];
              $foto = $_FILES["foto"];
              
              // Se a foto estiver sido selecionada
              if (!empty($foto["name"])) {
                
                // Largura máxima em pixels
                $largura = 1500;
                // Altura máxima em pixels
                $altura = 1800;
                // Tamanho máximo do arquivo em bytes
                $tamanho = 1000000;
             
                $error = array();
             
                  // Verifica se o arquivo é uma imagem
                  if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
                     $error[1] = "<script>alert('Isso não é uma imagem ou não é aceita!');history.back();</script>";
                  } 
              
                // Pega as dimensões da imagem
                $dimensoes = getimagesize($foto["tmp_name"]);
              
                // Verifica se a largura da imagem é maior que a largura permitida
                if($dimensoes[0] > $largura) {
                  $error[2] = "<script>alert('A largura da imagem não deve ultrapassar ".$largura." pixels!');history.back();</script>";
                }
             
                // Verifica se a altura da imagem é maior que a altura permitida
                if($dimensoes[1] > $altura) {
                  $error[3] = "<script>alert('A largura da imagem não deve ultrapassar ".$altura." pixels!');history.back();</script>";
                }
                
                // Verifica se o tamanho da imagem é maior que o tamanho permitido
                if($foto["size"] > $tamanho) {
                    $error[4] = "<script>alert('A imagem deve ter no máximo ".$tamanho." bytes!');history.back();</script>";
                }
             
                // Se não houver nenhum erro
                if (count($error) == 0) {
                
                  // Pega extensão da imagem
                  preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
             
                      // Gera um nome único para a imagem
                      $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
             
                      // Caminho de onde ficará a imagem
                      $caminho_imagem = "fotos/" . $nome_imagem;
             
                  // Faz o upload da imagem para seu respectivo caminho
                  move_uploaded_file($foto["tmp_name"], $caminho_imagem);
                
                  // Insere os dados no banco
                  $sql = mysql_query("INSERT INTO galeria (descricao, foto) VALUES ('$descricao','".$nome_imagem."')");
                
                  // Se os dados forem inseridos com sucesso
                  if ($sql){
                    echo "<script>alert('Imagem cadastrada com sucesso!');</script>";
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
            ?>
            <?php
            // Seleciona as imagens e ordena por id
            $sql = mysql_query("SELECT * FROM galeria ORDER BY idgaleria DESC");
             
            // Exibe as imagens
            while ($galeria = mysql_fetch_object($sql)) {
            ?>
            <div id="principal" >
            <figure class="img-thumbnail" style="float:left; margin: 10px; width:250px;
                  height:260px; ">
            <a style="float: right;" href="controle.php?excluirfoto&id=<?php echo $galeria->idgaleria; ?>"><span class="glyphicon glyphicon-remove" style="color:red;"></a>
            <?php
              echo "<img src='fotos/".$galeria->foto."' style='width: 240px; height: 200px; padding: 10px;' alt='Responsive image' class='float-left' /><br />";
            ?>
              <figcaption>
              <p><?php echo "<div class='text-center'><div class='text-center'><b><small> " . $galeria->descricao . "<br /><br /> </small></b></div></div>";?></p>
              </figcaption>
              </figure>
              </div>
            <?php
            }
            ?>

                    </div>
                    <!-- /.box-body -->
                    
                  </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <footer class="main-footer" style="margin-top:-20px;">
    <div class="pull-right hidden-xs" >
      <i>ImaginAção</i>
    </div>
    <strong>Copyright &copy; 2017</strong> <b><i>Já Posso Ensinar!</i></b>
  </footer>
  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="adminlte-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="adminlte-2.3.11/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="adminlte-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="adminlte-2.3.11/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="adminlte-2.3.11/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="adminlte-2.3.11/dist/js/demo.js"></script>
</body>
</html>
