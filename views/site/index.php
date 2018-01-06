<?php

use miloschuman\highcharts\Highcharts;
use app\models\Station;
use app\models\WeatherData;

/* @var $this yii\web\View */
//$this->title = 'My Yii Application';
?>

<section class="content-header">
    <h1>
        Welcome
        <small>to the National Database for Climate and Hydroclimate-(NDCH)</small>
    </h1>

</section>

<?php
if (Yii::$app->session->get('organizationUser') == 1) {
    ?>

    <div class="row" style="margin-top: 2%;">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">TOP 3 VAISALA REPORTING STATIONS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>NAME</th>
                            <th>CODE</th>
                            <th>TYPE</th>
                            <th>OWNER</th>
                        </tr>
                        <?php
                        if (isset($vaisala_org_models) && $vaisala_org_models) {
                            foreach ($vaisala_org_models as $vaisala_org_model) {
                                $station_details = Station::findOne(['id' => $vaisala_org_model->stationid]);
                                ?>
                                <tr>
                                    <td><?php echo $station_details->name; ?></td>
                                    <td><?php echo $station_details->stationcode; ?></td>
                                    <td><?php echo $station_details->getStationTypeName(); ?></td>                          
                                    <td><?php echo \app\models\Stakeholder::getStakeholderNameById($station_details->stationowner); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">TOP 3 SEBA REPORTING STATIONS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>NAME</th>
                            <th>CODE</th>
                            <th>TYPE</th>
                            <th>OWNER</th>
                        </tr>
                        <?php
                        if (isset($seba_org_models) && $seba_org_models) {
                            foreach ($seba_org_models as $seba_org_model) {
                                $station_details = Station::findOne(['id' => $seba_org_model->stationid]);
                                ?>
                                <tr>
                                    <td><?php echo $station_details->name; ?></td>
                                    <td><?php echo $station_details->stationcode; ?></td>
                                    <td><?php echo $station_details->getStationTypeName(); ?></td>                          
                                    <td><?php echo \app\models\Stakeholder::getStakeholderNameById($station_details->stationowner); ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

<?php } ?>

<?php
if (Yii::$app->session->get('stationUser') == 1) {
    ?>
    <div class="callout callout-info">

    </div>


    <div class="row">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">MY STATION:  LATEST OBSERVATIONS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>TIME</th>
                            <th>PA</th>
                            <th>RH</th>
                            <th>SR</th>
                            <th>TA</th>
                            <th>More</th>
                        </tr>

                        <?php
                        $vaisala_station_models = WeatherData::find()->where('stationid = :stationid', [':stationid' => \yii::$app->user->identity->stationid])->andWhere(['source' => 2])->limit(3)->all();
                        if (isset($vaisala_station_models) && $vaisala_station_models) {
                            foreach ($vaisala_station_models as $vaisala_station_model) {
                                ?>
                                <tr>
                                    <td><?php echo $vaisala_station_model->TIME; ?></td>
                                    <td><?php echo $vaisala_station_model->PA; ?></td>
                                    <td><?php echo $vaisala_station_model->RH; ?></td>                          
                                    <td><?php echo $vaisala_station_model->SR; ?></td>
                                    <td><?php echo $vaisala_station_model->TA; ?></td>
                                    <td><span class="label label-success">View More</span></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">MY STATION:  LATEST OBSERVATIONS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>TIME</th>
                            <th>PA</th>
                            <th>RH</th>
                            <th>SR</th>
                            <th>TA</th>
                            <th>More</th>
                        </tr>
                        <?php
                        $seba_station_models = WeatherData::find()->where('stationid = :stationid', [':stationid' => \yii::$app->user->identity->stationid])->andWhere(['source' => 1])->limit(3)->all();
                        if ($seba_station_models) {
                            foreach ($seba_station_models as $seba_station_model) {
                                ?>
                                <tr>
                                    <td><?php echo $seba_station_model->TIME; ?></td>
                                    <td><?php echo $seba_station_model->PA; ?></td>
                                    <td><?php echo $seba_station_model->RH; ?></td>                          
                                    <td><?php echo $seba_station_model->SR; ?></td>
                                    <td><?php echo $seba_station_model->TA; ?></td>
                                    <td><span class="label label-success">View More</span></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

<?php } ?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">VAISALA vs SEBA REPORTINGS</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="chart">
            <!--<canvas id="areaChart" style="height:250px"></canvas>-->
            <?php
            echo Highcharts::widget([
                'options' => [
                    'title' => ['text' => ''],
                    'xAxis' => [
                        'categories' => ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July']
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Number of Days Reported in a Month']
                    ],
                    'series' => [
                        ['name' => 'VAISALA', 'data' => [18, 14, 22, 17, 21, 23, 19]],
                        ['name' => 'SEBA', 'data' => [21, 24, 23, 19, 30, 25, 29]]
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
</div>
