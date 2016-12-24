<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet System - Editar raza') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/i18n/es.js') ?>
    <script>
        $(function () {
            $.fn.select2.defaults.set('language', 'es');
            $('#species-id').select2();
        });
    </script>
<?php $this->end() ?>
<section class = "content-header">
    <h1>
        Razas
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
                    <h3 class="box-title">Datos raza</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($breed) ?>
                <div class="box-body">
                    <div class="col-sm-6">
                        <?php
                            echo $this->Form->input('name', ['class' => 'form-control', 'label' => 'Nombre', 'placeholder' => 'Nombre']);
                            echo $this->Form->input('species_id', ['options' => $species, 'class' => 'form-control', 'label' => 'Especie', 'empty' => 'Seleccione un especie']);
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
