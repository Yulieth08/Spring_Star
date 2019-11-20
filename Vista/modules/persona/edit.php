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
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../build/css/main.css">

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
            <h1>Editar Datos Persona </h1>
            <ol class="breadcrumb">
                <li><a href="<?= "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                

                <?php
                if (!empty($_GET["id"]) && isset($_GET["id"])) { ?>
                <?php
                $persona_data = PersonaController::buscarID($_GET["id"]);
                ?>


                <form method="post" action="../../../Controlador/PersonaController.php?action=editar">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Tipo Documento </label>

                                    <select class="form-control" name="Tipo_Documento" id="Tipo_Documento" required>
                                        <option <?php if ($persona_data->getTipoDocumento() == "C.C") { echo "value=\"C.C\""; echo "selected";}?>>C.C</option>
                                        <option <?php if ($persona_data->getTipoDocumento() == "T.I") { echo "value=\"T.I\""; echo "selected";}?>>T.I</option>
                                        <option <?php if ($persona_data->getTipoDocumento() == "C.E") { echo "value=\"C.E\""; echo "selected";}?>>C.E</option>

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Nombre</label>
                                        <input id="Id_persona" value="<?php echo $persona_data->getIdPersona(); ?>" name="Id_persona" hidden required type="text">

                                    <input class="form-control" value="<?php echo $persona_data->getNombrePersona()?>" type="text" placeholder="Ingrese su Nombre" id="Nombre_persona" name="Nombre_persona" >
                                </div>

                                <div class="form-group">
                                    <label>Telefono Persona</label>
                                    <input class="form-control" value="<?php echo $persona_data->getTelefonoPersona()?>" type="text" placeholder="Ingrese su Email" id="Telefono_Persona" name="Telefono_Persona" required>
                                </div>

                                <div class="form-group datos-cuenta ">
                                    <label>Email</label>
                                    <input class="form-control" value="<?php echo $persona_data->getEmailPersona()?>" type="email" placeholder="Ingrese su Email" id="Email_persona" name="Email_persona" required>
                                </div>



                                <div class="form-group">
                                    <label>Rol</label>
                                    <select class="form-control" name="Rol" id="Rol" required>
                                        <option <?php if ($persona_data->getRol() == "Administrador") { echo "value=\"Administrador\""; echo "selected";}?>>Administrador</option>
                                        <option <?php if ($persona_data->getRol() == "Vendedor") { echo "value=\"Vendedor\""; echo "selected";}?>>Vendedor</option>
                                        <option <?php if ($persona_data->getRol() == "Cliente") { echo "value=\"Cliente\""; echo "selected";}?>>Cliente</option>

                                    </select>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Documento</label>
                                    <input class="form-control" value="<?php echo $persona_data->getDocumentoPersona()?>" type="text" placeholder="Ingrese su Documento" id="Documento_Persona" name="Documento_Persona"  required>
                                </div>
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input class="form-control" value="<?php echo $persona_data->getApellidosPersona()?>" type="text" placeholder="Ingrese su Apellido" id="Apellidos_persona" name="Apellidos_persona"  required>
                                </div>
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input class="form-control" value="<?php echo $persona_data->getDireccionPersona()?>"  type="text" placeholder="Ingrese su direccion" id="Direccion_Persona" name="Direccion_Persona" required>
                                </div>

                                <div class="form-group datos-cuenta ">
                                    <label>Contraseña</label>
                                    <input class="form-control" value="<?php echo $persona_data->getContraseña()?>"  type="password" placeholder="Ingrese su Contraseña" id="Contraseña" name="Contraseña" required>
                                </div>





                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="box-footer">
                        <div class="box-footer">
                            <a href="manager.php" class="btn btn-danger" >Cancelar</a>
                            <button type="submit" class="btn btn-success pull-right">Enviar</button>
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