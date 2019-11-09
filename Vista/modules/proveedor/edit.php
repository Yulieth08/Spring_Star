<?php require("../../../Controlador/ProveedorController.php") ?>
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
    <!-- Contenido de la pagina-->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Insertar Datos Proveedor
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= "http://".$_SERVER["HTTP_HOST"]."/Spring_Star"; ?>/Vista/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Proveedor</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->

                <?php
                if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                <?php
                $DataProve = ProveedorController::buscarID($_GET["id"]);
                var_dump($DataProve);
                ?>

                <form method="post" action="../../../Controlador/ProveedorController.php?action=editar">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Proveedor</label>
                                    <input id="Id_proveedor" value="<?php echo $DataProve->getIdproveedor();?>"
                                           name="Id_proveedor" hidden required type="text">
                                    <input class="form-control" type="text" value="<?php echo $DataProve->getIdproveedor();?>" placeholder="Ingrese el Nit " id="Id_proveedor" name="Id_proveedor"  required>
                                </div>
                                <div class="form-group">
                                    <label>NIT</label>
                                    <input class="form-control" type="number" value="<?php echo $DataProve->getNitproveedor();?>" placeholder="Ingrese el Nombre" id="Nit_proveedor" name="Nit_proveedor"required>
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" type="number" value="<?php echo $DataProve->getNombreproveedor();?>" placeholder="Ingrese el Nombre" id="Nombre_Proveedor" name="Nombre_Proveedor"required>
                                </div>

                                <div class="form-group">
                                    <label>Telefono</label>
                                    <input class="form-control" type="text" value="<?php echo $DataProve->getTelefonoproveedor();?>" placeholder="Ingrese El Telefono" id="Telefono_Proveedor" name="Telefono_Proveedor"required>
                                </div>

                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input class="form-control" type="text" value="<?php echo $DataProve->getDireccionProveedor();?>" placeholder="Ingresela Direccion" id="Direccion_Proveedor" name="Direccion_Proveedor"required>
                                </div>
                            </div>
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

            </div>

    </div>


    <!-- /.form-group -->
</div>
<!-- /.col -->
</div>
<!-- /.row -->

</form>
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

</div>
<!-- /.box -->
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