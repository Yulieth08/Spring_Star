<?php require ("../../snippers/checkLogin.php") ?>
<?php require("../../../Controlador/PersonaController.php") ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Spring Star</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../build/css/main.css">
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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>






<body class="hold-transition skin-green sidebar-mini" onload="nFactura();">
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
            <h1>Factura Compra </h1>
            <ol class="breadcrumb">
                <li><a href="<?= "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>N°Factura</label>
                                    <input class="form-control" type="text" id="numero_factura_compra" name="numero_factura_compra">
                                </div>

                                <div class="form-group">
                                    <label>Nit Proveedor </label>
                                    <input class="form-control" type="number" placeholder="Nit Proveedor" id="Id_Proveedor" name="Id_Proveedor" " required>
                                </div>

                                <div class="form-group">
                                    <label>Telefono Proveedor</label>
                                    <input class="form-control" type="text" placeholder="Ingrese Telefono Proveedor" id="Telefono_Proveedor" name="Telefono_Proveedor"  required>
                                </div>




                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Fecha Compra</label>
                                    <input class="form-control" type="date" placeholder="Ingrese su Nit" id="Fecha_compra" name="Fecha_compra">
                                </div>

                                <div class="form-group">
                                    <label>Nombre proveedor</label>
                                    <input class="form-control" type="text" placeholder="Ingrese nombre de proveedor" id="Nombre_Proveedor" name="Nombre_Proveedor"  required>
                                </div>

                                <div class="form-group">
                                    <label>Documento quien recibe</label>
                                    <?= PersonaController::selectPersona( false,
                                        false,
                                        "Id_persona",
                                        "Id_persona",
                                        "",
                                        "form-control",
                                        "Rol != 'Cliente' and Estado = 'Activo' " ) ?>
                                </div>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right">Crear Factura</button>
                        </div>

                <br>
                <div class="productos">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Codigo producto</label>
                                    <input class="form-control">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input class="form-control">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Precio Unidad</label>
                                    <input class="form-control">

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Talla</label>
                                    <input class="form-control">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Color</label>
                                    <input class="form-control">

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label></label>
                                    <button type="submit" class="btn btn-success">Agregar Producto</button>

                                </div>
                            </div>

                        </div>

                        <table id="tabla_productos" class="table table-striped">
                            <thead class="thead-darkt">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio Unidad</th>
                                <th scope="col">Precio Total</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Accion</th>

                            </tr>
                            </thead>
                        </table>


                    </div>
                </div>



                <div class="box-footer">
                    <div class="box-footer">
                        <button type="reset" class="btn btn-danger" disabled>Cancelar</button>
                        <button type="submit" class="btn btn-success pull-right" disabled>Finalizar Compra</button>
                    </div>
                </div>


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

    <script src="../../build/js/main.js"></script>
    <!-- AdminLTE for demo purposes -->
</body>
</html>
