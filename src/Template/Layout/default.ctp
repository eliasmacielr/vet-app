<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= h($this->fetch('title-meta', 'Vet APP')) ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Title icon -->
        <?= $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']) ?>

        <!-- bootstrap 3.3.5 -->
        <?= $this->Html->css('/adminlte/bootstrap/css/bootstrap.min.css') ?>
        <!-- Font Awesome -->
        <?= $this->Html->css('/adminlte/plugins/font-awesome-4.5.0/css/font-awesome.min.css') ?>
        <!-- Ionicons -->
        <?= $this->Html->css('/adminlte/plugins/ionicons-2.0.1/css/ionicons.min.css') ?>

        <?= $this->fetch('css') ?>

        <!-- Theme style -->
        <?= $this->Html->css('/adminlte/dist/css/AdminLTE.min.css') ?>
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <?= $this->Html->css('/adminlte/dist/css/skins/skin-blue.min.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <?= $this->Html->script('/adminlte/plugins/iexplorer/html5shiv.min.js') ?>
            <?= $this->Html->script('/adminlte/plugins/iexplorer/respond.min.js') ?>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>VET</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Vet </b>APP</span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <?= $this->element('rightmenu') ?>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <?= $this->element('leftsidebar') ?>
            <!-- Control Sidebar -->
            <div class = "content-wrapper">
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('auth') ?>
                <?= $this->fetch('content') ?>
            </div><!--/.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">

                </div>
                <!-- Default to the left -->
                <strong>Vet APP &copy; <?= date('Y') ?>
            </footer>
        </div><!-- ./wrapper -->
        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <?= $this->Html->script('/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>
        <!-- Bootstrap 3.3.5 -->
        <?= $this->Html->script('/adminlte/bootstrap/js/bootstrap.min.js') ?>
        <!-- AdminLTE App -->
        <?= $this->Html->script('/adminlte/dist/js/app.min.js') ?>
        <?= $this->Html->script('/adminlte/plugins/fastclick/fastclick.min.js') ?>
        <?= $this->Html->script('/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') ?>
        <?= $this->fetch('js') ?>
    </body>
</html>
