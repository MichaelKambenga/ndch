<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\WeatherElements;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather Elements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create/Add Element', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                    'heading' => 'Weather Elements',
                    'type' => 'default',
                    'showFooter' => true
                ],
            ]);
            Pjax::end();
            ?>
</div>
