<?php $this->assign('title-meta', 'Vet APP - Movimientos resumen') ?>

<?php $this->append('css') ?>
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
                                'value' => $date->format('Y')
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
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Enero
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->jan_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->jan_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Febrero
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->feb_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->feb_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Marzo
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->mar_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->mar_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Abril
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->apr_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->apr_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Mayo
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->may_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->may_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Junio
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->june_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->june_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Julio
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->july_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->july_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Agosto
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->aug_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->aug_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Setiembre
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->sept_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->sept_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Octubre
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->oct_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->oct_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Noviembre
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->nov_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->nov_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Diciembre
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->dec_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->dec_outcome) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    Total
                                </td>
                                <td style="text-align: right"><?= $this->Number->format($resume->total_income) ?></td>
                                <td style="text-align: right"><?= $this->Number->format($resume->total_outcome) ?></td>
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
                                    <td style="text-align: right">
                                        <?php if ($resume->total_income - $resume->total_outcome >= 0): ?>
                                            <p style="color: #008305"><?= $this->Number->format($resume->total_income - $resume->total_outcome) ?></p>
                                        <?php else: ?>
                                            <p style="color: #ff0000"><?= $this->Number->format($resume->total_income - $resume->total_outcome) ?></p>
                                        <?php endif; ?>
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
