<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet System - Editar perfil') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Editar Perfil
        <small></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($user) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('name', ['class' => 'form-control', 'label' => 'Nombre', 'placeholder' => 'Nombre']);
                            echo $this->Form->input('last_name', ['class' => 'form-control', 'label' => 'Apellido', 'placeholder' => 'Apellido']);
                            echo $this->Form->input('email', ['class' => 'form-control', 'label' => 'Email', 'placeholder' => 'correo@ejemplo.com']);
                            echo $this->Form->input('confirm_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Confirmar con contraseña', 'placeholder' => 'Confirmar con contraseña', 'value' => '', 'maxlength' => 60, 'required']);
                        ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button('Guardar', ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link('Cancelar', ['controller' => 'Home', 'action' => 'index'], ['class' => 'btn btn-default']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div><!-- /.box -->
        </div>
    </div>
</section><!--/.content -->
