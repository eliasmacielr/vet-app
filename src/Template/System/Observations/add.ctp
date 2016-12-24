<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet System - Agregar observación') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('/adminlte/plugins/select2/select2.min.css') ?>
    <?= $this->Html->css('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>
    <?= $this->Html->css('form.css') ?>
<?php $this->end() ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/select2.full.min.js') ?>
    <?= $this->Html->script('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>
    <?= $this->Html->script('/adminlte/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.es-AR.js') ?>
    <?= $this->Html->script('/adminlte/plugins/select2/i18n/es.js') ?>
    <script>
        $.fn.select2.defaults.set('language', 'es');
        $("#content").wysihtml5({
            toolbar: {
                "link": false, //Button to insert a link. Default true
                "image": false, //Button to insert an image. Default true
            },
            locale: "es-AR"
        });
        $('#type').select2({
            minimumResultsForSearch: Infinity
        });
    </script>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Observación
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
                    <h3 class="box-title">Observación de <?= $patient->name ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($observation) ?>
                <div class="box-body">
                    <div class="col-sm-8">
                        <?php
                            echo $this->Form->input('title', ['class' => 'form-control', 'label' => 'Título']);
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php
                            echo $this->Form->input('type', ['class' => 'form-control', 'label' => 'Tipo', 'empty' => 'Seleccione el tipo', 'options' => ['urgent' => 'Urgente', 'info' => 'Información']]);
                        ?>
                    </div>
                    <div class="col-md-12">
                        <?php
                            echo $this->Form->input('content', ['class' => 'form-control', 'label' => 'Contenido', 'rows' => 15]);
                        ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Form->button('Guardar', ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link('Cancelar', ['action' => 'index', 'patient_id' => $patient->id], ['class' => 'btn btn-default']) ?>
                </div>
                <?= $this->Form->end() ?>
            </div><!-- /.box -->
        </div>
    </div>
</section><!--/.content -->
