<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwsSebaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aws Sebas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-seba-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'entrydate',
            'time',
            'stationname',
            'D',
            'U',
            // 'PL',
            // 'TL',
            // 'G',
            // 'CH',
            // 'id',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'before' => Html::a('<i class="glyphicon glyphicon-import"></i> Import Data', ['create'], ['class' => 'btn btn-success']),
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => true
        ],
    ]);
    ?>
</div>
