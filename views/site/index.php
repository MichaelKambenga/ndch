<?php

use miloschuman\highcharts\Highcharts;
use app\models\Station;
use app\models\WeatherData;

/* @var $this yii\web\View */
//$this->title = 'My Yii Application';
?>

<section class="content-header">
    <h1>
        NDCH System- Dashboard
<!--        <small>to the National Database for Climate and Hydrology-(NDCH)</small>-->
    </h1>

</section>

<?php
if (Yii::$app->session->has('organizationUser')) {
    ?>

    <div class="row" style="margin-top: 2%;">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">TOP 5 REPORTING STATIONS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>NAME</th>
                            <th>OBSERVATIONS</th>
                            <th>STATION TYPE</th>
                            <th>OWNER</th>
                        </tr>
                        <?php
                        if (isset($top_reporting_stations) && $top_reporting_stations) {
                            foreach ($top_reporting_stations as $top_reporting_station) {
                                $station_details = Station::findOne(['id' => $top_reporting_station->stationid]);
                                ?>
                                <tr>
                                    <td><?php echo $station_details->name; ?></td>
                                    <td><?php echo $top_reporting_station->counts; ?></td>
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
                    <h3 class="box-title">LATEST 5 OBSERVATIONS</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>TIME</th>
                            <th>STATION</th>
                            <th>TYPE</th>
                            <th>OWNER</th>
                        </tr>
                        <?php
                        if (isset($recent_observations) && $recent_observations) {
                            foreach ($recent_observations as $recent_observations) {
                                $station_details = Station::findOne(['id' => $recent_observations->stationid]);
                                ?>
                                <tr>
                                    <td><?php echo Date('d-M-Y H:i:s', strtotime($recent_observations->TIME)); ?></td>
                                    <td><?php echo $station_details->name; ?></td>
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
if (Yii::$app->session->has('stationUser')) {
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
                        $vaisala_station_models = WeatherData::find()->where('stationid = :stationid', [':stationid' => \yii::$app->user->identity->stationid])->orderBy('TIME DESC')->limit(5)->all();
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
        <h3 class="box-title">OBSERVATION REPORTING TRENDS</h3>

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
                        'categories' => [ 'May', 'June', 'July','Aug','Sept','Oct','Nov','Dec','Jan', 'Feb', 'March', 'April']
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'No of Days Reported']
                    ],
                    'series' => [
                        ['name' => 'Months', 'data' => [21, 50, 23,55,0,0,0,0, 20, 0, 0,0]],
                       // ['name' => 'SEBA', 'data' => [0, 0, 0, 0, 0, 0, 0,0,0,0,0,0]]
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
</div>
