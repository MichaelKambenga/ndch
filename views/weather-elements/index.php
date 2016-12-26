<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeatherElementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather Elements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-elements-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Weather Elements', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'unitmeasure',
            'vaisalacode',
            'vaisaladesc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
