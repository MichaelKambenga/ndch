<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather Elements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

<?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'unitmeasure',
            'elementcode',
            ['class' => 'yii\grid\ActionColumn'],
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
