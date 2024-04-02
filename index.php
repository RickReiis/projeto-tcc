<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="shortcut icon" href="logo.png" type="image/x-icon"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />


		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />



	    <link rel="stylesheet" href="validar/bootstrap.css"/>
	    <link rel="stylesheet" href="validar/bootstrapValidator.css"/>

	    <script type="text/javascript" src="validar/jquery-1.10.2.min.js"></script>
	    <script type="text/javascript" src="validar/bootstrap/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="validar/bootstrapValidator.js"></script>
    
    <style type="text/css">

.form-group.has-error .help-block, .form-group.has-error .help-inline {
    color: #a94442;
}

.form-group.has-error input, .form-group.has-error select, .form-group.has-error textarea  {
    border-color: #a94442;
    color: #a94442;
}

.form-group.has-error .ace-icon, .form-group.has-error input:focus+.ace-icon, .form-group.has-error select:focus+.ace-icon, .form-group.has-error textarea:focus+.ace-icon {
    color: #a94442;
}

.form-group.has-error input:focus, .form-group.has-error select:focus, .form-group.has-error textarea:focus {
    color: #858585;
    border-color: #8C2020;
    background-color: #fef9f8;
    box-shadow: 2px 2px 2px 2px #000;
}

.login-box .toolbar {
    background: #28547f;
    border-top: 2px solid #28547f;
}
    </style>

	</head>

	<body class="login-layout light-login">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="space-6" style="color: #29547e !important"></div>
							<div class="position-relative" style="margin-top: 50px">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
										<div class="center">
                                           <img src="novo.png">
                                           </div>
											<div class="space-6"></div>

											<form method="post" action="enviar.php?acao=logar" id="form_logar">

                                                <div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="email" class="form-control" placeholder="Email" name="email">
								                   <i class="ace-icon fa fa-user"></i>
								                   </span>
                                                </div>

                                              <div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="password" class="form-control" placeholder="Senha" name="senha">
								                   <i class="ace-icon fa fa-repeat"></i>
								                   </span>
                                                </div>

													<div class="space"></div>

													<div class="clearfix">

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary" style="background-color: #28547f !important; border-color: #28547F;">
															<span class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>

											</form>


											<div class="space-6"></div>

											<div class="social-login center">

											</div>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div style="background-color: #28547f;">
												<a href="#" data-target="#forgot-box" class="forgot-password-link" style="color: #fff;">
													<i class="ace-icon fa fa-arrow-left"></i>
													Esqueceu senha?
												</a>
											</div>

											<div style="background-color: #28547f;">
												<a href="#" data-target="#signup-box" class="user-signup-link" style="color: #fff;">
													Registrar-se
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->







								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger" style="color: #28547f !important; border-bottom-color: #28547f !important">
												<i class="ace-icon fa fa-key" style="color: #28547f;"></i>
												Recuperar senha
											</h4>

											<div class="space-6"></div>
											<p>
												
                                               Digite seu e-mail e receba instruções
											</p>

											<form id="form_recuperar" method="POST" action="acaoRecuperarSenha.php?acao=recuperar_senha">
												<fieldset>
	                                                <div class="form-group">
													   <span class="block input-icon input-icon-right">
									                   <input type="email" class="form-control" placeholder="Email" name="email">
									                   <i class="ace-icon fa fa-user"></i>
									                   </span>
	                                                </div>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary" style="background-color: #28547f !important; border-color: #28547F;">
															<span class="bigger-110">Enviar</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center" style="background-color: #28547f;">
											<a href="#" data-target="#login-box" class="back-to-login-link" style="color: #fff;">
												Volte ao Login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->






								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger" style="color: #28547f !important; border-bottom-color: #28547f !important">
												<i class="ace-icon fa fa-users blue" style="color: #28547f !important;"></i>
												Registro de novo usuário
											</h4>

											<div class="space-6"></div>
											<p> 
                                            Digite os seus dados para começar: 
                                            </p>

											<form id="form_cadastrar" method="post" action="enviar.php?acao=cadastrarusuario">

												<div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="text" class="form-control" placeholder="Nome Completo.." name="nome">
								                   <i class="ace-icon fa fa-user"></i>
								                   </span>
                                                </div>

                                                <div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="email" class="form-control" placeholder="Email" name="email">
								                   <i class="ace-icon fa fa-envelope"></i>
								                   </span>
                                                </div>


                                                <div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="text" class="form-control" placeholder="Matricula" name="matricula">
								                   <i class="ace-icon fa fa-book"></i>
								                   </span>
                                                </div>


                                                <div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="password" class="form-control" placeholder="Senha.." name="senha">
								                   <i class="ace-icon fa fa-lock"></i>
								                   </span>
                                                </div>


                                                <div class="form-group">
												   <span class="block input-icon input-icon-right">
								                   <input type="password" class="form-control" placeholder="Confirme sua senha.." name="confirme_senha">
								                   <i class="ace-icon fa fa-repeat"></i>
								                   </span>
                                                </div>

     

												<div class="clearfix">
													<button type="submit" class="width-65 pull-right btn btn-sm btn-primary"  style="background-color: #28547f !important; border-color: #28547F;">
														<span class="bigger-110">Registrar</span>
														<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
													</button>
												</div>
											</form>
										</div>

										<div class="toolbar center" style="background-color: #28547f;">
											<a href="#" data-target="#login-box" class="back-to-login-link" style="color: #fff;">
												<i class="ace-icon fa fa-arrow-left"></i>
												Volte ao Login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->


						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->
<script type="text/javascript">
         	    $(document).ready(function() {
			    $('#form_cadastrar').bootstrapValidator({
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
			            },

			             email: {
			             validators: {
			             notEmpty: {
			             message: 'Seu E-mail é obrigatório!'
			                    },
			             emailAddress: {
                         message: 'Digite um E-mail válido!'
                              }
			                }
			            },

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
			            },

			            senha: {
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
                        field: 'senha',
                        message: 'A senha está diferente!'
                          }
                        }
                      }
			        }
			    });
			});

         	    $(document).ready(function() {
			    $('#form_logar').bootstrapValidator({
			        fields: {

			             email: {
			             validators: {
			             notEmpty: {
			             message: 'Por favor digite seu E-mail!'
			                    },
			             emailAddress: {
                         message: 'Digite um E-mail válido!'
                              }
			                }
			            },

			            senha: {
			            validators: {
			            notEmpty: {
			            message: 'Por favor digite sua senha!'
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
			    $('#form_recuperar').bootstrapValidator({
			        fields: {

			             email: {
			             validators: {
			             notEmpty: {
			             message: 'Por favor digite seu E-mail!'
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

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});

</script>
	</body>
</html>
