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
$a = mysql_fetch_array(mysql_query("SELECT * FROM usuarios WHERE email = '$emaillogado' AND senha = '$senhalogado'"));
$_SESSION['status'] = $a['status'];
$idusuario = $a['idusuario'];
$matriculalogado = $a['matricula'];
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
  <title>Perfil</title>
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
<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>

  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>

  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js"></script>
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

    .btn-info[disabled] {
    background-color: #28547F;
    border-color: #28547F;
    }

    .btn-info[disabled]:hover {
    background-color: #28547F;
    border-color: #28547F;
    } 

    .btn-info.focus, .btn-info:focus, .btn-info.active, .btn-info:active {
    color: #fff;
    background-color: #28547F;
    border-color: #28547F;
  }

  .btn-info:hover, .btn-info:active, .btn-info.hover {
    background-color: #28547F;
 }
  
  .btn-info.active.focus, .btn-info.active:focus, .btn-info.active:hover, .btn-info:active.focus, .btn-info:active:focus, .btn-info:active:hover, .open>.dropdown-toggle.btn-info.focus, .open>.dropdown-toggle.btn-info:focus, .open>.dropdown-toggle.btn-info:hover {
    color: #fff;
    background-color: #28547F;
    border-color: #28547F;
}


  </style>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#senha').bootstrapValidator({
        fields: {
          nova_senha: {
            validators: {
              notEmpty: {
                message: 'Sua senha é obrigatória!'
              },
              stringLength: {
                min: 8,
                message: 'A senha deve ter no mínimo 8 caracteres!'
              }   
            }
          },

            confirme_senha: {
            validators: {
            notEmpty: {
            message: 'Você precisa confirmar sua senha!'
            },
            identical: {
            field: 'nova_senha',
            message: 'A senha está diferente!'
                }
              }
            },
            senha_atual: {
            validators: {
            notEmpty: {
            message: 'Digite a senha atual!'
                    },
            stringLength: {
            min: 8,
            message: 'A senha deve ter no mínimo 8 caracteres!'
                   }     
                }
            }
        }
      });
    });


$(document).ready(function() {
$('#form_matricula').bootstrapValidator({
fields: {
        matricula: {
        validators: {
        notEmpty: {
        message: 'Sua matricula é obrigatória!'
                  },
        stringLength: {
        min: 5,
        message: 'A matricula deve ter no mínimo 5 caracteres!'
                      }   
                  }
                }
              }
          });
      });

$(document).ready(function() {
$('#form_nome').bootstrapValidator({
fields: {
        nome: {
        validators: {
        notEmpty: {
        message: 'Seu nome é obrigatório!'
                },
        stringLength: {
        min: 5,
        message: 'O nome deve ter no mínimo 5 caracteres!'
                    }   
                  }
                }
              }
          });
      });

$(document).ready(function() {
$('#form_email').bootstrapValidator({
fields: {
        email: {
        validators: {
        notEmpty: {
        message: 'Seu E-mail é obrigatório!'
                    },
        emailAddress: {
        message: 'Digite um E-mail válido!'
                    }
                  }
                }
              }
          });
      });

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
          Perfil
        </h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row" id="resultado">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"> Dados Perfil</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label>Nome:</label><label class="pull-right" style="color: #3c8dbc;"><a href="" data-toggle="modal" data-target="#FormNome">Editar <i class="fa fa-pencil"></i></a></label>
                  <input type="text" class="form-control" disabled=""  value="<?php echo $nomelogado; ?>">
                </div>
                <div class="modal fade" id="FormNome" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>                      
                      <!-- Modal Body -->
                      <div class="modal-body">                        
                          <form id="form_nome" role="form" method="post" action="enviar.php?acao=editar_nome&id=<?php echo $idusuario ?>">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Nome:</label>
                                <input id="nome" type="text" class="form-control" name="nome" value="<?php echo $nomelogado; ?>" onkeyup="teste_nome()"/>
                            </div>
                          </form>                                  
                      </div>
                      <div class="modal-footer">
                          <button disabled="" class="btn btn-info" type="submit" disabled="" id="btn_nome" onclick="document.getElementById('form_nome').submit();">
                              Atualizar
                          </button>                    
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Email:</label><label class="pull-right" style="color: #3c8dbc;"><a href="" data-toggle="modal" data-target="#FormEmail">Editar <i class="fa fa-pencil"></i></a></label>
                  <input type="text" class="form-control" disabled="" value="<?php echo $emaillogado; ?>">
                </div>
                <div class="modal fade" id="FormEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="form_email" role="form" method="post" action="enviar.php?acao=editar_email&id=<?php echo $idusuario ?>">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email:</label>
                              <input id="email" onkeyup="teste_email()" type="text" class="form-control" name="email" value="<?php echo $emaillogado; ?>" />
                          </div>          
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button disabled="" id="btn_email" class="btn btn-info" type="submit" onclick="document.getElementById('form_email').submit();">
                          Atualizar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Matricula:</label><label class="pull-right" style="color: #3c8dbc;"><a href="" data-toggle="modal" data-target="#FormMatricula">Editar <i class="fa fa-pencil"></i></a></label>
                  <input type="text" class="form-control" disabled="" value="<?php echo $matriculalogado; ?>">
                </div>
                <div class="modal fade" id="FormMatricula" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="form_matricula" role="form" method="post" action="enviar.php?acao=editar_matricula&id=<?php echo $idusuario; ?>">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Digite sua matricula:</label>
                            <input onkeyup="teste_matricula()" id="matricula" type="text" class="form-control" name="matricula" value="<?php echo $matriculalogado; ?>" />
                          </div>          
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button disabled="" id="btn_matricula" onclick="document.getElementById('form_matricula').submit();" class="btn btn-info" type="submit">
                          Atualizar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Senha:</label><label class="pull-right" style="color: #3c8dbc;"><a href="" data-toggle="modal" data-target="#FormSenha">Editar <i class="fa fa-pencil"></i></a></label>
                  <?php
                    $senhacamuflada = null;
                    $con = strlen($senhalogado);
                    for ($i=0; $i < $con; $i++) { 
                      $senhacamuflada .= "&bull;";
                    }
                  ?>
                  <input type="text" class="form-control" disabled="" value="<?php echo $senhacamuflada; ?>">
                </div>
                <div class="modal fade" id="FormSenha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">       
                        <form role="form" method="post" action="enviar.php?acao=editar_senha&id=<?php echo $idusuario; ?>" id="senha">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Senha atual:</label>
                            <input type="password" class="form-control" name="senha_atual" id="senha_atual" onkeyup="teste_senha()" />
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nova senha:</label>
                            <input type="password" class="form-control" name="nova_senha" id="nova_senha" onkeyup="teste_senha()" />
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Confirme a nova senha:</label>
                            <input type="password" class="form-control" name="confirme_senha" id="confirme_senha" onkeyup="teste_senha()" />
                          </div>            
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button disabled="" id="btn_senha" class="btn btn-info" type="submit" onclick="document.getElementById('senha').submit();">
                          Atualizar
                        </button>
                      </div>
                    </div>
                  </div>
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
  <script type="text/javascript">
function teste_senha() {
    var senha_atual =  document.getElementById('senha_atual');
    var nova_senha = document.getElementById('nova_senha');
    var confirme_senha = document.getElementById('confirme_senha');
    var btn_senha = document.getElementById('btn_senha');

    if (senha_atual.value.length >= 8 && nova_senha.value.length >= 8 && confirme_senha.value.length >= 8 && nova_senha.value == confirme_senha.value) {
          btn_senha.disabled = false;
    }

    else{
          btn_senha.disabled = true;
    }

}

function teste_nome() {
    var nome =  document.getElementById('nome');
    var btn_nome = document.getElementById('btn_nome');

    if (nome.value.length >= 5) {
          btn_nome.disabled = false;
    }

    else{
          btn_nome.disabled = true;
    }

}

function teste_email(){
  var email = document.getElementById('email');
  var btn_email = document.getElementById('btn_email');
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{3,4})+$/;

  if (filter.test(email.value)) {
      btn_email.disabled = false;
 }
  
  else {
    btn_email.disabled = true;
  }
}

function teste_matricula(){
  var matricula = document.getElementById('matricula');
  var btn_matricula = document.getElementById('btn_matricula');

  if (matricula.value.length >= 5) {
     btn_matricula.disabled = false;
  }

  else{
    btn_matricula.disabled = true;
  }
}
</script>
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