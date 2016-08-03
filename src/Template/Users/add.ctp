<?php $this->assign('title-meta', 'Vet APP - Agregar usuario') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <script>
        $(function () {
            $('#group-name').select2({
                minimumResultsForSearch: Infinity
            });
        });
    </script>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Usuario
        <small>Crear</small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos usuario</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($user) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('name', ['class' => 'form-control', 'label' => 'Nombre', 'placeholder' => 'Nombre']);
                            echo $this->Form->input('last_name', ['class' => 'form-control', 'label' => 'Apellido', 'placeholder' => 'Apellido']);
                            echo $this->Form->input('email', ['class' => 'form-control', 'label' => 'Email', 'placeholder' => 'correo@ejemplo.com']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('password', ['class' => 'form-control', 'label' => 'Contraseña', 'value' => '', 'maxlength' => 60]);
                            echo $this->Form->input('group_name', ['class' => 'form-control', 'label' => 'Grupo', 'empty' => 'Seleccione el grupo', 'options' => ['admin' => 'Administrador', 'staff' => 'Miembro']]);
                            echo $this->Form->input('active', ['label' => ' Habilitado']);
                        ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button('Guardar', ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div><!-- /.box -->
        </div>
    </div>
</section><!--/.content -->
