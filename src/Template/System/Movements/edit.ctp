<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet APP - Editar movimiento') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <script>
        $(function () {
            $('#type').select2({
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
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Movimiento
        <small>Editar</small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos movimiento</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($movement) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('type', ['class' => 'form-control', 'label' => 'Tipo', 'empty' => 'Seleccione tipo', 'options' => ['income' => 'Entrada', 'outcome' => 'Salida']]);
                            echo $this->Form->input('concept', ['class' => 'form-control', 'label' => 'Concepto', 'placeholder' => 'Concepto']);
                            echo $this->Form->input('amount', ['class' => 'form-control', 'label' => 'Monto', 'placeholder' => 'Monto']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php echo $this->Form->input('movement_date', [
                                'label' => 'Fecha',
                                'empty' => false,
                                'minYear' => 2000,
                                'maxYear' => 2099,
                                'orderYear' => 'asc',
                                'year' => ['id' => 'year', 'class' => 'form-control'],
                                'month' => ['id' => 'month', 'class' => 'form-control'],
                                'day' => ['id' => 'day', 'class' => 'form-control'],
                            ]);
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
