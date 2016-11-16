<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navegaci&oacute;n</li>
            <!-- Optionally, you can add icons to the links -->
            <li <?= $controller === 'Home' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
            <li <?= $controller === 'Customers' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'index']) ?>"><i class="fa fa-users"></i> <span>Clientes</span> <span class="label label-primary pull-right"><?= $customers_count ?></span></a></li>
            <li <?= $controller === 'Patients' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'index']) ?>"><i class="fa fa-stethoscope"></i> <span>Pacientes</span> <span class="label label-primary pull-right"><?= $patients_count ?></span></a></li>
            <?php if ($user['group_name'] === 'admin'): ?>
                <li <?= $controller === 'Users' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>"><i class="fa fa-users"></i> <span>Usuarios</span> <span class="label label-primary pull-right"><?= $users_count ?></span></a></li>
            <?php endif; ?>
            <li class="treeview <?= in_array($controller, ['Locations', 'Species', 'Breeds']) === true ? 'active' : '' ?>">
                <a href="#"><i class="fa fa-link"></i> <span>M&aacute;s</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li <?= $controller === 'Locations' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Locations', 'action' => 'index']) ?>">Ciudades</a></li>
                    <li <?= $controller === 'Species' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Species', 'action' => 'index']) ?>">Especies</a></li>
                    <li <?= $controller === 'Breeds' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Breeds', 'action' => 'index']) ?>">Razas</a></li>
                </ul>
            </li>
            <li class="header">Vacunaciones</li>
            <li <?= $controller === 'Vaccinations' && $action === 'showExpired' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Vaccinations', 'action' => 'showExpired']) ?>"><i class="fa fa-home"></i> <span>Vencidos</span> <span class="label label-primary pull-right"><?= $expired_count >= 999 ? '999+' : $expired_count ?></span></a></li>
            <li <?= $controller === 'Vaccines' && $action === 'index' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Vaccines', 'action' => 'index']) ?>"><i class="fa fa-stethoscope"></i> <span>Vacunas</span></a></li>
            <li class="header">Movimientos</li>
            <li <?= $controller === 'Movements' && $action === 'index' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Movements', 'action' => 'index']) ?>"><i class="fa fa-money"></i> <span>Diario</span></a></li>
            <li <?= $controller === 'Movements' && $action === 'resume' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Movements', 'action' => 'resume']) ?>"><i class="fa fa-money"></i> <span>Anual</span></a></li>
            <li <?= $controller === 'Movements' && $action === 'showChart' ? 'class="active"' : '' ?>><a href="<?= $this->Url->build(['controller' => 'Movements', 'action' => 'showChart']) ?>"><i class="fa fa-money"></i> <span>Gráfico Anual</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
