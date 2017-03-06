<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */

$this->title = 'Station Weather Data';
$stationName = \app\models\Station::getNameById($model->stationid);
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $stationName;
?>
<!--$model->TIME-->
<div class="weather-data-view">

    <h3 style="max-width: 90%"><?= Html::encode($this->title) ?>  <span class="title">Station Name: <?php echo $stationName; ?></span></h3>
    <div style="width: auto; min-width: 65%;max-width: 90%">
        <?=
        DetailView::widget([
        'model' => $model,
        'attributes' => [
        [
        'attribute' => 'source',
        'value' => function ($model) {
        return $model->getSourceNameByValue();
        },
        'format' => ['text']
        ],
        [
        'attribute' => 'TIME',
         'label'=>'Date Recorded',
        'format' => ['date', 'php:d-M-Y @ H:i:s']
        ],
        'DP',
        'DP1HA',
        'DP1HX',
        'DP1HM',
        'PA',
        'PA1HA',
        'PA1HX',
        'PA1HM',
        'PR',
        'PR1HS',
        'PR24HS',
        'PR5MS00',
        'PR5MS05',
        'PR5MS10',
        'PR5MS15',
        'PR5MS20',
        'PR5MS25',
        'PR5MS30',
        'PR5MS35',
        'PR5MS40',
        'PR5MS45',
        'PR5MS50',
        'PR5MS55',
        'RH',
        'RH1HA',
        'RH1HX',
        'RH1HM',
        'SR',
        'SR1HA',
        'SR1HX',
        'SR1HM',
        'TA',
        'TA1HA',
        'TA1HX',
        'TA1HM',
        'WD',
        'WD2MA',
        'WD10MA',
        'WD2MX',
        'WD10MX',
        'WD2MM',
        'WD10MM',
        'WD1HA',
        'WD1HX',
        'WD1HM',
        'WS',
        'WS2MA',
        'WS10MA',
        'WS2MX',
        'WS10MX',
        'WS2MM',
        'WS10MM',
        'QFE',
        'QFE1HA',
        'QFE1HX',
        'QFE1HM',
        'QFF',
        'QFF1HA',
        'QFF1HX',
        'QFF1HM',
        'QNH',
        'QNH1HA',
        'QNH1HX',
        'QNH1HM',
        'ETO',
        ],
        ])
        ?>
    </div>
</div>
