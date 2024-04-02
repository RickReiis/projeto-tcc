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
$pesquisa2 = mysql_query("SELECT * FROM fornecedores  JOIN enderecos ON (enderecos.idendereco = fornecedores.idendereco)  JOIN dados_bancarios ON (dados_bancarios.iddados_bancarios = fornecedores.iddados_bancarios) WHERE idfornecedor='$id'");
while ($row = mysql_fetch_array($pesquisa2)) 
{
  $banco = $row['banco'];
  $agencia = $row['agencia'];
  $conta_corrente = $row['conta_corrente'];
  $rua = $row['rua'];
  $numero = $row['numero'];
  $bairro = $row['bairro'];
  $cidade = $row['cidade'];
  $cep = $row['cep'];
  $estado = $row['estado'];
  $razao_social = $row['razao_social'];
  $tipo_empresa = $row['idtipo_fornecedor'];
  $regime_tributacao = $row['regime_tributacao'];
  $inscricao_municipal = $row['inscricao_municipal'];
  $inscricao_estadual = $row['inscricao_estadual'];
  $cnpj = $row['cnpj'];
  $telefone = $row['telefone'];
  $email = $row['email'];
  $pessoa_contato = $row['pessoa_contato'];
  $site = $row['site'];
  $avaliacao = $row['idavaliacao'];
  $descricao = $row['descricao'];
  $palavra_chave = $row['palavra_chave'];
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
  </style>
  <script type="text/javascript">
    function verificaNumero (e)
    {
      if (e.which != 8 && e.which != 0 && (e.which <48 || e.which > 57)) 
      {
        return false;
      }
    }
    $ (document) .ready(function() {
        $("cnpj") .keypress (verificaNumero);
    }) ;
    
        function FormataCnpj (evt) {
          vr = (navigator.appName == 'Netscape') ?evt.target.value : evt.srcElement.value;
                  if (vr.length == 2) vr = vr+"."; 
                  if (vr.length == 6) vr = vr+"."; 
                  if (vr.length == 10) vr = vr+"/"; 
                  if (vr.length == 15) vr = vr+"-";
            return vr;
        
    }


      function verificaNumero (e)
    {
      if (e.which != 8 && e.which != 0 && (e.which <48 || e.which > 57)) 
      {
        return false;
      }
    }
    $ (document) .ready(function() {
        $("cep") .keypress (verificaNumero);
    }) ;
    
        function FormataCep (evt) {
          vr = (navigator.appName == 'Netscape') ?evt.target.value : evt.srcElement.value;
                  if (vr.length == 5) vr = vr+"-"; 
            return vr;
        
    }

       function verificaNumero (e)
    {
      if (e.which != 8 && e.which != 0 && (e.which <48 || e.which > 57)) 
      {
        return false;
      }
    }
    $ (document) .ready(function() {
        $("telefone") .keypress (verificaNumero);
    }) ;
    
        function FormataTelefone (evt) {
          vr = (navigator.appName == 'Netscape') ?evt.target.value : evt.srcElement.value;
                  if (vr.length == 0) vr = vr+"(";
                  if (vr.length == 3) vr = vr+") ";
                  if (vr.length == 9) vr = vr+"-";
                  return vr;
        
    }


    function verificaNumero (e)
    {
      if (e.which != 8 && e.which != 0 && (e.which <48 || e.which > 57)) 
      {
        return false;
      }
    }
    $ (document) .ready(function() {
        $("estadual") .keypress (verificaNumero);
    }) ;
    
        function FormataEstadual (evt) {
          vr = (navigator.appName == 'Netscape') ?evt.target.value : evt.srcElement.value;
                  if (vr.length == 3) vr = vr+"."; 
                  if (vr.length == 7) vr = vr+"."; 
                  if (vr.length == 11) vr = vr+"."; 
                  return vr;
        
    }
  </script>
</head>


<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a class="logo">
          <span class="logo-mini"></span>
          <span class="logo-lg"><b>Fornecedores</b></span>
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
          Editar Fornecedor
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row" id="resultado">
          <div class="col-xs-12">
            <section class="content">
              <!-- Default box -->
              <form method="post" action="enviar.php?acao=editarfornecedor&id=<?php echo $id; ?>" class="form-group">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title"> Dados Bancarios</h3>
                  </div>
                  <div class="box-body ">
                    <div class="form-group">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Banco:</label>
                          <input type="text" name="banco" class="form-control" value="<?php echo $banco; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Agência:</label>
                          <input type="text" name="agencia" class="form-control" value="<?php echo $agencia; ?>">
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label>Conta corrente:</label>
                          <input type="text" name="conta_corrente" class="form-control" value="<?php echo $conta_corrente; ?>">
                        </div>
                      </div>    
                    </div>
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Endereço</h3>
                  </div>
                  <div class="box-body">
                    <div class="col-sm-6">     
                      <div class="form-group">
                        <label>Rua:</label>
                        <input type="text" name="rua" class="form-control" value="<?php echo $rua; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Numero:</label>
                        <input type="text" name="numero" class="form-control" value="<?php echo $numero; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Bairro:</label>
                        <input type="text" name="bairro" class="form-control" value="<?php echo $bairro; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Cidade:</label>
                        <input type="text" name="cidade" class="form-control" value="<?php echo $cidade; ?>" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>CEP:</label>
                        <input type="text" name="cep" class="form-control" value="<?php echo $cep; ?>" required id="cep"  maxlength="9" onkeypress="this.value = FormataCep (event)" onpaste = " return false;">
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label>Estado:</label>
                        <input type="text" name="estado" class="form-control" value="<?php echo $estado; ?>" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Dados Fornecedor</h3>
                  </div>
                  <div class="box-body">
                    <div class="form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Razão Social:</label>
                          <input type="text" name="razao_social" class="form-control" value="<?php echo $razao_social; ?>" required>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Tipo da empresa:</label>
                          <select name="tipo_empresa" class="form-control">
                          <option value="0">Selecione um Tipo</option>
                          <?php
                            $ss = mysql_query("SELECT * FROM tipo_fornecedor");
                            while ($li = mysql_fetch_array($ss)) {
                              $s1 = "";
                                if ($li['idtipo_fornecedor'] == $tipo_empresa) {
                                  $s1 = "selected";
                                }
                          ?>
                          <option value="<?php echo $li['idtipo_fornecedor']?>" <?php echo $s1;?>><?php echo $li['tipo']?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Regime de tributação:</label>
                          <input type="text" name="regime_tributacao" class="form-control" value="<?php echo $regime_tributacao; ?>">
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Inscrição Municipal:</label>
                          <input type="text" name="inscricao_municipal" class="form-control" value="<?php echo $inscricao_municipal; ?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Inscrição Estadual:</label>
                          <input type="text" name="inscricao_estadual" class="form-control" value="<?php echo $inscricao_estadual; ?>" id="estadual" maxlength="15" onkeypress="this.value = FormataEstadual (event)" onpaste = " return false;">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>CNPJ:</label>
                          <input type="text" name="cnpj" class="form-control" value="<?php echo $cnpj; ?>" required id="cnpj" maxlength="18" onkeypress="this.value = FormataCnpj (event)" onpaste = " return false;">
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Telefone:</label> 
                          <input type="text" name="telefone" class="form-control" value="<?php echo $telefone; ?>" id="telefone"  maxlength="15" onkeypress="this.value = FormataTelefone (event)" onpaste = " return false;">
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>E-mail:</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Pessoa de Contato:</label>
                          <input type="text" name="pessoa_contato" class="form-control" value="<?php echo $pessoa_contato; ?>">
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Site:</label>
                          <input type="text" name="site" class="form-control" value="<?php echo $site; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12 col-sm-6 col-md-3 ">
                        <div class="form-group">
                          <label>Palavra-chave</label><br>
                          <input type="text" name="palavra" value="<?php echo $palavra_chave;?>" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Avaliação:</label><br>
                          <select class="form-control" name="avaliacao">
                            <?php
                              $sql1 = mysql_query("SELECT * FROM avaliacoes");
                              while ($row1 = mysql_fetch_array($sql1)) {
                                $s = "";
                                if ($row1['idAvaliacao'] == $avaliacao) {
                                  $s = "selected";
                                }
                              ?>
                              <option value="<?php echo $row1['idAvaliacao']; ?>" <?php echo $s; ?>><?php echo $row1['merito'];?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-md-6 ">
                        <div class="form-group">
                          <label>Descrição:</label><br>
                          <textarea name="descricao" cols="10" style="max-width:100%; max-height: 150px;" class="form-control"><?php echo $descricao ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12 col-sm-12">
                        <button class="btn btn-primary btn-md pull-right">Atualizar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </section>
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