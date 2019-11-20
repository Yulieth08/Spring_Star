<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../build/css/main.css">

    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body   class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div  class="animate form login_form">
        <!-- Content Header (Page header) -->
            <section class="login_content content">

                <?php if(!empty($_GET['respuesta']) && $_GET['respuesta'] == 'error'){ ?>

                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                   Contraseña o email incorrecto
                </div>
                <?php } ?>
                <form id="frmLogin" name="frmLogin"  method="post" action="../../../Controlador/PersonaController.php?action=login">
                    <h1> LOGIN SPRING STAR</h1>
                    <div>
                        <input type="text" class="form-control" id="Email_persona" name="Email_persona" placeholder="Ingrese su correo" required="required" />
                    </div>
                    <div>
                        <input type="password" class="form-control" id="Contraseña" name="Contraseña" placeholder="Contrasena" required="required" />
                    </div>
                    <div class="separator">
                        <input class="btn btn-default submit" type="submit" value="Ingresar">
                        <a class="reset_pass" href="#">Olvido su contraseña?</a>
                    </div>
                    <div class="clearfix"></div>


                   <div class="separator">
                       <p class="change_link">Nuevo en el Sitio?
                           <a href="#signup" class="to_register"> Registrarse </a>
                       </p>

                       <div class="clearfix"></div>
                    <div>
                        <b><h1 ><i class="fas fa-boot"></i>
                                Spring Star</h1></b>

                        <b><p >Spring Star &copy; 2019 </p></b>
                    </div>
                   </div>
                </form>
        </div>
    </div>

</div>


    <script src="../../../vendor/almasaeed2010/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../../vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../../vendor/almasaeed2010/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../../vendor/almasaeed2010/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js"></script>

    <script src="../../../Vista/build/js/main.js"></script>
    <!-- AdminLTE for demo purposes -->
