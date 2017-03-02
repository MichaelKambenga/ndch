<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\District;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'wardname',
            [
                'attribute' => 'districtid',
                'value' => function ($model) {
                    return District::getDistrictNameById($model->districtid);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Ward', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => true
        ],
    ]);
    Pjax::end();
    ?>
</div>
