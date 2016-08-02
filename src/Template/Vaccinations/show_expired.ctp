<?php $this->assign('title-meta', 'Vet APP - Vacunas vencidas') ?>

<?php $this->append('js') ?>
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
        Vacunaciones
        <small></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3>Vencidos</h3>
                    <?= $this->Form->create(null, ['url' => ['action' => 'showExpired'], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
                    <div class="input-group pull-right">
                        <?= $this->form->select('limit', ['10' => '10', '25' => '25', '50' => '50', '100' => '100'], ['class' => 'form-control input-sm pull-right', 'value' => h($this->request->query('limit'))]) ?>
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
                                <th><?= $this->Paginator->sort('revaccination', 'Fecha de revacunación') ?></th>
                                <th><?= $this->Paginator->sort('Vaccines.name', 'Vacuna') ?></th>
                                <th><?= $this->Paginator->sort('Patients.name', 'Paciente') ?></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vaccinations as $vaccination): ?>
                                <tr>
                                    <td><?= $vaccination->revaccination->format('d/m/Y') ?></td>
                                    <td><?= h($vaccination->vaccine->name) ?></td>
                                    <td><?= h($vaccination->patient->name) ?></td>
                                    <td>
                                        <a href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'view', 'id' => $vaccination->patient->id]) ?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
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
