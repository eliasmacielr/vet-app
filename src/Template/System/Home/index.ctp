<?php $this->layout = 'system' ?>

<?php $this->assign('title-meta', 'Vet APP - Inicio Panel') ?>

<!--Content Wrapper. Contains page content -->
<!--Content Header (Page header) -->
<section class = "content-header">
    <h1>
        Inicio
        <small>Panel</small>
    </h1>
</section>

<!--Main content -->
<section class = "content">
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $customers_count ?></h3>
                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-people"></i>
                </div>
                <a href="<?= $this->Url->build(['controller' => 'Customers', 'action' => 'index']) ?>" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $patients_count ?></h3>
                    <p>Pacientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-medkit"></i>
                </div>
                <a href="<?= $this->Url->build(['controller' => 'Patients', 'action' => 'index']) ?>" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?= $expired_today_count ?></h3>
                    <p>Vacunas vencidas hoy</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a href="<?= $this->Url->build(['controller' => 'Vaccinations', 'action' => 'showExpired']) ?>" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-6 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $total_expired_count ?></h3>
                    <p>Vacunas vencidas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-clipboard"></i>
                </div>
                <a href="<?= $this->Url->build(['controller' => 'Vaccinations', 'action' => 'showExpired']) ?>" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
    </div>
</section><!--/.content -->
