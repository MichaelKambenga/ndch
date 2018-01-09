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

$this->title = 'Station Observations ';
$this->params['breadcrumbs'][] = $this->title;
?>
&nbsp;
<div class="stakeholder-index">

    <?php echo $this->render('_form_daily_station_observation', ['model' => $model]); ?>

    <?php
    if ($dataProvider) {
        $reporttitle = $this->title;
        if ($model->station_id) {
            $reporttitle .= ' &nbsp;<b>Station:</b> ' . \app\models\Station::getNameById($model->station_id);
        }
        if ($model->date_start) {
            $reporttitle .= ' &nbsp;<b>From:</b> ' . Date('d-M-Y', strtotime($model->date_start));
        }
        if ($model->date_end) {
            $reporttitle .= ' &nbsp;<b>To:</b> ' . Date('d-M-Y', strtotime($model->date_end));
        }
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'TIME',
                    'value' => function ($model) {
                        return Date('d-m-Y H:i:s', strtotime($model->TIME));
                    },
                ],
                [
                    'attribute' => $model->weather_element,
                    'visible' => ($model->weather_element) ? TRUE : FALSE
                ], /// show this only one observation type is selected
                [
                    'attribute' => 'PA',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'DP',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'TA',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'WD',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'WS',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'PR',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'RH',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'SR',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
                ],
                [
                    'attribute' => 'ETO',
                    'visible' => (!$model->weather_element) ? TRUE : FALSE
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