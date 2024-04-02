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
  <title>Perfil | Já Posso Ensinar!</title>
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
<body class=" skin-yellow sidebar-mini">

 
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="perfil.php" class="logo">
      <span class="logo-lg"><b>Administrador</b></span> 
    </a>
      <nav class="navbar navbar-static-top">
       <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
       <h4 align="right" style="margin-right: 20px;" ><a href="controle.php?logout" style="color:black; ">
       <i class="glyphicon glyphicon-log-out" style="color:black; margin-right: 7px; "></i>SAIR</a></h4>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
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
        <li><a href="sugestao.php"><i class="glyphicon glyphicon-comment"></i> <span>Sugestões</span></a></li>
        <li><a href="administrador.php"><i class="glyphicon glyphicon-user"></i> <span>Administradores</span></a></li>
        <li><a href="cadastrar.php"><i class="glyphicon glyphicon-plus"></i> <span>Adicionar administrador</span></a></li>

        
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
        Já Posso Ensinar!
      </h1>
    </section>
    <section class="content">

      <!-- Default box -->
      <div class="breadcrumb">
        <div class="box-header with-border">
          <h2 class="box-title">Olá, seja bem-vindo <?php echo "$logado" ?></h2>
        </div>
        
       <center> <img src="imagens/principal.png"></center> 
         
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <i>ImaginAção</i>
    </div>
    <strong>Copyright &copy; 2017</strong> <b><i>Já Posso Ensinar!</i></b>
  </footer>
  
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
