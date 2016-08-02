<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navegaci&oacute;n</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'index']) ?>"><i class="fa fa-users"></i> <span>Clientes</span></a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'index']) ?>"><i class="fa fa-stethoscope"></i> <span>Pacientes</span></a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>M&aacute;s</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?= $this->Url->build(['controller' => 'Locations', 'action' => 'index']) ?>">Ciudades</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Species', 'action' => 'index']) ?>">Especies</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Breeds', 'action' => 'index']) ?>">Razas</a></li>
                </ul>
            </li>
            <li class="header">Vacunaciones</li>
            <li><a href="<?= $this->Url->build(['controller' => 'Vaccinations', 'action' => 'showExpired']) ?>"><i class="fa fa-home"></i> <span>Vencidos</span></a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Vaccines', 'action' => 'index']) ?>"><i class="fa fa-stethoscope"></i> <span>Vacunas</span></a></li>
            <li class="header">Movimientos</li>
            <li><a href="<?= $this->Url->build(['controller' => 'Movements', 'action' => 'index']) ?>"><i class="fa fa-money"></i> <span>Diario</span></a></li>
            <li><a href="<?= $this->Url->build(['controller' => 'Movements', 'action' => 'resume']) ?>"><i class="fa fa-money"></i> <span>Anual</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
