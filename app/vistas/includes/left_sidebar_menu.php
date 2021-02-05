<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo RUTA_URL; ?>public/dist/img/user.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo strtoupper($_SESSION["login_usuario"]); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ PRINCIPAL</li>

            <?php
            foreach ($_SESSION["menu_perfil"] as $valor1)
            {
            ?>

            <li class="treeview" style="font-size: 12px;">
                <a href="#">
                    <i class="<?php echo $valor1[icono]; ?>"></i> <span><?php echo $valor1[text]; ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                    foreach ($valor1[opcion] as $valor2)
                    {
                    ?>

                    <li>
                        <a href="<?php echo $valor2[metodo_opcion]; ?>" style="font-size: 11px;">
                            <i class="fa fa-circle-o"></i> 
                            <?php echo $valor2[nombre_opcion]; ?>
                        </a>
                    </li>

                    <?php
                    }
                    ?>
                </ul>
            </li>


            <?php
            }
            ?>
            <!--
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span>VENTAS</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="venta">
                            <i class="fa fa-circle-o"></i> 
                            PUNTO DE VENTA
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            REPORTE DE VENTAS
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            ENTRADA Y SALIDAS DE EFECTIVO
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>PEDIDOS</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            NUEVO PEDIDO
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            CONSULTA DE PEDIDOS
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            HISTÓRICO DE PEDIDOS
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-birthday-cake"></i> <span>PASTELES</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            NUEVO PASTEL
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            CONSULTAR PASTELES
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>PRODUCTOS</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            GESTIÓN DE PRODUCTOS
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>ALMACÉN</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            EXISTENCIAS EN ALMACÉN
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            ENVIO DE EXISTENCIAS
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            CONSULTAR ENVIOS
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building-o"></i> <span>ALMACÉN SUCURSAL</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            EXISTENCIA EN STOCK
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            RECEPCIÓN DE EXISTENCIAS
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            MERMAS DE PRODUCTOS
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clipboard"></i> <span>REPORTES</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            REPORTES GENERALES
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            HISTORIAL DE MOVIMIENTO
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            CORTE
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>CLIENTES</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            GESTIÓN DE CLIENTES
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>CATÁLOGOS</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-circle-o"></i> 
                            BASES
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            CATEGORÍAS
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            PUESTOS
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>ADMINISTRACIÓN</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="usuario">
                            <i class="fa fa-circle-o"></i> 
                            USUARIO
                        </a>
                    </li>
                    <li>
                        <a href="perfil">
                            <i class="fa fa-circle-o"></i> 
                            PERFIL
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> 
                            EMPLEADO
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            SUCURSALES
                        </a>
                    </li>
                    <li>
                        <a href="index2.html">
                            <i class="fa fa-circle-o"></i> 
                            ALMACENES
                        </a>
                    </li>
                </ul>
            </li>-->
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>