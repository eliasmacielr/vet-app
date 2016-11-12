<?php $this->assign('title-meta', 'Vet APP - Movimientos') ?>

<?php $this->append('css') ?>
    <?= $this->Html->css('vet-app') ?>
    <style>
        .center-table
        {
            margin: 0 auto !important;
            float: none !important;
        }
    </style>
<?php $this->end() ?>

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
        Movimientos
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
                            <?= $this->form->select('limit', ['10' => '10', '25' => '25', '50' => '50', '100' => '100'], ['class' => 'form-control input-sm pull-right', 'value' => strcmp($this->request->query('limit'), '50') === 0 ? h($this->request->query('limit')) : '50']) ?>
                        </div>
                        <div style="width: 150px;" class="input-group">
                            <input type="text" placeholder="<?= ucfirst(__('search')) ?>" class="form-control input-sm pull-right" name="q" value="<?= h($this->request->query('q')) ?>">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                </div><!-- /.box-header -->
                <div class="box-header">
                    <?= $this->Html->link('Hoy', ['action' => 'index'], ['class' => 'btn btn-success']) ?>
                    <div class="input-group pull-right">
                        <?php echo $this->form->day('date', [
                                'class' => 'form-control input-sm',
                                'style' => 'width: 50px',
                                'empty' => false,
                                'value' => $date->format('d')
                            ])
                        ?>
                        <?php echo $this->form->month('date', [
                                'class' => 'form-control input-sm',
                                'style' => 'width: 100px',
                                'empty' => false,
                                'value' => $date->format('m')
                            ])
                        ?>
                        <?php echo $this->form->year('date', [
                                'class' => 'form-control input-sm pull-right',
                                'style' => 'width: 75px',
                                'empty' => false,
                                'minYear' => 2000,
                                'maxYear' => 2099,
                                'orderYear' => 'asc',
                                'value' => $date->format('Y')
                            ])
                        ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <?php if (!$movements->isEmpty()): ?>
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('concept', 'Concepto') ?></th>
                                <th><?= $this->Paginator->sort('amount', 'Entrada') ?></th>
                                <th><?= $this->Paginator->sort('amount', 'Salida') ?></th>
                                <th><?= $this->Paginator->sort('movement_date', 'Fecha') ?></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($movements as $movement): ?>
                                <tr>
                                    <td><?= h($movement->concept) ?></td>
                                    <td class="balance">
                                        <?php if ($movement->type == 'income'): ?>
                                            <?= $this->Number->format($movement->amount) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="balance">
                                        <?php if ($movement->type == 'outcome'): ?>
                                            <?= $this->Number->format($movement->amount) ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $movement->movement_date->format('d/m/Y') ?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['action' => 'edit', 'id' => $movement->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                        <?= $this->Form->create(null, ['url' => ['action' => 'delete', 'id' => $movement->id], 'type' => 'delete', 'style' => 'display: inline !important']) ?>
                                        <button name="delete-btn" class="btn btn-danger" type="button">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </button>
                                        <?= $this->Form->end() ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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
                    <?php if (!$movements->isEmpty()): ?>
                        <div class="box-body table-responsive no-padding col-md-8 center-table">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Total Entrada</th>
                                        <th>Total Salida</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="balance"><?= $this->Number->format($sum_result->income) ?></td>
                                        <td class="balance"><?= $this->Number->format($sum_result->outcome) ?></td>
                                        <td>
                                            <p class="balance balance-<?= $sum_result->income - $sum_result->outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($sum_result->income - $sum_result->outcome) ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
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
