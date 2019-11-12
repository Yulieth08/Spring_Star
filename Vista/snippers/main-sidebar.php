<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../../vendor/almasaeed2010/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">

        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Persona</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/persona/create.php"><i class="fa fa-circle-o"></i> Crear</a></li>
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/persona/manager.php"><i class="fa fa-circle-o"></i> Administrar</a></li>

                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-barcode"></i> <span>Marca</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/marca/create.php"><i class="fa fa-circle-o"></i> Crear</a></li>
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/marca/manager.php"><i class="fa fa-circle-o"></i> Administrar</a></li>

                </ul>
            </li>



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tags"></i> <span>Producto</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/producto/create.php"><i class="fa fa-circle-o"></i> Crear</a></li>
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/producto/manager.php"><i class="fa fa-circle-o"></i> Administrar</a></li>

                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Proveedor</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/proveedor/create.php"><i class="fa fa-circle-o"></i> Crear</a></li>
                    <li><a href="<?=  "http://".$_SERVER["HTTP_HOST"]."/spring_star"; ?>/Vista/modules/proveedor/manager.php"><i class="fa fa-circle-o"></i> Administrar</a></li>

                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cart-arrow-down"></i> <span>Facturas</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Factura Venta
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i>Crear</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i>Administrar</a></li>


                        </ul>

                    </li>


                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i> Factura Compra
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i>Crear</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i>Administrar</a></li>

                        </ul>

                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
