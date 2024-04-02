<?php
require_once "config.php";
session_start();
if ((isset($_SESSION['email']) == false) OR (isset($_SESSION['senha']) == false))
{
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  header('location:login.php');
}


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Usuarios | Administrador </title>
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
<link rel="stylesheet" type="text/css" href="style.css">

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
        Usuários
        <small>Já Posso Ensinar!</small>
      </h1><br>
    </section>
    <section>

      <!-- Default box -->
      <div class="box">
        
        <div class="box-body">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Nome</th>
              <th>Turma</th>
              <th>Foto</th>
              <th>Email</th>
              <th>Telefone</th>
              <th>Matéria</th>
              <th>Saberes</th>
              <th>Status</th>

            </tr>
            </thead>
            <tbody>
            <?php
                include"config.php";
                $sql = mysql_query("SELECT usuario.idusuario, usuario.usuario, usuario.turma, usuario.email, usuario.telefone, usuario.foto, usuario.materia,saberes.nome, usuario.status FROM usuario, saberes WHERE usuario.saberes_idsaberes = saberes.idsaberes order by idusuario asc");
                if (mysql_num_rows($sql)>0) 
                {
                  while($row=mysql_fetch_object($sql))
                  {
            ?>
                    <tr>
                      <td><?php echo $row->idusuario;?></td>
                      <td><?php echo $row->usuario;?></td>
                      <td><?php echo $row->turma;?></td>
                      <td><?php echo "<img src='/Projeto/fotos/".$row->foto."' style='width: 50px; height: 50px;' />";?></td>
                      <td><?php echo $row->email;?></td>
                      <td><?php echo $row->telefone;?></td>
                      <td><?php echo $row->materia;?></td>
                      <td><?php echo $row->nome;?></td>
                      <td>



                      <?php
                        $status = $row->status;
                        if ($status == 1) 
                        {
                          echo '<span class="label label-success">valido</span></td>';
                        }
                        else
                        {
                          echo '<span class="label label-danger">invalido</span></td>';
                        }
                      ?>
                      <td>
                          

                          <a href="controle.php?excluirform&id=<?php echo $row->idusuario; ?>"><span class="glyphicon glyphicon-remove" style="color:red;">
                          </span></a>
                          <a href="editarusu.php?id=<?php echo $row->idusuario;?>"><span class="glyphicon glyphicon-pencil" style="color:black">
                          </span></a>

                      </td>
                    </tr> 
            <?php
                  }
                }
            ?>
            

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        
      </div>
      <!-- /.box -->

    </section>
  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer" style="margin-top:-20px;">
    <div class="pull-right hidden-xs" >
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
