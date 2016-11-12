<?php $this->assign('title-meta', 'Vet APP - Ficha paciente') ?>

<?php $this->append('js') ?>
    <script>
        // Delete button EVENTS
        var form;
        $('button[name="delete-btn"]').on('click', function (e) {
            e.preventDefault();
            form = $(this).closest('form');
            var deleteConfirmModal = $('#delete-confirm-modal');
            deleteConfirmModal.modal({backdrop: 'static', keyboard: false});
            deleteConfirmModal.one('click', '#delete-btn-cancel', function () {
                deleteConfirmModal.modal('toggle');
            });
        });

        $('#delete-btn-confirm').on('click', function (e) {
            e.preventDefault();
            form.trigger('submit'); // submit the form
        });
    </script>
    <script>
        $('select[name="limit"]').change(function () {
            $(this).closest('form').trigger('submit');
        });
    </script>
<?php $this->end() ?>

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Paciente
        <small>Ficha</small>
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
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Código</label>
                            <p><?= $this->Number->format($patient->id) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <p><?= h($patient->name) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Sexo</label>
                            <p><?= $patient->sex === 'male' ? 'Macho' : 'Hembra' ?></p>
                        </div>
                        <div class="form-group">
                            <label>Propietario</label>
                            <p><a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'view', 'id' => $patient->customer->id]) ?>"><?= h($patient->customer->full_name_list) ?></a></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Raza</label>
                            <p><?= h($patient->breed->name) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Pelaje</label>
                            <p><?= h($patient->coat) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <p><?= h($patient->color) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Fecha de nacimiento</label>
                            <p><?= $patient->birthday != null ? $patient->birthday->format('d/m/Y') : 'Sin fecha' ?></p>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?= $this->Html->link('Observaciones', ['controller' => 'Observations', 'action' => 'index', 'patient_id' => $patient->id], ['class' => 'btn btn-primary']) ?>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Vacunaciones</h3>
                </div><!-- /.box-header -->
                <div class="box-header with-border">
                    <a class="btn btn-primary" href="<?= $this->Url->build(['controller' => 'Vaccinations', 'action' => 'add', 'patient_id' => $patient->id]) ?>"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
                    <?= $this->Form->create(null, ['url' => ['action' => 'view', 'id' => $patient->id], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
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
                        <?php if (!$vaccinations->isEmpty()): ?>
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('Vaccines.name', 'Vacuna') ?></th>
                                <th><?= $this->Paginator->sort('annotations', 'Anotaciones') ?></th>
                                <th><?= $this->Paginator->sort('vaccination_date', 'Fecha de vacunación') ?></th>
                                <th><?= $this->Paginator->sort('revaccination', 'Fecha de revacunación') ?></th>
                                <th><?= $this->Paginator->sort('revaccinated', 'Revacunado') ?></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vaccinations as $vaccination): ?>
                                <tr>
                                    <td><?= h($vaccination->vaccine->name) ?></td>
                                    <td><?= h($vaccination->annotations) ?></td>
                                    <td><?= $vaccination->vaccination_date->format('d/m/Y') ?></td>
                                    <td><?= $vaccination->revaccination->format('d/m/Y') ?></td>
                                    <td>
                                        <?php if ($vaccination->revaccinated == true): ?>
                                            <span class="glyphicon glyphicon-thumbs-up" style="color: #3c8dbc; font-size: 1.5em;"></span>
                                        <?php else: ?>
                                            <span class="glyphicon glyphicon-thumbs-down" style="color: #d73925; font-size: 1.5em;"></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Vaccinations', 'action' => 'edit', 'id' => $vaccination->id, 'patient_id' => $patient->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                                        <?= $this->Form->create(null, ['url' => ['controller' => 'Vaccinations', 'action' => 'delete', 'id' => $vaccination->id, 'patient_id' => $patient->id], 'type' => 'delete', 'style' => 'display: inline !important']) ?>
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
