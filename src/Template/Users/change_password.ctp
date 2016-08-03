<?php $this->assign('title-meta', 'Vet APP - Cambiar contraseña') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Cambiar Contraseña
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
                            echo $this->Form->input('old_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Contraseña actual', 'placeholder' => 'Contraseña Actual', 'value' => '', 'maxlength' => 60, 'required']);
                            echo $this->Form->input('password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Nueva contraseña', 'placeholder' => 'Nueva contraseña', 'value' => '', 'maxlength' => 60, 'required']);
                            echo $this->Form->input('repeat_new_password', ['type' => 'password', 'class' => 'form-control', 'label' => 'Repetir contraseña', 'placeholder' => 'Repetir contraseña', 'value' => '', 'maxlength' => 60, 'required']);
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
