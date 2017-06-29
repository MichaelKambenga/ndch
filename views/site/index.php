<?php
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;

/* @var $this yii\web\View */

//$this->title = 'My Yii Application';
?>

<section class="content-header">
    <h1>
        Welcome
        <small>to the National Database for Climate and Hydroclimate-(NDCH)</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Welcome...</a></li>
    </ol>
</section>


<?php
if (Yii::$app->session->get('organizationUser') == 1) {
    ?>
    <div class="callout callout-info">
        <h4>Introduction!</h4>

        <p>This is an integrated database for climate/hydro information housed at Tanzania Meteorology Agency(TMA).As Organization user,you can:- 
        <ul>
            <li>View Weather Data for different Stations of different Organizations</li>
            <li>Manage Stations of your Organization including Station's users and Weather Elements</li>
            <li>Generate Reports for different Weather Data for all the Stations of different Organizations</li>
        </ul>
    </p>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="box">
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
                            <th>More</th>
                        </tr>
                        <tr>
                            <td>KIA</td>
                            <td>KIA-292</td>
                            <td>AUTOMATIC STATION</td>                          
                            <td>TMA</td>
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>JNIA</td>
                            <td>JNIA-865</td>
                            <td>MANNED STATION</td>                          
                            <td>TMA</td>
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>PANGANI BASIN HQ</td>
                            <td>PANGANI-435</td>
                            <td>BOTH (MANNED & AUTOMATIC)</td>                          
                            <td>MOW</td>
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-xs-6">
            <div class="box">
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
                            <th>More</th>
                        </tr>
                        <tr>
                            <td>KIA</td>
                            <td>KIA-292</td>
                            <td>AUTOMATIC STATION</td>                          
                            <td>TMA</td>
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>JNIA</td>
                            <td>JNIA-865</td>
                            <td>MANNED STATION</td>                          
                            <td>TMA</td>
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>PANGANI BASIN HQ</td>
                            <td>PANGANI-435</td>
                            <td>BOTH (MANNED & AUTOMATIC)</td>                          
                            <td>MOW</td>
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

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
                <canvas id="areaChart" style="height:250px"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
    </div>


<?php } ?>

<?php
if (Yii::$app->session->get('stationUser') == 1) {
    ?>
    <div class="callout callout-info">
        <h4>Introduction!</h4>

        <p>This is an integrated database for climate/hydro information housed at Tanzania Meteorology Agency(TMA).As a Station user,you can:- 
        <ul>
            <li>View your station's Weather Data</li>
            <li>Post your station's Weather Data</li>
            <li>Generate Reports for different Weather Data for your Station</li>
        </ul>
    </p>
    </div>


    <div class="row">
        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">MY STATION VAISALA LAST ENTRIES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>NAME</th>
                            <th>CODE</th>
                            <th>TYPE</th>
                            <th>More</th>
                        </tr>
                        <tr>
                            <td>KIA</td>
                            <td>KIA-292</td>
                            <td>AUTOMATIC STATION</td>                          
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>JNIA</td>
                            <td>JNIA-865</td>
                            <td>MANNED STATION</td>                          
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>PANGANI BASIN HQ</td>
                            <td>PANGANI-435</td>
                            <td>BOTH (MANNED & AUTOMATIC)</td>                          
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-xs-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">MY STATION SEBA LAST ENTRIES</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>NAME</th>
                            <th>CODE</th>
                            <th>TYPE</th>
                            <th>More</th>
                        </tr>
                        <tr>
                            <td>KIA</td>
                            <td>KIA-292</td>
                            <td>AUTOMATIC STATION</td>                          
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>JNIA</td>
                            <td>JNIA-865</td>
                            <td>MANNED STATION</td>                          
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                        <tr>
                            <td>PANGANI BASIN HQ</td>
                            <td>PANGANI-435</td>
                            <td>BOTH (MANNED & AUTOMATIC)</td>                          
                            <td><span class="label label-success">View Station</span></td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

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
                <canvas id="areaChart" style="height:250px"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
<?php } ?>
<div class="site-index">

    <div class="jumbotron">


    </div>

    <?php
    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Fruit Consumption'],
            'xAxis' => [
                'categories' => ['Apples', 'Bananas', 'Oranges']
            ],
            'yAxis' => [
                'title' => ['text' => 'Fruit eaten']
            ],
            'series' => [
                ['name' => 'Jane', 'data' => [1, 0, 4]],
                ['name' => 'John', 'data' => [5, 7, 3]]
            ]
        ]
    ]);
    ?>
</div>
</div>
