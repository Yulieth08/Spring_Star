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






<body class="hold-transition skin-green sidebar-mini" onload="nFacturaVen();">
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
            <h1>Factura Venta </h1>
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
                                <input class="form-control" type="text" id="N_Factura_venta" name="N_Factura_venta">
                            </div>


                            <div class="form-group">
                                <label>Documento Cliente</label>
                                <?= PersonaController::selectPersona( false,
                                    false,
                                    "Id_cliente_v",
                                    "Id_cliente_v",
                                    "",
                                    "form-control",
                                    "Rol = 'Cliente'" ) ?>
                            </div>
                            <div class="form-group">
                                <label>Telefono Cliente </label>
                                <input class="form-control" type="text" placeholder="Telefono Cliente" id="Telefono_Cliente" name="Telefono_Cliente" " required>
                            </div>

                            <div class="form-group">
                                <label>Documento Vendedor</label>
                                <?= PersonaController::selectPersona( false,
                                    false,
                                    "Id_vendedor",
                                    "Id_vendedor",
                                    "",
                                    "form-control",
                                    "Rol != 'Cliente' and Estado = 'Activo' " ) ?>


                            </div>

                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha Venta</label>
                                <input class="form-control" type="date" placeholder="Ingrese su fecha" id="Fecha_factura" name="Fecha_factura">
                            </div>
                            <div class="form-group">
                                <label>Nombre Cliente </label>
                                <input class="form-control" type="text" placeholder="Nombre Cliente" id="Nombre_Cliente" name="Nombre_Cliente" required>
                            </div>

                            <div class="form-group">
                                <label>Dirección Cliente </label>
                                <input class="form-control" type="text" placeholder="Dirección Cliente" id="Direccion_Cliente" name="Direccion_Cliente" " required>
                            </div>





                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="box-footer">
                    <button id="CrearFactura" type="submit" class="btn btn-success pull-right" onclick="registrarFacturaVenta()">Crear Factura</button>
                </div>

                <br>
                <div class="productos_v">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Codigo Producto</label>
                                    <input class="form-control" id="codigo_producto_v" name="codigo_producto_v" placeholder="Codigo Producto" required>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre Producto</label>
                                    <input class="form-control" id="nom_producto_v" name="nom_producto_v" placeholder="Nombre Producto" required>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input class="form-control" id="cantidad_producto_v" name="cantidad_producto_V" placeholder="Cantidad Producto" required>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Precio Venta</label>
                                    <input class="form-control" id="precio_producto_v" name="precio_producto_v" placeholder="Precio Producto" required>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Talla</label>
                                    <select class="form-control" id="talla_v" name="talla_v">
                                        <option value="0">Ninguno</option>
                                        <?php
                                        for ($i = 30; $i <= 45; $i++){

                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select class="form-control" id="color_v" name="color_v">
                                        <option value="ninguno">Ninguno</option>
                                        <option value="negro">Rojo</option>
                                        <option value="azul">Azul</option>
                                        <option value="cafe">Cafe</option>
                                        <option value="gris">Gris</option>
                                        <option value="rojo">Rojo</option>
                                        <option value="verde">Verde</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label></label>
                                    <button type="submit" class="btn btn-success" id="agregarProductoV" disabled onclick="agregarProVen()">Agregar Producto</button>

                                </div>
                            </div>

                        </div>



                        <table id="tabla_productos_v" class="table table-striped">
                            <thead class="thead-darkt">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Talla</th>
                                <th scope="col">Color</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio Unidad</th>
                                <th scope="col">Precio Total</th>
                                <th scope="col">Accion</th>

                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>



                <div class="box-footer">
                    <div class="box-footer">
                        <button type="reset" class="btn btn-danger" disabled>Cancelar</button>
                        <button type="submit" id="btn_venta" class="btn btn-success pull-right" disabled onclick="recorrerTablaV()">Finalizar Compra</button>
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
































