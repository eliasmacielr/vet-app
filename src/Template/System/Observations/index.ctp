<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet System - Observaciones') ?>

<?php $this->append('js') ?>
    <?= $this->Html->script('delete-confirm.js') ?>
    <script>
        $(deleteConfirm('delete-btn', '#delete-confirm-modal', '#delete-btn-confirm', '#delete-btn-cancel'));
    </script>
    <script>
        $('select[name="limit"]').change(function () {
            $(this).closest('form').trigger('submit');
        });
    </script>
<?php $this->end() ?>

<!--Content Wrapper. Contains page content -->
<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Observaciones de <?= $patient->name ?>
        <small></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a class="btn btn-primary" href="<?= $this->Url->build(['action' => 'add', 'patient_id' => $patient->id]) ?>"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
                    <?= $this->Html->link('Volver a la ficha', ['controller' => 'Patients', 'action' => 'view', 'id' => $patient->id], ['class' => 'btn btn-success']) ?>
                    <?= $this->Form->create(null, ['url' => ['action' => 'index', 'patient_id' => $patient->id], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
                        <div class="input-group">
                            <?= $this->form->select('limit', ['10' => '10', '25' => '25', '50' => '50', '100' => '100'], ['class' => 'form-control input-sm pull-right', 'value' => h($this->request->query('limit'))]) ?>
                        </div>
                        <div style="width: 150px;" class="input-group">
                            <input type="text" placeholder="<?= ucfirst(__('search')) ?>" class="form-control input-sm pull-right" name="q" value="<?= h($this->request->query('q')) ?>">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    <?= $this->Form->end() ?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <?php if (!$observations->isEmpty()): ?>
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('title', 'Título') ?></th>
                                <th><?= $this->Paginator->sort('type', 'Tipo') ?></th>
                                <th><?= $this->Paginator->sort('created', 'Creado') ?></th>
                                <th><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($observations as $observation): ?>
                                <tr>
                                    <td><?= h($observation->title) ?></td>
                                    <td>
                                        <?php if ($observation->type == 'urgent'): ?>
                                            <p class="label label-warning" style="font-size: 14px">Urgente</p>
                                        <?php else: ?>
                                            <p class="label label-info" style="font-size: 14px">Info</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= h($observation->created) ?></td>
                                    <td><?= h($observation->modified) ?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['action' => 'edit', 'id' => $observation->id, 'patient_id' => $patient->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                                        <?= $this->Form->create(null, ['url' => ['action' => 'delete', 'id' => $observation->id, 'patient_id' => $patient->id], 'type' => 'delete', 'style' => 'display: inline !important']) ?>
                                        <button name="delete-btn" class="btn btn-danger" type="button">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Borrar
                                        </button>
                                        <?= $this->Form->end() ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <?php else: ?>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        No se han encontrado registros
                                    </td>
                                </tr>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix"> <!-- box-footer -->
                    <div class="col-sm-5">
                        <?= $this->Paginator->counter('Mostrando de {{start}} a {{end}} de {{count}} registros') ?>
                    </div>
                    <div class="col-sm-7">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                    </div>
                </div> <!-- /.box-footer -->
            </div>
        </div>
    </div>
</section><!--/.content -->
<div id="delete-confirm-modal" class="modal modal-primary">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Eliminar</h4>
            </div>
            <div class="modal-body">
                <p>¿Desea eliminar el registro?</p>
            </div>
            <div class="modal-footer">
                <button id="delete-btn-cancel"  type="button" class="btn btn-outline pull-left">No</button>
                <button id="delete-btn-confirm" type="button" class="btn btn-outline">Sí</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
