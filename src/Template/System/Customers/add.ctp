<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet System - Agregar cliente') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
    <?= $this->Html->css('form.css') ?>
    <?= $this->Html->css('vet-app.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/i18n/es.js') ?>
    <?= $this->Html->script('quick-forms.js') ?>
    <script>
        $(function () {
            $.fn.select2.defaults.set('language', 'es');
            $('#location-id').select2();
        });
    </script>
    <script>
        $(quickFormLocation('<?= $this->Url->build(['controller' => 'Locations', 'action' => 'add', 'prefix' => 'system/ajax']) ?>'));
    </script>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Cliente
        <small>Agregar</small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos Cliente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($customer) ?>
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
                            echo $this->Form->input('phone', ['class' => 'form-control', 'label' => 'Teléfono', 'placeholder' => 'Teléfono']);
                            echo $this->Form->input('phone_other', ['class' => 'form-control', 'label' => 'Teléfono', 'placeholder' => 'Teléfono (opcional)', 'type' => 'tel']);
                            echo $this->Form->input('address', ['class' => 'form-control', 'label' => 'Dirección', 'placeholder' => 'Dirección']);
                            echo $this->Form->input('location_id', ['options' => $locations, 'class' => 'form-control', 'label' => 'Ciudad', 'empty' => 'Seleccione una ciudad'])
                        ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $this->Form->button('Agregar Ciudad', ['class' => 'btn btn-info', 'type' => 'button', 'id' => 'btn-location-add']) ?>
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
<div id="location-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar nueva ciudad</h4>
                <div id="modal-error" class="error-message"></div>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="location-name" name="location-name" placeholder="Nombre" type="text">
                            <div id="location-name-error" class="error-message"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-location-cancel"  type="button" class="btn btn-default pull-left">Cancelar</button>
                <button id="btn-location-save" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
