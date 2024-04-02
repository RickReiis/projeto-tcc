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
  <title>Editar Cadastro | Já posso Ensinar! </title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="adminlte-2.3.11/plugins/iCheck/square/blue.css">
  <link rel="shortcut icon" href="imagens/favicon.png" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box" >
  <div class="register-logo">
    Editar Cadastro
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Edite os campos</p>
   
   <?php
    include"config.php";
  $idusuario = $_GET['id'];
  $sql = mysql_query("SELECT * FROM usuario WHERE idusuario = '$idusuario'");
  $row = mysql_fetch_object($sql);
  $usuario = $row->usuario;
  $turma = $row->turma;
  $telefone = $row->telefone;
  $email = $row->email;
  $materia = $row->materia;
  $saberes = $row->saberes_idsaberes;
  $status = $row->status;
  ?>

        
    

    <form method="post" action="controle.php?editarform&id=<?php echo $idusuario; ?>" enctype="multipart/form-data">

      <div class="form-group has-feedback"> 
        <input type="text" class="form-control" name="usuario" placeholder="Nome" value="<?php echo $usuario; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="turma" placeholder="Turma" value="<?php echo $turma; ?>">
        <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
      </div>
     
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $email; ?>">
    
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" name="telefone" placeholder="Telefone" value="<?php echo $telefone; ?>">
        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" name="foto">
        <input type="file" class="form-control" name="foto"  value="<?php echo $foto; ?>">
        <span class="glyphicon glyphicon-picture form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="materia" placeholder="Materia" value="<?php echo $materia; ?>">
        <span class="glyphicon glyphicon-book form-control-feedback"></span>
      </div>
      
      <div class="form-group">
            <select name="idsaberes" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
              <option>Áreas</option>
              <?php
                include "config.php";
                $sql = mysql_query("SELECT * FROM saberes");

                if(mysql_num_rows($sql)>0)
                {
                  while($row = mysql_fetch_object($sql))
                    {
                      $s = "";
                      if ($row->idsaberes == $saberes) {
                        $s = "selected";
                      }
                      else {
                        $s = "";
                      }
              ?>
                <option value="<?php echo $row->idsaberes ?>" <?php echo $s;?> ><?php echo $row->nome;?></option>
              <?php
                    }
                }
              ?>
            </select>
      </div>

      
    <div class="row">
        
        <div class="box-footer">
          <a href="validados.php" type="submit" class="btn btn-default">Cancelar</a>
         
      <input type="submit" class="btn btn-info pull-right" value="Salvar" > 
 
        </div>

      </div>
    </form>

  </div>
</div>

<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>