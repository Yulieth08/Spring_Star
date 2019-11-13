<?php require ("../../../Modelo/Proveedor.php")?>


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
                 Datos Proveedor
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= "http://".$_SERVER["HTTP_HOST"]."/Spring_star"; ?>/Vista/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <div class="box-body">
                    <table id="tabla1" class="table table-bordered table-striped dataTables_scrollBody form-inline">
                        <thead>
                        <tr>
                            <th>Nit proveedor</th>
                            <th>Nombre proveedor</th>
                            <th>Telefono proveedor</th>
                            <th>Direccion Proveedor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $arrayProveedor = Proveedor::getAll();

                        foreach ($arrayProveedor as $Proveedor){
                            ?>
                            <tr>
                                <td><?php echo $Proveedor->getNitProveedor(); ?></td>
                                <td><?php echo $Proveedor->getNombreProveedor(); ?></td>
                                <td><?php echo $Proveedor->getTelefonoProveedor(); ?></td>
                                <td><?php echo $Proveedor->getDireccionProveedor(); ?></td>
                                <td><?php echo $Proveedor->getEstado();?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $Proveedor->getIdProveedor(); ?>" type="button" data-toggle="tooltip" title="Actualizar" class="btn docs-tooltip btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="view.php?id=<?php echo $Proveedor->getIdProveedor(); ?>" type="button" data-toggle="tooltip" title="Ver" class="btn docs-tooltip btn-warning btn-xs"><i class="fa fa-eye"></i></a>
                                    <?php if ($Proveedor->getEstado() != "Activo"){ ?>

                                        <a href="../../../Controlador/ProveedorController.php?action=ActivarProveedor&Id_Proveedor=<?php echo $Proveedor->getIdProveedor(); ?>" type="button" data-toggle="tooltip" title="Activar" class="btn docs-tooltip btn-dark btn-xs"><i class="fa fa-check-square-o"></i></a>
                                    <?php }else{ ?>
                                        <a type="button" href="../../../Controlador/ProveedorController.php?action=InactivarProveedor&Id_Proveedor=<?php echo $Proveedor->getIdProveedor(); ?>" data-toggle="tooltip" title="Inactivar" class="btn docs-tooltip btn-danger btn-xs"><i class="fa fa-times-circle-o"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>

    </div>
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