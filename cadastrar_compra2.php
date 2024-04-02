<?php ob_start();?>
<?php

require_once "conexao.php";
session_start();
if ((isset($_SESSION['email']) == false) OR (isset($_SESSION['senha']) == false))
{
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  header('location:index.php');
}
$emaillogado = $_SESSION['email'];
$senhalogado = $_SESSION['senha'];
$bla = mysql_fetch_array(mysql_query("SELECT * FROM usuarios WHERE email = '$emaillogado' AND senha = '$senhalogado'"));
$_SESSION['status'] = $bla['status'];
$nomelogado = $_SESSION['nome'];
$status = $_SESSION['status'];
if ($status != 0) {
  
}
else {
  unset($_SESSION['email']);
  unset($_SESSION['senha']);
  unset($_SESSION['nome']);
  unset($_SESSION['status']);
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="logo.png" type="image/x-icon"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Registrar compra</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="starterstyle.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <style type="text/css">
    #sidebar{
      background-color: #ecf0f5;
    }

    #sidebar .sidebar-menu a{ 
        background-color: #ecf0f5;
        color: #3c8dbc;
    }

    #sidebar .sidebar-menu a:hover{
      background-color: #e2e3e4;
    }

    #sidebar .pull-left {
      color: #000;
    }

    #sidebar .pull-left #status{
      color: #3c8dbc;
    }

    .content-wrapper{
      background-color: #222d32;
    }

    .content-wrapper h1{
      color: #fff;
    }
    .main-footer {
      background-color: #222d32;
      color: #fff; 
    }
    .col-md-12.e{
      margin-bottom:2px;
    }
    .col-md-12.e:hover{
      background-color: #f5f5f5;
    }
  </style>
</head>


<body class="hold-transition skin-blue sidebar-mini" id="pai">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a class="logo">
          <span class="logo-mini"></span>
          <span class="logo-lg"><b>Registrar Compras</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $nomelogado; ?> &nbsp<i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu" role="menu" style="width: 50px;">
                    <a class="list-group-item" href="perfil.php">Perfil</a>
                    <a class="list-group-item" href="enviar.php?acao=logout">Sair</a>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
    </header>
    <aside class="main-sidebar" id="sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="logo.png" class="img-rounded">
          </div>
          <div class="pull-left info">
          <p><?php echo $nomelogado;?></p>
              <a href="perfil.php" style="color: #28547F;">Editar <i class="fa fa-pencil"></i></a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">

        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li><a href="fornecedores.php" style="color: #28547F;"><i class="fa fa-truck"></i> <span>Fornecedores</span></a></li>
          <?php 
            if ($status == 2) {
          ?>
          <li><a href="tipo_fornecedor.php" style="color: #28547F"><i class="fa fa-book"></i> <span>Tipo de fornecedores</span></a></li>
          <li><a href="usuarios.php" style="color: #28547F;"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
          <?php
          }
          ?>
          <li><a href="historico_compras.php" style="color: #28547F;"><i class="fa fa-history"></i> <span>Histórico de compras</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Registrar Compra
        </h1>
        <a href="cadastrar_compra.php" class="pull-right" style="font-size:11pt; color:#fff;" >Ir para Produtos</a>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row" id="resultado">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header">
                <form id="fds" method="post" action="enviar.php?acao=regcompra3">
                  <div class="col-md-12" style="padding:0;">
                    <div class="col-md-12">
                      <h2>Serviço</h2>                      
                    </div>
                    <div class="form-group col-md-4" style="">
                      <label>Fornecedor</label>
                      <select class="form-control col-md-" name="fornecedor">
                        <option value="0">Selecionar fornecedor</option>
                        <?php
                        $pesqui = mysql_query("SELECT * FROM fornecedores");
                        while ($row = mysql_fetch_array($pesqui)) {
                        ?>
                        <option value="<?php echo $row['idfornecedor']; ?>"><?php echo $row['razao_social'];?></option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="form-group col-md-4" style="">
                      <label>Data de emissão</label>
                      <input type="date" name="data_emissao" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Nota fiscal</label>
                      <input type="text" name="nota" class="form-control" placeholder="Nº Nota Fiscal" required>
                    </div>
                  </div>
                  <div class="col-md-12" style="padding:0;">
                    <div class="form-group col-md-4">
                      <label>Código de verificação</label>
                      <input type="text" name="cod_ver" class="form-control" placeholder="Código de Verificação" required>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Valor</label>
                      <input type="text" name="v" class="form-control" placeholder="Valor" required>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Alíquota</label>
                      <input type="text" name="al" class="form-control" placeholder="Alíquota" required>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Valor Iss</label>
                      <input type="text" name="vi" class="form-control" placeholder="Valor Iss" required>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Valor líquido</label>
                      <input type="text" name="vl" class="form-control" placeholder="Valor Líquido" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label>Descrição</label>
                      <textarea class="form-control" name="desc" style="max-width:100%; max-height: 150px;" required>Descrição</textarea>
                    </div>
                  </div>
                  <input type="submit" style="display: none;" id="but">
                </form>
                <div class="col-md-12">
                  <label class="btn btn-primary pull-right" for="but">Registrar</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <center><strong>Copyright © 2017 <a href="https://pt-br.facebook.com/maristairacacio" target="_blank">Centro Educacional Marista Irmão Acácio</a>.</strong> All rights
      reserved.</center>
    </footer>
  </div>
  <!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>

</body>
</html>