<?php require ("../../snippers/checkLogin.php") ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spring Star</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
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

    <link rel="stylesheet" href="../../build/css/main.css"

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>






<body class="hold-transition skin-green sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <?php include ('../../snippers/header.php') ?>
    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <?php include ('../../snippers/main-sidebar.php') ?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Insertar datos proveedor
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
             

                <div id="prove_validado">

                </div>

                <form method="post" action="../../../Controlador/ProveedorController.php?action=crear">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Nit</label>
                                    <input class="form-control" type="text" placeholder="Ingrese su Nit" id="Nit_Proveedor" name="Nit_Proveedor">
                                </div>

                                <div class="form-group">
                                    <label>Nombre proveedor</label>
                                    <input class="form-control" type="text" placeholder="Ingrese su Nombre" id="Nombre_Proveedor" name="Nombre_Proveedor" maxlength="45" required>
                                </div>


                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Telefono Proveedor </label>
                                    <input class="form-control" type="number" placeholder="Telefono proveedor" id="Telefono_Proveedor" name="Telefono_Proveedor" maxlength="20" size="20" required>
                                </div>

                                <div class="form-group">
                                    <label>Direccion proveedor</label>
                                    <input class="form-control" type="text" placeholder="Ingrese su Direccion" id="Direccion_Proveedor" name="Direccion_Proveedor" maxlength="35" required>
                                </div>



                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>


                        <!-- /.row -->
                    </div>


                    <div class="box-footer">
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">Enviar</button>
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->


                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include ('../../snippers/Fotter.php') ?>

    <!-- jQuery 3 -->
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
</body>
</html>