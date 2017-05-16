<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Stakeholder;
use app\models\DataSources;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Sources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <p>
        <?php echo Html::a('Create/Add Data Source', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'ipaddress',
            'datalocation',
         array(
            'attribute' => 'stakeholderid',
             'value' => function ($model) {
            return Stakeholder::getStakeholderNameById($model->stakeholderid);
            },
         ),

         array(
             'attribute' => 'datasourcetype',
             'value' => function ($model) {
             return $model->getDataSourceTypeName();
             },
             ),
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
//                    'heading' => 'Data Sources',
                    'type' => 'default',
                    'showFooter' => true
                ],
            ]);
            Pjax::end();
            ?>
</div>
