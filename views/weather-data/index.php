<?php
use yii\helpers\Html;
use yii\grid\GridView;

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
    'format' => ['date', 'php:d-m-Y @ H:i:s']
    ],
    'PA',
    'PR',
    'RH',
    'SR',
    'TA',
    // 'WD',
    // 'WS',
//    'QFE',
//    'QFF',
//    'QNH',
    // 'ETO',
    ['class' => 'yii\grid\ActionColumn'],
    ],
    ]);
    ?>
</div>
