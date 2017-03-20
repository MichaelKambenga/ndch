<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\WeatherData;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeatherDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Station Weather Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-data-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    if (!is_null(\yii::$app->user->identity->stationid)) {
    ?>
    <p>
        <?= Html::a('Post Station Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

    <?=
    GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],
    [
    'attribute' => 'StationName',
    'value' => function ($model) {
    return \app\models\Station::getNameById($model->stationid);
    },
    ],
    [
    'attribute' => 'TIME',
    'format' => ['date', 'php:d-m-Y @ H:i']
    ],
    'PA',
    'PR',
    'RH',
    'TA',
    ////'SR',
    // 'WD',
    // 'WS',
//    'QFE',
//    'QFF',
//    'QNH',
    // 'ETO',
    ['class' => 'yii\grid\ActionColumn',
    'template' => '{view}  {update}  {delete}',
    'buttons' => [
    'update' => function ($url, $model, $key) {
    return (($model->source === WeatherData::DATA_DOURCE_MANNED_SYSTEM) && (Date('Y-m-d',  strtotime($model->TIME))===Date('Y-m-d',  time()))&& ($model->stationid===\yii::$app->user->identity->stationid)) ? Html::a('update', $url) : '';
    },
//    'delete' => function ($url, $model, $key) {
//    return (($model->source === WeatherData::DATA_DOURCE_MANNED_SYSTEM) && ($model->stationid===\yii::$app->user->identity->stationid)) ? Html::a('delete', $url) : '';
//    },
    ]
    ],
    ],
    ]);
    ?>
</div>
