<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Stakeholder;
use app\models\Region;
use app\models\District;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stations Latest Observations Report ';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class=" search">-->
<?php echo $this->render('_form_stations_latest_observation', ['model' => $model]); ?>
<!--</div>-->
<div class="stakeholder-index">

    <?php
    if ($dataProvider) {
        $reporttitle = $this->title;
        if ($model->station_id) {
            $reporttitle .= ' &nbsp;<b>Station:</b> ' . \app\models\Station::getNameById($model->station_id);
        }
        if ($model->weather_element) {
            $reporttitle .= ' &nbsp;<b>Observation Type:</b> ' . app\models\WeatherElements::getElementNameByCode($model->weather_element);
        }
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'TIME',
                    'value' => function ($data) {
                        return Date('d-m-Y H:i:s', strtotime($data->TIME));
                    },
                ],
                [
                    'attribute' => 'Station',
                    'value' => function ($data) {
                        return app\models\Station::getNameById($data->stationid);
                    },
                ],
                [
                    'attribute' => 'DP',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'DP');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'DP') ? TRUE : FALSE
                ],
                [
                    'attribute' => 'PA',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'PA');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'PA') ? TRUE : FALSE
                ],
                [
                    'attribute' => 'PR',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'PR');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'PR') ? TRUE : FALSE
                ],
                [
                    'attribute' => 'RH',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'RH');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'RH') ? TRUE : FALSE
                ], [
                    'attribute' => 'SR',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'SR');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'SR') ? TRUE : FALSE
                ],
                [
                    'attribute' => 'TA',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'TA');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'TA') ? TRUE : FALSE
                ],
                ['attribute' => 'WS',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'WS');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'WS') ? TRUE : FALSE
                ],
                [
                    'attribute' => 'WD',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'WD');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'WD') ? TRUE : FALSE
                ],
                [
                    'attribute' => 'ETO',
                    'value' => function ($data) {
                        return app\models\ReportFilterForm::getStationDataStationIDandByDate($data->stationid, $data->TIME, 'ETO');
                    },
                    'visible' => (!$model->weather_element OR $model->weather_element == 'ETO') ? TRUE : FALSE
                ],
            ],
            'responsive' => true,
            'hover' => true,
            'condensed' => true,
            'floatHeader' => false,
            'panel' => [
                'heading' => '<h6 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . $reporttitle . ' </h5>',
                'type' => 'info',
                'showFooter' => true,
            ],
        ]);
        Pjax::end();
    }
    ?>  
</div>