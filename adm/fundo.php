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
  <title> Fundo | Administrador </title>
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
      <nav class="navbar navbar-static-top"> <h4 align="right" style="margin-right: 20px;" ><a href="controle.php?logout" style="color:black; ">
    <i class="glyphicon glyphicon-log-out" style="color:black; margin-right: 7px; "></i>SAIR</a></h4>
      <!-- Sidebar toggle button-->
      
    </nav>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- pesquisa -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Pesquisa...">
              <span class="input-group-btn">
                <button type="submit" name="pesquisa" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU ADMINISTRATIVO</li>

        <li><a href="usuario.php"><i class="glyphicon glyphicon-user"></i> <span>Validar usuários</span></a></li>
        <li><a href="validados.php"><i class="glyphicon glyphicon-user"></i> <span>Usuários</span></a></li>
        <li><a href="saberes.php"><i class="glyphicon glyphicon-book"></i> <span>Saberes</span></a></li>
        <li><a href="sobre.php"><i class="glyphicon glyphicon-edit"></i> <span>Sobre</span></a></li>
        <li><a href="galeria.php"><i class="glyphicon glyphicon-picture"></i> <span>Galeria</span></a></li>
        <li><a href="fundo.php"><i class="glyphicon glyphicon-picture"></i> <span>Fundo</span></a></li>
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
        Fundo
        <small>Já Posso Ensinar!</small>
      </h1><br>
    </section>
        <section>

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
<form method="post" enctype="multipart/form-data" action="controle.php?fundo" >
Inserir imagem:<br>

<input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="imagem"><br>
<button type="submit" class="btn btn-info" name="cadastrar">Atualizar</button>
</form>
</body>
</html>
<?php
include"config.php"; 

  $sql = mysql_query("SELECT * FROM fundo");
   
  // Exibe a imagem
  while ($fundo = mysql_fetch_object($sql)) 
  {
?>
        <div id="principal" >
        <figure class="img-thumbnail" style="float:left; margin: 10px;  width:280px;
          height:280px; ">
              <?php
                echo "<img src='fotosfundo/".$fundo->imagem."' style='width: 280px; height: 280px; padding: 10px;' alt='Responsive image'  /><br />";
              ?>

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
    <div class="pull-right hidden-xs">
      <i>ImaginAção</i>
    </div>
    <strong>Copyright &copy; 2017</strong> <b><i>Já Posso Ensinar!</i></b>
  </footer>


<div class="control-sidebar-bg"></div>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
