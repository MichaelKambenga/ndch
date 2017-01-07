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

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Station', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'stationcode',
           array(
'attribute' => 'stationtype',
 'value' => function ($model) {
return $model->getStationTypeName();
},
 ),
         array(
'attribute' => 'stationowner',
 'value' => function ($model) {
return Stakeholder::getStakeholderNameById($model->stationowner);
},
 ),
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
                    'heading' => 'STATIONS',
                    'type' => 'default',
                    'showFooter' => true
                ],
            ]);
            Pjax::end();
            ?>
</div>
