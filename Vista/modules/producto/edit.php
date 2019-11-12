<?php require("../../../Controlador/ProductoController.php") ?>
<?php require("../../../Controlador/MarcaController.php") ?>

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
                Editar Datos Producto  </h1>
            <ol class="breadcrumb">
                <li><a href="<?= "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Producto</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <?php
                if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                    <?php
                    $Producto_data = ProductoController::buscarID($_GET["id"]);
                    ?>


                    <form method="post" action="../../../Controlador/ProductoController.php?action=editar">
                        <input id="Id_producto" value="<?php echo $Producto_data->getIdProducto(); ?>" name="Id_producto" hidden required type="text">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Marca</label>
                                        <?= Marcacontroller::selectMarca( false,
                                            true,
                                            "Id_Marca",
                                            "Id_Marca",
                                            $Producto_data->getIdMarca()->getIdMarca(),
                                            "form-control",
                                            "Estado = 'Activo'") ?>

                                    </div>

                                    <div class="form-group">
                                        <label>Referencia Producto</label>
                                        <input class="form-control" value="<?php echo $Producto_data->getCodigoProducto()?>" type="text" placeholder="Ingrese referencia producto" id="Codigo_producto" name="Codigo_producto"  required>
                                    </div>



                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">




                                    <div class="form-group">
                                        <label>Tipo Producto</label>
                                        <select class="form-control" name="Tipo_producto" id="Tipo_producto" required>
                                            <option <?php if ($Producto_data->getTipoProducto() == "Calzado") { echo "value=\"Calzado\""; echo "selected";}?>>Calzado</option>
                                            <option <?php if ($Producto_data->getTipoProducto() == "Correas") { echo "value=\"Correas\""; echo "selected";}?>>Correas</option>
                                            <option <?php if ($Producto_data->getTipoProducto() == "Billeteras") { echo "value=\"Billeteras\""; echo "selected";}?>>Billeteras</option>

                                        </select>
                                    </div>

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="box-footer">
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default">Cancelar</button>
                                <button type="submit" class="btn btn-info pull-right">Enviar</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.box-body -->
                <?php } else { ?>
                    <?php if (empty($_GET["respuesta"])) { ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                            </button>
                            <strong>Error!</strong> No se encontro ninguna persona con el parametro de busqueda.
                        </div>
                    <?php } ?>
                <?php } ?>

                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
    </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include ('../../snippers/Fotter.php') ?>

<!-- Control Sidebar -->
<?php include ('../../snippers/control_sidebar.php') ?>

<!-- ./wrapper -->

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
<!-- AdminLTE for demo purposes -->
</body>
</html>