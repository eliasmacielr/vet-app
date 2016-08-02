<?php $this->assign('title-meta', 'Vet APP - Clientes') ?>

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

<!--Content Wrapper. Contains page content -->
<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Clientes
        <small></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?= $this->Html->link('Agregar', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
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
                        <?php if (!$customers->isEmpty()): ?>
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('id', 'Código') ?></th>
                                <th><?= $this->Paginator->sort('name', 'Nombre') ?></th>
                                <th><?= $this->Paginator->sort('last_name', 'Apellido') ?></th>
                                <th><?= $this->Paginator->sort('phone', 'Teléfono') ?></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td><?= h($customer->id) ?></td>
                                    <td><?= h($customer->name) ?></td>
                                    <td><?= h($customer->last_name) ?></td>
                                    <td><?= h($customer->phone) ?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['action' => 'view', 'id' => $customer->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                        <a href="<?= $this->Url->build(['action' => 'edit', 'id' => $customer->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                        <?= $this->Form->create(null, ['url' => ['action' => 'delete', 'id' => $customer->id], 'type' => 'delete', 'style' => 'display: inline !important']) ?>
                                        <button name="delete-btn" class="btn btn-danger" type="button">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
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
