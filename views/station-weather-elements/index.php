<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StationWeatherElementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Station Weather Elements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-weather-elements-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Station Weather Elements', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'stationid',
            'elementsid',
            'collectionfrequency',
            'id',
            'accuracy',
            // 'surfacedistance',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
