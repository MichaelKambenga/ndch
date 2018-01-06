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

$this->title = 'Registered Stations';
$this->params['breadcrumbs'][] = $this->title;
?>
&nbsp;
<div class="stakeholder-index">

    <?php echo $this->render('GeneralReportFilterForm', ['model' => $model]); ?>


    <?php
    if ($dataProvider) {
        $reporttitle = $this->title;
        if ($model->station_type) {
            $reporttitle .= ' &nbsp;<b>Type:</b> ' . \app\models\Station::getStationTypeNameByValue($model->station_type);
        }
        if ($model->owner) {
            $reporttitle .= ' &nbsp;<b>Owner:</b> ' . \app\models\Stakeholder::getStakeholderNameById($model->owner);
        }
        if ($model->region_id) {
            $reporttitle .= ' &nbsp;<b>Region:</b> ' . \app\models\Region::getRegionNameById($model->region_id);
        }
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'stationcode',
                [
                    'attribute' => 'stationtype',
                    'value' => function ($model) {
                        return $model->getStationTypeName();
                    },
                ],
                [
                    'attribute' => 'stationowner',
                    'value' => function ($model) {
                        return Stakeholder::getStakeholderNameById($model->stationowner);
                    },
                ],
            [
                'attribute' => 'regionid',
                'value' => function ($model) {
                    return Region::getRegionNameById($model->regionid);
                },
            ],
                [
                    'attribute' => 'districtid',
                    'value' => function ($model) {
                        return District::getDistrictNameById($model->districtid);
                    },
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
