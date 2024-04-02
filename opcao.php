<?php

require_once "conexao.php";
require_once "enviar.php";
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
  <title>Histórico de Compras</title>
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
    .red{
      color: red;
    }
    #exampleInputPassword1
    {
      display: none;
    }
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
  </style>
</head>


<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a class="logo">
          <span class="logo-mini"></span>
          <span class="logo-lg">Histórico de Compras</span>
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
                    <a class="list-group-item" href="teste.php">Perfil</a>
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
              <a href="perfil.php" style="color: #3c8dbc;">Editar <i class="fa fa-pencil"></i></a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">

        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li><a href="fornecedores.php"><i class="fa fa-book"></i> <span>Fornecedores</span></a></li>
          <?php 
            if ($status == 2) {
          ?>
          <li><a href="tipo_fornecedor.php" style="color: #28547F"><i class="fa fa-book"></i> <span>Tipo de fornecedores</span></a></li>
          <li><a href="usuarios.php"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
          <?php
          }
          ?>
          <li><a href="historico_compras.php"><i class="fa fa-history"></i> <span>Histórico de compras</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Tabela de Compras
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row" id="resultado">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header">
                <div class="form-group pull-left">
                  <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalNorm" title="Registrar Compra"><i class="fa fa-plus"></i>   Compra</button>
                </div>
                <div class="form-group pull-right">
                  <?php
                  $tabela = null;
                  if (isset($_POST['pesq']) && isset($_POST['datai']) && isset($_POST['dataf'])) {
                      $pesq = $_POST['pesq'];
                      $datai = $_POST['datai'];
                      $dataf = $_POST['dataf'];
                      if(empty($pesq)){
                        if (empty($datai)) {
                          if (empty($dataf)) {
                            //se todos os campos estiverem vasios deve-se exucutar o código abaixo
                            $tabela = historico1(0, $datai, $dataf, 0);
                            //se todos os campos estiverem vasios deve-se exucutar o código acima
                          }
                          else{
                            //se só o campo da data final não estiver vasio deve-se executar o código abaixo
                            $tabela = historico1(1, $datai, $dataf, 0);
                            //se só o campo da data final não estiver vasio deve-se executar o código acima
                          }
                        }
                        else{
                          if (empty($dataf)) {
                            //se só o campo da data inicial não estiver vasio deve-se executar o código abaixo
                             $tabela = historico1(2, $datai, $dataf, 0);
                          //se só o campo da data inicial não estiver vasio deve-se executar o código acima
                          }
                          else{
                            #se só o campo de pesquisa estiver vasio deve-se executar o código abaixo
                             $tabela = historico1(3, $datai, $dataf, 0);
                          #se só o campo de pesquisa estiver vasio deve-se executar o código acima
                          }
                        }
                      }
                      else{
                        if (empty($datai)) {    
                          if (empty($dataf)) {
                            #se só os dois campos de data estiverem vasios deve-se executar o código abaixo
                             $tabela = historico2(0, $pesq, $datai, $dataf, 0);
                            #se só os dois campos de data estiverem vasios deve-se executar o código acima
                          }
                          else{
                          #se só o campo da data inicial estiver vasio deve-se excutar o código abaixo   
                          $tabela = historico2(1, $pesq, $datai, $dataf, 0);
                          #se só o campo da data inicial estiver vasio deve-se excutar o código acima
                          }
                        }
                        else{
                          if (empty($dataf)) {
                          #se só o campo da data final estiver vasio deve-se excutar o código abaixo 
                          $tabela = historico2(2, $pesq, $datai, $dataf, 0);                   
                          #se só o campo da data final estiver vasio deve-se excutar o código acima
                          }
                          else{
                          #se nenhum dos campos estiverem vasios deve-se excutar o código  abaixo
                          $tabela = historico2(3, $pesq, $datai, $dataf, 0);           
                          #se nenhum dos campos estiverem vasios deve-se excutar o código  acima
                          }
                        }
                      }
                    }
                    else{
                      #se não ouver pesquisa deve-se executar o código abaixo
                      $tabela = historico1(0, 0, 0, 0);
                      #se não ouver pesquisa deve-se executar o código acima
                    }
                  ?>
                  <a class="btn btn-danger btn-md" title="Gerar PDF" href="pdf.php?tabela=<?php echo $tabela; ?>" target="new"><i class="fa fa-file-pdf-o"></i></a> 
                </div>
                <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" 
                           data-dismiss="modal">
                               <span aria-hidden="true">&times;</span>
                               <span class="sr-only">Close</span>
                        </button>
                      </div>
                      <div class="modal-body">  
                         <form role="form" method="post" action="enviar.php?acao=regcompra" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Empresa:</label><br>
                            <select class="form-control" name="fornecedor">
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
                          <div class="form-group">
                            <label for="exampleInputPassword1" class="form-control">Selecionar arquivo</label>
                            <input type="file" id="exampleInputPassword1" name="arquivo"/>
                          </div>
                          <input type="submit" id="but" style="display:none;">
                        </form>   
                      </div>
                      <div class="modal-footer">
                        <label class="btn btn-primary" for="but">Registrar</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-body">
                <form method="post" action="historico_compras.php" style="margin-left:-1.5%;">
                  <div class="col-md-3">
                    <label>Pesquisa</label>
                    <input type="text" class="search form-control" placeholder="Pesquise aqui produtos ou serviços" name="pesq">
                  </div>
                  <div class="col-md-3">
                    <label>Data inicial</label>
                    <input type="date" name="datai" class="form-control">
                  </div>
                  <div class="col-md-3">
                    <label>Data final</label>
                    <input type="date" name="dataf" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <label>Tipo de data</label>
                    <select class="form-control" name="t_data">
                      <option value="1">Data de registro</option>
                      <option value="2">Data de emissão</option>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <label style="visibility:hidden;">Enviar</label>
                    <input type="submit" name="Pesquisar" class="form-control">
                  </div>
                </form>
                <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered results">
                     <?php
                      if (isset($_POST['pesq']) && isset($_POST['datai']) && isset($_POST['dataf'])) {
                      $pesq = $_POST['pesq'];
                      $datai = $_POST['datai'];
                      $dataf = $_POST['dataf'];
                        if(empty($pesq)){
                          if (empty($datai)) {
                            if (empty($dataf)) {
                              #se todos os campos estiverem vasios deve-se exucutar o código abaixo
                              echo historico1(0, $datai, $dataf, 0);
                              #se todos os campos estiverem vasios deve-se exucutar o código acima
                            }
                            else{
                              #se só o campo da data final não estiver vasio deve-se executar o código abaixo
                              echo historico1(1, $datai, $dataf, 0);
                            #se só o campo da data final não estiver vasio deve-se executar o código acima
                            }
                          }
                          else{
                            if (empty($dataf)) {
                              #se só o campo da data inicial não estiver vasio deve-se executar o código abaixo
                              echo historico1(2, $datai, $dataf, 0);
                            #se só o campo da data inicial não estiver vasio deve-se executar o código acima
                            }
                            else{
                              #se só o campo de pesquisa estiver vasio deve-se executar o código abaixo
                              echo historico1(3, $datai, $dataf, 0);
                            #se só o campo de pesquisa estiver vasio deve-se executar o código acima
                            }
                          }
                        }
                        else{
                          if (empty($datai)) {    
                            if (empty($dataf)) {
                              #se só os dois campos de data estiverem vasios deve-se executar o código abaixo
                              echo historico2(0, $pesq, $datai, $dataf, 0);
                              #se só os dois campos de data estiverem vasios deve-se executar o código acima
                            }
                            else{
                            #se só o campo da data inicial estiver vasio deve-se excutar o código abaixo
                            echo historico2(1, $pesq, $datai, $dataf, 0);
                            #se só o campo da data inicial estiver vasio deve-se excutar o código acima
                            }
                          }
                          else{
                            if (empty($dataf)) {
                            #se só o campo da data final estiver vasio deve-se excutar o código abaixo
                            echo historico2(2, $pesq, $datai, $dataf, 0);                   
                            #se só o campo da data final estiver vasio deve-se excutar o código acima
                            }
                            else{
                            #se nenhum dos campos estiverem vasios deve-se excutar o código  abaixo
                            echo historico2(3, $pesq, $datai, $dataf, 0);           
                            #se nenhum dos campos estiverem vasios deve-se excutar o código  acima
                            }
                          }
                        }
                    }
                    else{
                      #se não ouver pesquisa deve-se executar o código abaixo
                      echo historico1(0, 0, 0, 0);
                      #se não ouver pesquisa deve-se executar o código acima
                    }
                   ?>
                 </table>
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

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->
</body>
</html>