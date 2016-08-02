<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Iniciar Sesión</title>
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

        <?= $this->Html->css('form.css') ?>

        <!-- Theme style -->
        <?= $this->Html->css('/adminlte/dist/css/AdminLTE.min.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?= $this->Html->script('/adminlte/plugins/iexplorer/html5shiv.min.js') ?>
        <?= $this->Html->script('/adminlte/plugins/iexplorer/respond.min.js') ?>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('auth') ?>
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>"><b>Vet</b> APP</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Iniciar Sesión</p>
                <?= $this->Form->create($login) ?>
                    <?= $this->Form->input('email', ['class' => 'form-control', 'label' => 'Email', 'placeholder' => 'correo@ejemplo.com', 'autofocus']) ?>
                    <?= $this->Form->input('password', ['class' => 'form-control', 'label' => 'Contraseña', 'placeholder' => 'Contraseña', 'value' => '']) ?>
                    <div class="row">
                        <div class="col-xs-4 pull-right">
                            <?= $this->Form->button('Iniciar', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
                        </div>
                    </div>
                <?= $this->Form->End() ?>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <?= $this->Html->script('/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>
    <!-- Bootstrap 3.3.5 -->
    <?= $this->Html->script('/adminlte/bootstrap/js/bootstrap.min.js') ?>
    <!-- AdminLTE App -->
    <?= $this->Html->script('/adminlte/dist/js/app.min.js') ?>
    <?= $this->Html->script('/adminlte/plugins/fastclick/fastclick.min.js') ?>
    <?= $this->Html->script('/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') ?>
  </body>
</html>
