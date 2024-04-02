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

if (isset($_GET['tb'])) {
  $tb = $_GET['tb'];
  if ($tb == "b") {
    $tab = "d";
    $cad = "fa-lock";
    $st = 0;
  }
  else {
    $tab = "b";
    $cad = "fa-unlock-alt";
    $st = 1;
  }
}
else {
  $tab = "b";
  $cad = "fa-unlock-alt";
  $st = 1;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="logo.png" type="image/x-icon"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Fornecedores</title>
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
  <script type="text/javascript">
  function tab(a) {
    a = a.value.toLowerCase();
    var c1 = document.getElementsByClassName('p');
    var c2 = document.getElementsByClassName('p2');
    var ta = document.getElementById('ta');
    var tr = ta.getElementsByClassName('e');
    var num1 = tr.length;
    var abc = 0;
    for (i=0; i<= num1-1; i++) {
      var str = c1[i].innerText.toLowerCase();
      var str2 = c2[i].innerText.toLowerCase();
      if(str.match(a) || str2.match(a)){
        tr[i].style.display = "table-row";
        abc ++; 
      }
      else {
        tr[i].style.display = "none";
      }
    }
    if(abc==0){
      document.getElementById('result0').style.display = 'table-row';
    }
    else{
      document.getElementById('result0').style.display = 'none';
    }
  }
  </script>
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
    @media (min-width: 412px){
      .ab2{
        width: 200px;
      }
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
          <span class="logo-lg">Fornecedores</span>
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
              <a href="perfil.php" style="color: #28547F">Editar <i class="fa fa-pencil"></i></a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">

        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li><a href="fornecedores.php" style="color: #28547F"><i class="fa fa-truck"></i> <span>Fornecedores</span></a></li>
          <?php 
            if ($status == 2) {
          ?>
          <li><a href="tipo_fornecedor.php" style="color: #28547F"><i class="fa fa-book"></i> <span>Tipo de fornecedores</span></a></li>
          <li><a href="usuarios.php" style="color: #28547F"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
          <?php
          }
          ?>
          <li><a href="historico_compras.php" style="color: #28547F"><i class="fa fa-history"></i> <span>Histórico de compras</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <a href="fornecedores.php?tb=<?php echo $tab;?>" class="btn btn-primary btn-md" ><i class="fa <?php echo $cad;?>"></i></a>
          Tabela de Fornecedores
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row" id="resultado">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header">
                <a href="cadastrar_fornecedores.php"><button class="btn btn-primary btn-md"><i class="fa fa-plus"></i>  Fornecedor</button></a>
                <div class="form-group pull-right ab2 col-xs-7">
                  <input type="text" class="search form-control" onkeyup="tab(this)" placeholder="Pesquise aqui...">
                </div>
                <span class="counter pull-right"></span>
                <div class="box-body table-responsive no-padding" style="width:100%;">
                  <table class="table table-hover table-bordered results" id="ta">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Distância</th>
                        <th>Avaliação</th>
                        <th>Ações</th>
                        <th style="display:none;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $consulta = mysql_query("SELECT * FROM fornecedores JOIN enderecos ON (enderecos.idendereco = fornecedores.idendereco) WHERE fornecedores.status = '$st' ORDER BY(fornecedores.idavaliacao) DESC");
                        while ($row = mysql_fetch_array($consulta))
                        {
                          $statusF = $row['status'];
                          switch ($statusF) {
                            case 0:
                                $statusF = "fa fa-ban";
                                $funcao = "Desbloquear";
                                break;
                            case 1:
                                $statusF = "fa fa-check";
                                $funcao = "Bloquear";
                                break;
                          }
                          switch ($row['idavaliacao']) {
                              case 1:
                                  $avaliacao = "
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>";
                                  break;
                              case 2:
                                  $avaliacao = "
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>";
                              break;
                              case 3:
                                  $avaliacao = "
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>";
                                  break;
                              case 4:
                                  $avaliacao = "
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>";
                                  break;
                                  case 5:
                                  $avaliacao = "
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star-o text-yellow'></span>";
                                  break;
                                  case 6:
                                  $avaliacao = "
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>
                          <span class='fa fa-star text-yellow'></span>";
                                  break;
                          }
                      ?>
                      <tr class="e">
                        <td class="p"><?php echo $row['razao_social']; ?></td>
                        <td><?php echo $row['cnpj']; ?></td>
                        <td><?php echo $row['distancia']; ?></td>
                        <td><?php echo $avaliacao;?></td>
                        <td>
                          <a href="especificacoes_fornecedor.php?id=<?php echo $row['idfornecedor'];?>" title="Especificações"><i class="fa fa-search"></i></a>
                          <a href="editarfornecedor.php?id=<?php echo $row['idfornecedor'];?>" title="Editar"><i class="fa fa-pencil"></i></a> 
                          <a href="enviar.php?acao=statusF&id=<?php echo $row['idfornecedor'];?>" title="<?php echo $funcao;?>"><i class="<?php echo $statusF;?>"></i></a>
                        </td>
                        <td style="display:none;" class="p2"><?php echo $row['palavra_chave']; ?></td>
                      </tr>
                      <?php
                        }
                      ?>
                      <tr style="display:none;" id="result0">
                        <td colspan="5"><i class="fa fa-exclamation-triangle"></i><b> Nenhum Registro!</b></td>
                      </tr>
                    </tbody>
                  </table>
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

  <!-- Optionally, you can add Slimscroll and FastClick plugins.
       Both of these plugins are recommended to enhance the
       user experience. Slimscroll is required when using the
       fixed layout. -->
</body>
</html>