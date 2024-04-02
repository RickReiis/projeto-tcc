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

  $id = $_GET['id'];
  $sql = mysql_query("SELECT *, date_format(compras.data, '%d/%m/%Y') AS data FROM compras INNER JOIN fornecedores ON (compras.idfornecedor = fornecedores.idfornecedor) WHERE idcompra = '$id'");
  while ($row1 = mysql_fetch_array($sql)) {
    $arquivo = $row1['arquivo_xml'];
    $data = $row1['data'];
    $hora = $row1['hora'];
    $fornecedor = $row1['razao_social'];
    $id_f = $row1['idfornecedor'];
  }
  $sql2 = mysql_query("SELECT *, date_format(produtos.data, '%d/%m/%Y') AS data_e FROM compras INNER JOIN produtos ON (compras.idcompra = produtos.idcompra) WHERE compras.idcompra = '$id'") or die(mysql_error());
  $sql3 = mysql_query("SELECT *, date_format(servicos.data_emissao, '%d/%m/%Y') AS data_e FROM compras INNER JOIN servicos ON (compras.idcompra = servicos.idcompra) WHERE compras.idcompra = '$id'");
  if (mysql_num_rows($sql2)>=1) {
    $titulo = "Produtos";
    $most = "<table class='table'><tbody><tr><th>Nome</th><th>Quantidade</th><th>Valor</th></tr>";
    $num = mysql_num_rows($sql2);
      while ($row2 = mysql_fetch_array($sql2)) {
        $nota = $row2['nota_fiscal'];
        $most .= "<tr><td>".$row2['nome']."</td><td>".$row2['quantidade']."</td><td>".$row2['valor']."</td></tr>";
        $dat = $row2['data_e'];
        $num--;
      }
    $most .= "</tbody></table>";
    $pad = "";
    $data_e = "<div class='col-sm-12'><label>Data de Emissão:</label> ".$dat."</div>";
  }
  elseif (mysql_num_rows($sql3)>=1) {
    $titulo = "Serviço";
    $row2 = mysql_fetch_array($sql3);
    $nota = $row2['nota'];
    $most = "<div class='col-sm-12'><label>Descrição:</label> ".$row2['descriminacao']."</div><div class='col-sm-12'><label>Valor:</label> ".$row2['valor']."</div><div class='col-sm-12'><label>Alíquota:</label> ".$row2['aliquota']."</div><div class='col-sm-12'><label>Valor Iss:</label> ".$row2['vlss']."</div><div class='col-sm-12'><label>Valor Liquido:</label> ".$row2['vLiquido']."</div><div class='col-sm-12'><label>Código de verificação:</label> ".$row2['cod_verificacao']."</div>";
    $pad = "style='padding:0;'";
    $data_e = "<div class='col-sm-12'><label>Data de Emissão:</label> ".$row2['data_e']."</div>";
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
    .btn-danger, .btn-danger.focus, .btn-danger:hover
{
   background-color: #d9534f !important;
   border-color: #d9534f;
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
          Informações da Compra
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row" id="resultado">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header">
                <div class="box-header">
                    <h3 class="box-title">
                      <label>&nbsp<?php echo $titulo; ?></label>
                    </h3>
                    <div class="pull-right">
                        <a class="btn btn-danger btn-xs pull-right" href="pdf2.php?id=<?php echo $id; ?>" target="blank" title="PDF"><i class="fa fa-file-pdf-o"></i></a>
                        <?php 
                          if ($status == 2) {
                            echo "<a class='btn btn-default btn-xs pull-right' href='enviar.php?acao=excluir_compra&idc=".$id."&for=".$id_f."' title='EXCLUIR'><i class='fa fa-trash-o'></i></a>";
                          }
                        ?>
                        <a class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#myModalNorm" title="EDITAR"><i class="fa fa-pencil"></i></a>
                      </div>
                </div>
                <div class="col-sm-12"><label>Fornecedor:</label> <?php echo $fornecedor ?></div><div class="col-sm-12"><label>Nota Fiscal:</label> <?php echo $nota; ?></div><?php echo $data_e; ?>
                <!-- /.box-header -->
                <div class="box-header" <?php echo $pad; ?>>
                  <?php echo $most ?>
                </div>
                <div class="box-header">
                  <ul class="mailbox-attachments clearfix">
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa  fa-file"></i></span>
                      <div class="mailbox-attachment-info">
                        <span class="mailbox-attachment-name"> 
                          <?php 
                            if ($arquivo == null) {
                              echo "Cadastrado sem Nota!";
                            }
                            else {
                              echo $arquivo;
                            }
                          ?>
                          <a href="download.php?com=<?php echo $id;?>&for=<?php echo $id_f;?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="pull-right"><label>Data:</label> <?php echo $data; ?> &nbsp  <label>Hora:</label> <?php echo substr($hora, 0, 5); ?></div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
               <form role="form" method="post" action="enviar.php?acao=atcompra" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputPassword1" class="form-control">Selecionar arquivo</label>
                  <input type="text" name="fornecedor" value="<?php echo $id_f; ?>" style="display:none;">
                  <input type="text" name="compra" value="<?php echo $id; ?>" style="display:none;">
                  <input type="file" id="exampleInputPassword1" name="arquivo" style="display:none;" />
                </div>
                <input type="submit" id="but" style="display:none;">
              </form>   
            </div>
            <div class="modal-footer">
              <label class="btn btn-primary" for="but">Atualizar</label>
            </div>
          </div>
        </div>
      </div>
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