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

$this->title = 'Stations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'stationcode',
            [
                'attribute' => 'stationtype',
                'value' => function ($model) {
                    return $model->getStationTypeName();
                },
                'filter' => app\models\Station::getStationTypes(),
            ],
            [
                'attribute' => 'stationowner',
                'value' => function ($model) {
                    return Stakeholder::getStakeholderNameById($model->stationowner);
                },
                'filter' => yii\helpers\ArrayHelper::map(\app\models\Stakeholder::find()->orderBy('name')->asArray()->where('orgtype != :orgtype', [':orgtype' => \app\models\Stakeholder::ORG_TYPE_DATAREADONLY])->all(), 'id', 'name'),
            ],
            [
                'attribute' => 'regionid',
                'value' => function ($model) {
                    return Region::getRegionNameById($model->regionid);
                },
                'filter' => yii\helpers\ArrayHelper::map(\app\models\Region::find()->orderBy('regionname')->asArray()->all(), 'id', 'regionname'),
            ],
            [
                'attribute' => 'districtid',
                'value' => function ($model) {
                    return District::getDistrictNameById($model->districtid);
                },
                'filter' => yii\helpers\ArrayHelper::map(\app\models\District::find()->orderBy('districtname')->asArray()->all(), 'id', 'districtname'),
            ],
            ['class' => 'yii\grid\ActionColumn'],
//            [
//                'label' => 'Action',
//                'value' => function($model) {
//
//                    return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i> More</span>', Yii::$app->urlManager->createUrl(['station/view', 'id' => $model->id]), [
//                                'title' => Yii::t('yii', 'View Details'),
//                    ]);
//                },
//                        'format' => 'raw',
//            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Station', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => true,
        ],
    ]);
    Pjax::end();
    ?>
</div>
