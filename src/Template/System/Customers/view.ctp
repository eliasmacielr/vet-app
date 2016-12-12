<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet APP - Cliente') ?>

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

<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Cliente
        <small></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del cliente</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Código</label>
                            <p><?= $this->Number->format($customer->id) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Nombre</label>
                            <p><?= h($customer->name) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Apellido</label>
                            <p><?= h($customer->last_name) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <p><?= h($customer->email) ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Teléfono</label>
                            <p><?= h($customer->phone) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Teléfono 2</label>
                            <p><?= h($customer->phone_other) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Ciudad</label>
                            <p><?= h($customer->location->name) ?></p>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <p><?= h($customer->address) ?></p>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">

                </div>
            </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Pacientes</h3>
                </div><!-- /.box-header -->
                <div class="box-header with-border">
                    <a class="btn btn-primary" href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'add', 'customer_id' => $customer->id]) ?>"><span class="glyphicon glyphicon-plus"></span> Agregar</a>
                    <?= $this->Form->create(null, ['url' => ['action' => 'view', 'id' => $customer->id], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
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
                        <?php if (!$patients->isEmpty()): ?>
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id', 'Código') ?></th>
                                <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                                <th><?= $this->Paginator->sort('sex', 'Sexo') ?></th>
                                <th><?= $this->Paginator->sort('Breeds.name', 'Raza') ?></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patients as $patient): ?>
                                <tr>
                                    <td><?= h($patient->id) ?></td>
                                    <td><?= h($patient->name) ?></td>
                                    <td><?= h($patient->sex === 'male' ? 'Macho' : 'Hembra') ?></td>
                                    <td><?= h($patient->breed->name) ?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'view', 'id' => $patient->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a>
                                        <a href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'edit', 'id' => $patient->id, 'customer_id' => $customer->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                                        <?= $this->Form->create(null, ['url' => ['controller' => 'Patients', 'action' => 'delete', 'id' => $patient->id, 'customer_id' => $customer->id], 'type' => 'delete', 'style' => 'display: inline !important']) ?>
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
