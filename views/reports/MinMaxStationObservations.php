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

$this->title = 'Minimum & Maximum Observations ';
$this->params['breadcrumbs'][] = $this->title;
?>
&nbsp;
<div class="stakeholder-index">

    <?php echo $this->render('_form_min-max_station_observation', ['model' => $model]); ?>

    <?php
    if ($dataProvider) {
        $reporttitle = $this->title;
        if ($model->weather_element) {
            $reporttitle .= ' &nbsp; for  ' . \app\models\WeatherElements::getElementNameByCode($model->weather_element);
        }
        if ($model->station_id) {
            $reporttitle .= ' &nbsp;<b>Station:</b> ' . \app\models\Station::getNameById($model->station_id);
        }
        if ($model->date_start && $model->date_end) {
            $reporttitle .= ' &nbsp;<b>Date Range:</b> ' . Date('d-M-Y', strtotime($model->date_start)).' to '.Date('d-M-Y', strtotime($model->date_end));
        }
       
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'stationid',
                    'value' => function ($model) {
                        return app\models\Station::getNameById($model->stationid);
                    },
                ],
                [
                    'attribute' => 'MinValue',
                    'label' => 'Minimum Value',
                    'value' => 'MinValue',
                ],
                [
                    'attribute' => 'MaxValue',
                    'label' => 'Maximum Value',
                    'value' => 'MaxValue',
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