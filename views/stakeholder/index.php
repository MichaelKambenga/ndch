<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stakeholders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'mobileno',
            'email',
            [
                'attribute' => 'orgtype',
                'value' => function ($model) {
                    return $model->getOrgTypeName();
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
//             [
//                'label' => 'Action',
//                'value' => function($model) {
//                    return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i> More</span>', Yii::$app->urlManager->createUrl(['stakeholder/view', 'id' => $model->id]), [
//                                'title' => Yii::t('yii', 'View Details'),
//                    ]);
//                },
//                       'format' => 'raw',
//                    ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Stakeholder', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => true
        ],
    ]);
    Pjax::end();
    ?>
</div>
