<?php $this->assign('title-meta', 'Vet APP - Editar paciente') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <script>
        $(function () {
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
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Paciente
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
                    <h3 class="box-title">Datos paciente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($patient) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('name', ['class' => 'form-control', 'label' => 'Nombre', 'placeholder' => 'Nombre']);
                            echo $this->Form->input('sex', ['class' => 'form-control', 'label' => 'Sexo', 'empty' => 'Seleccione el sexo', 'options' => ['male' => 'Macho', 'female' => 'Hembra'], ]);
                            echo $this->Form->input('customer_id', ['class' => 'form-control', 'label' => 'Propietario', 'empty' => 'Seleccione propietario']);
                            echo $this->Form->input('breed_id', ['class' => 'form-control', 'label' => 'Raza', 'empty' => 'Seleccione raza']);
                        ?>
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
