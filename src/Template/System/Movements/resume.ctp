<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet APP - Movimientos resumen') ?>

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
        $('#year').change(function () {
            $(this).closest('form').trigger('submit');
        });
    </script>
<?php $this->end() ?>

<!--Content Wrapper. Contains page content -->
<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Movimientos resumen
        <small><?= $date->format('Y') ?></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?= $this->Form->create(null, ['url' => ['action' => 'resume'], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
                    <div class="input-group pull-right">
                        <?php echo $this->form->year('date', [
                                'id' => 'year',
                                'class' => 'form-control input-sm pull-right',
                                'style' => 'width: 75px',
                                'empty' => false,
                                'minYear' => 2000,
                                'maxYear' => 2099,
                                'orderYear' => 'asc',
                                'value' => $date->format('Y'),
                            ]);
                        ?>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Mes</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Diferencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Enero
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->jan_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->jan_outcome) ?></td>
                                <td class="balance balance-<?= $resume->jan_income - $resume->jan_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->jan_income - $resume->jan_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Febrero
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->feb_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->feb_outcome) ?></td>
                                <td class="balance balance-<?= $resume->feb_income - $resume->feb_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->feb_income - $resume->feb_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Marzo
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->mar_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->mar_outcome) ?></td>
                                <td class="balance balance-<?= $resume->mar_income - $resume->mar_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->mar_income - $resume->mar_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Abril
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->apr_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->apr_outcome) ?></td>
                                <td class="balance balance-<?= $resume->apr_income - $resume->apr_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->apr_income - $resume->apr_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Mayo
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->may_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->may_outcome) ?></td>
                                <td class="balance balance-<?= $resume->may_income - $resume->may_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->may_income - $resume->may_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Junio
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->june_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->june_outcome) ?></td>
                                <td class="balance balance-<?= $resume->june_income - $resume->june_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->june_income - $resume->june_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Julio
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->july_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->july_outcome) ?></td>
                                <td class="balance balance-<?= $resume->july_income - $resume->july_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->july_income - $resume->july_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Agosto
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->aug_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->aug_outcome) ?></td>
                                <td class="balance balance-<?= $resume->aug_income - $resume->aug_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->aug_income - $resume->aug_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Setiembre
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->sept_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->sept_outcome) ?></td>
                                <td class="balance balance-<?= $resume->sept_income - $resume->sept_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->sept_income - $resume->sept_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Octubre
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->oct_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->oct_outcome) ?></td>
                                <td class="balance balance-<?= $resume->oct_income - $resume->oct_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->oct_income - $resume->oct_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Noviembre
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->nov_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->nov_outcome) ?></td>
                                <td class="balance balance-<?= $resume->nov_income - $resume->nov_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->nov_income - $resume->nov_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Diciembre
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->dec_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->dec_outcome) ?></td>
                                <td class="balance balance-<?= $resume->dec_income - $resume->dec_outcome >= 0 ? 'positive' : 'negative' ?>"><?= $this->Number->format($resume->dec_income - $resume->dec_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td class="balance"><?= $this->Number->format($resume->total_income) ?></td>
                                <td class="balance"><?= $this->Number->format($resume->total_outcome) ?></td>
                            </tr>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix"> <!-- box-footer -->
                    <div class="box-body table-responsive no-padding col-sm-4 center-table">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Saldo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="balance balance-<?= $resume->total_income - $resume->total_outcome >= 0 ? 'positive' : 'negative'?>"><?= $this->Number->format($resume->total_income - $resume->total_outcome) ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.box-footer -->
            </div>
        </div>
    </div>
</section><!--/.content -->
