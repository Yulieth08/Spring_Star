<?php require ("../../../Modelo/Persona.php")?>
<?php require("../../../Controlador/PersonaController.php") ?>
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
                Insertar Datos Marca
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
                    <h3 class="box-title">Marca</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->

                <?php
                if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                    <?php
                    $persona_data = PersonaController::buscarID($_GET["id"]);
                    ?>

                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Nombre: </td>
                            <td><?= $persona_data->getNombrePersona(); ?></td>
                        </tr>
                        <tr>
                            <td>Apellido: </td>
                            <td><?= $persona_data->getApellidosPersona(); ?></td>
                        </tr>
                        <tr>
                            <td>Tipo Documento: </td>
                            <td><?= $persona_data->getTipoDocumento(); ?></td>
                        </tr>
                        <tr>
                            <td>Documento: </td>
                            <td><?= $persona_data->getDocumentoPersona(); ?></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><?= $persona_data->getEmailPersona(); ?></td>
                        </tr>

                        <tr>
                            <td>Contraseña: </td>
                            <td><?= $persona_data->getContraseña(); ?></td>
                        </tr>
                        <tr>
                            <td>Rol: </td>
                            <td><?= $persona_data->getRol(); ?></td>
                        </tr>

                        <tr>
                            <td>Estado: </td>
                            <td><?= $persona_data->getEstado(); ?></td>
                        </tr>


                        </tbody>
                    </table>

                <?php }else{ ?>
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> No se encontro ninguna persona con el parametro de busqueda.
                    </div>
                <?php } ?>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="manager.php" class="btn btn-primary" >Volver</a>
                        <a href="edit.php?id=<?= $_GET["id"] ?>" class="btn btn-success">Editar</a>
                    </div>
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
