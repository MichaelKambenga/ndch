<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeatherDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Weather Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             'stationid',
             'weatherelementid',
            'value',
            [
            'label'=>'daterecorded',
            ],
            'source',
           ['class' => 'yii\grid\ActionColumn'],
        ],
             'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => ' ',
            'type' => 'default',
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end();
    ?>
</div>
