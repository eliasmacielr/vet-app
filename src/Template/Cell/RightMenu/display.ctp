<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <span class="glyphicon glyphicon-user"></span>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?= $user['name'] . ' ' . $user['last_name'] ?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header" style="height: auto">
                    <p>
                        <?= $user['email'] ?>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="col-xs-12 text-center">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'changePassword']) ?>">Cambiar contraseña</a>
                    </div>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'editProfile']) ?>" class="btn btn-default btn-flat">Editar Perfil</a>
                    </div>
                    <div class="pull-right">
                        <a href="<?= $this->Url->build(['controller' => 'Auth', 'action' => 'logout']) ?>" class="btn btn-default btn-flat">Salir</a>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div> <!-- Right menu -->
