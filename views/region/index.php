<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Regions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create/Add Region', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'regionname',
              array(
                'attribute'=>'datecreated',
                 'format' => ['date', 'php:d-M-Y @ H:i:s']
                ),

            ['class' => 'yii\grid\ActionColumn'],

            ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => false,
                'panel' => [
                    'heading' => 'Regions',
                    'type' => 'default',
                    'showFooter' => true
                ],
            ]);
            Pjax::end();
            ?>
</div>
