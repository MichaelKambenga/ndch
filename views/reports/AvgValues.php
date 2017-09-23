<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daily Average Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <?php echo $this->render('ReportFilterForm', ['model' => $model]); ?>


    <?php
    if ($dataProvider):
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'TIME'],
                [
                    'attribute' => 'StationName',
                    'value' => function ($model) {
                        return \app\models\Station::getNameById($model->stationid);
                    },
                ],
                [
                    'attribute' => 'stationid',
                    'value' => function ($model) {
                        return \app\models\Station::getNameById($model->stationid);
                    },
                ],
//            ['attribute' => 'DP'],
                ['attribute' => 'PA'],
                ['attribute' => 'PR'],
                ['attribute' => 'RH'],
                ['attribute' => 'TA'],
//            ['attribute' => 'WD'],
                ['attribute' => 'WS'],
//            ['class' => 'yii\grid\ActionColumn'],
            ],
            'responsive' => true,
            'hover' => true,
            'condensed' => true,
            'floatHeader' => false,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
                'type' => 'info',
//            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Region', ['create'], ['class' => 'btn btn-success']),
//            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
                'showFooter' => true
            ],
        ]);
        Pjax::end();
    endif;
    ?>   

</div>
