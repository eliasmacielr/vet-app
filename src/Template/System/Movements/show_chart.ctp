<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet APP - Movimientos resumen gráfico') ?>

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
    <?= $this->Html->script('/adminlte/plugins/chartjs/Chart.min.js') ?>
    <script>
        $('#year').change(function () {
            $(this).closest('form').trigger('submit');
        });
    </script>
    <script>
        var areaChartData = {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [
                {
                    label: "Entrada",
                    fillColor: "rgb(0, 131, 5)",
                    strokeColor: "rgb(0, 131, 5)",
                    pointColor: "rgb(0, 131, 5)",
                    pointStrokeColor: "#008305",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgb(0, 131, 5)",
                    data: [
                        <?= $resume->jan_income ?>,
                        <?= $resume->feb_income ?>,
                        <?= $resume->mar_income ?>,
                        <?= $resume->apr_income ?>,
                        <?= $resume->may_income ?>,
                        <?= $resume->june_income ?>,
                        <?= $resume->july_income ?>,
                        <?= $resume->aug_income ?>,
                        <?= $resume->sept_income ?>,
                        <?= $resume->oct_income ?>,
                        <?= $resume->nov_income ?>,
                        <?= $resume->dec_income ?>
                    ]
                },
                {
                    label: "Salida",
                    fillColor: "rgb(255, 0, 0)",
                    strokeColor: "rgb(255, 0, 0)",
                    pointColor: "#ff0000",
                    pointStrokeColor: "rgb(255, 0, 0)",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgb(255, 0, 0)",
                    data: [
                        <?= $resume->jan_outcome ?>,
                        <?= $resume->feb_outcome ?>,
                        <?= $resume->mar_outcome ?>,
                        <?= $resume->apr_outcome ?>,
                        <?= $resume->may_outcome ?>,
                        <?= $resume->june_outcome ?>,
                        <?= $resume->july_outcome ?>,
                        <?= $resume->aug_outcome ?>,
                        <?= $resume->sept_outcome ?>,
                        <?= $resume->oct_outcome ?>,
                        <?= $resume->nov_outcome ?>,
                        <?= $resume->dec_outcome ?>,
                    ]
                }
            ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: true,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        var lineChartOptions = areaChartOptions;
        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData, lineChartOptions);
    </script>
<?php $this->end() ?>

<!--Content Wrapper. Contains page content -->
<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Movimientos resumen gráfico
        <small><?= $date->format('Y') ?></small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <?= $this->Form->create(null, ['url' => ['action' => 'show-chart'], 'type' => 'get', 'class' => 'form-inline pull-right']) ?>
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
                <div class="box-body">
                    <div class="chart">
                        <canvas id="lineChart" style="height:400px"></canvas>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix"> <!-- box-footer -->

                </div> <!-- /.box-footer -->
            </div>
        </div>
    </div>
</section><!--/.content -->
