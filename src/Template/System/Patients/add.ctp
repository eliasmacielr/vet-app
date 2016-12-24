<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet APP - Agregar paciente') ?>

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
            $('#breed-id').select2();
            $('#customer-id').select2();
            $('#sex').select2({
                minimumResultsForSearch: Infinity
            });
            $('#year').select2({
                placeholder: 'Año',
                minimumResultsForSearch: Infinity,
                allowClear: true,
            });
            $('#month').select2({
                placeholder: 'Mes',
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#day').select2({
                placeholder: 'Día',
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
        });
    </script>
    <script>
        $(quickFormBreed('<?= $this->Url->build(['controller' => 'Species', 'action' => 'index', 'prefix' => 'system/ajax']) ?>', '<?= $this->Url->build(['controller' => 'Breeds', 'action' => 'add', 'prefix' => 'system/ajax']) ?>'));
    </script>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Paciente
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
                    <h3 class="box-title">Datos paciente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($patient) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('name', ['class' => 'form-control', 'label' => 'Nombre', 'placeholder' => 'Nombre']);
                            echo $this->Form->input('sex', ['class' => 'form-control', 'label' => 'Sexo', 'empty' => 'Seleccione el sexo', 'options' => ['male' => 'Macho', 'female' => 'Hembra'], ]);
                        ?>
                        <?php if ($customer_id === null): ?>
                                <?= $this->Form->input('customer_id', ['class' => 'form-control', 'label' => 'Propietario', 'empty' => 'Seleccione propietario']); ?>
                        <?php else: ?>
                                <?= $this->Form->input('customer_id', ['class' => 'form-control', 'label' => 'Propietario', 'empty' => 'Seleccione propietario', 'value' => $customer_id, 'disabled']); ?>
                                <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
                        <?php endif; ?>
                        <?= $this->Form->input('breed_id', ['class' => 'form-control', 'label' => 'Raza', 'empty' => 'Seleccione raza']); ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('coat', ['class' => 'form-control', 'label' => 'Pelaje', 'placeholder' => 'Largo, corto, ...']);
                            echo $this->Form->input('color', ['class' => 'form-control', 'label' => 'Color', 'placeholder' => 'Negro, marrón, ...']);
                            echo $this->Form->input('birthday', [
                                    'label' => 'Fecha de nacimiento',
                                    'empty' => true,
                                    'minYear' => 2000,
                                    'maxYear' => 2099,
                                    'orderYear' => 'asc',
                                    'year' => ['id' => 'year', 'class' => 'form-control'],
                                    'month' => ['id' => 'month', 'class' => 'form-control'],
                                    'day' => ['id' => 'day', 'class' => 'form-control'],
                                ]);
                        ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $this->Form->button('Agregar raza', ['class' => 'btn btn-info', 'type' => 'button', 'id' => 'btn-breed-add']) ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button('Guardar', ['class' => 'btn btn-primary']) ?>
                    <?php if ($customer_id === null): ?>
                        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
                    <?php else: ?>
                        <?= $this->Html->link('Cancelar', ['controller' => 'Customers', 'action' => 'view', 'id' => $customer_id], ['class' => 'btn btn-default']) ?>
                    <?php endif;?>
                </div>
                <?= $this->Form->end() ?>
            </div><!-- /.box -->
        </div>
    </div>
</section><!--/.content -->
<div id="breed-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar nueva raza</h4>
                <div id="modal-error" class="error-message"></div>
            </div>
            <div class="modal-body">
                <div id="breed-form" class="form-horizontal">
                    <div class="form-group">
                        <label for="select-species" class="col-sm-2 control-label">Especie</label>
                        <div class="col-sm-10">
                            <select id="select-species" name="select-species" class="form-control">
                            </select>
                            <div id="species-select-error" class="error-message"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="breed-name" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="breed-name" name="breed-name" placeholder="Nombre" type="text">
                            <div id="breed-name-error" class="error-message"></div>
                        </div>
                    </div>
                </div>
                <div id="species-loading" class="col-xs-1 col-centered">
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-breed-cancel"  type="button" class="btn btn-default pull-left">Cancelar</button>
                <button id="btn-breed-save" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
