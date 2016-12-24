<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet System - Vacunación') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <?= $this->Html->script('quick-forms.js') ?>
    <script>
        $(function () {
            $('#vaccine-id').select2();
            $('#sex').select2({
                minimumResultsForSearch: Infinity
            });
            $('#year-v').select2({
                placeholder: 'Año',
                minimumResultsForSearch: Infinity,
                allowClear: true,
            });
            $('#month-v').select2({
                placeholder: 'Mes',
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#day-v').select2({
                placeholder: 'Día',
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#year-rv').select2({
                placeholder: 'Año',
                minimumResultsForSearch: Infinity,
                allowClear: true,
            });
            $('#month-rv').select2({
                placeholder: 'Mes',
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
            $('#day-rv').select2({
                placeholder: 'Día',
                minimumResultsForSearch: Infinity,
                allowClear: true
            });
        });
    </script>
    <script>
        $(quickFormVaccine('<?= $this->Url->build(['controller' => 'Vaccines', 'action' => 'add', 'prefix' => 'system/ajax']) ?>'));
    </script>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Vacunación
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
                    <h3 class="box-title">Vacunación de <?= $patient->name ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($vaccination, ['novalidate' => 'novalidate']) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('vaccine_id', ['class' => 'form-control', 'label' => 'Vacuna', 'empty' => 'Seleccione vacuna']);
                            echo $this->Form->input('annotations', ['class' => 'form-control', 'label' => 'Anotaciones', 'placeholder' => 'Anotaciones']);

                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('vaccination_date', [
                                    'label' => 'Fecha de vacunación',
                                    'empty' => false,
                                    'minYear' => 2000,
                                    'maxYear' => 2099,
                                    'orderYear' => 'asc',
                                    'year' => ['id' => 'year-v', 'class' => 'form-control'],
                                    'month' => ['id' => 'month-v', 'class' => 'form-control'],
                                    'day' => ['id' => 'day-v', 'class' => 'form-control'],
                                ]);
                            echo $this->Form->input('revaccination', [
                                    'label' => 'Fecha de revacunación',
                                    'empty' => true,
                                    'minYear' => 2000,
                                    'maxYear' => 2099,
                                    'orderYear' => 'asc',
                                    'year' => ['id' => 'year-rv', 'class' => 'form-control'],
                                    'month' => ['id' => 'month-rv', 'class' => 'form-control'],
                                    'day' => ['id' => 'day-rv', 'class' => 'form-control'],
                                ]);
                        ?>
                    </div>
                    <div class="col-sm-12">
                        <?= $this->Form->button('Agregar Vacuna', ['class' => 'btn btn-info', 'type' => 'button', 'id' => 'btn-vaccine-add']) ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button('Guardar', ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link('Cancelar', ['controller' => 'Patients', 'action' => 'view', 'id' => $patient->id], ['class' => 'btn btn-default']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div><!-- /.box -->
        </div>
    </div>
</section><!--/.content -->
<div id="vaccine-modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar nueva vacuna</h4>
                <div id="modal-error" class="error-message"></div>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="vaccine-name" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="vaccine-name" name="vaccine-name" placeholder="Nombre" type="text">
                            <div id="vaccine-name-error" class="error-message"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-vaccine-cancel"  type="button" class="btn btn-default pull-left">Cancelar</button>
                <button id="btn-vaccine-save" type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
