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
        'label' => 'Date Recorded',
        'format' => ['date', 'php:d-M-Y @ H:i:s']
        ],
        [
        'attribute' => 'DP',
        'value' => $model->DP,
        'visible' => $model->DP?TRUE:FALSE
        ],
        [
        'attribute' => 'DP1HA',
        'value' => $model->DP1HA,
        'visible' => $model->DP1HA?TRUE:FALSE
        ],
        [
        'attribute' => 'DP1HX',
        'value' => $model->DP1HX,
        'visible' => $model->DP1HX?TRUE:FALSE
        ],
        [
        'attribute' => 'DP1HM',
        'value' => $model->DP1HM,
        'visible' => $model->DP1HM?TRUE:FALSE
        ],
        [
        'attribute' => 'PA',
        'value' => $model->PA,
        'visible' => $model->PA?TRUE:FALSE
        ],
        [
        'attribute' => 'PA1HA',
        'value' => $model->PA1HA,
        'visible' => $model->PA1HA?TRUE:FALSE
        ],
        [
        'attribute' => 'PA1HX',
        'value' => $model->PA1HX,
        'visible' => $model->PA1HX?TRUE:FALSE
        ],
        [
        'attribute' => 'PA1HM',
        'value' => $model->PA1HM,
        'visible' => $model->PA1HM?TRUE:FALSE
        ],
        [
        'attribute' => 'PR',
        'value' => $model->PR,
        'visible' => $model->PR?TRUE:FALSE
        ],
        [
        'attribute' => 'PR1HS',
        'value' => $model->PR1HS,
        'visible' => $model->PR1HS?TRUE:FALSE
        ],
        [
        'attribute' => 'PR24HS',
        'value' => $model->PR24HS,
        'visible' => $model->PR24HS?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS00',
        'value' => $model->PR5MS00,
        'visible' => $model->PR5MS00?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS05',
        'value' => $model->PR5MS05,
        'visible' => $model->PR5MS05?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS10',
        'value' => $model->PR5MS10,
        'visible' => $model->PR5MS10?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS15',
        'value' => $model->PR5MS15,
        'visible' => $model->PR5MS15?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS20',
        'value' => $model->PR5MS20,
        'visible' => $model->PR5MS20?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS25',
        'value' => $model->PR5MS25,
        'visible' => $model->PR5MS25?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS30',
        'value' => $model->PR5MS30,
        'visible' => $model->PR5MS30?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS35',
        'value' => $model->PR5MS35,
        'visible' => $model->PR5MS35?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS40',
        'value' => $model->PR5MS40,
        'visible' => $model->PR5MS40?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS45',
        'value' => $model->PR5MS45,
        'visible' => $model->PR5MS45?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS50',
        'value' => $model->PR5MS50,
        'visible' => $model->PR5MS50?TRUE:FALSE
        ],
        [
        'attribute' => 'PR5MS55',
        'value' => $model->PR5MS55,
        'visible' => $model->PR5MS55?TRUE:FALSE
        ],
        [
        'attribute' => 'RH',
        'value' => $model->RH,
        'visible' => $model->RH?TRUE:FALSE
        ],
        [
        'attribute' => 'RH1HA',
        'value' => $model->RH1HA,
        'visible' => $model->RH1HA?TRUE:FALSE
        ],
        [
        'attribute' => 'RH1HX',
        'value' => $model->RH1HX,
        'visible' => $model->RH1HX?TRUE:FALSE
        ],
        [
        'attribute' => 'RH1HM',
        'value' => $model->RH1HM,
        'visible' => $model->RH1HM?TRUE:FALSE
        ],
        [
        'attribute' => 'SR',
        'value' => $model->SR,
        'visible' => $model->SR?TRUE:FALSE
        ],
        [
        'attribute' => 'SR1HA',
        'value' => $model->SR1HA,
        'visible' => $model->SR1HA?TRUE:FALSE
        ],
        [
        'attribute' => 'SR1HX',
        'value' => $model->SR1HX,
        'visible' => $model->SR1HX?TRUE:FALSE
        ],
        [
        'attribute' => 'SR1HM',
        'value' => $model->SR1HM,
        'visible' => $model->SR1HM?TRUE:FALSE
        ],
        [
        'attribute' => 'TA',
        'value' => $model->TA,
        'visible' => $model->TA?TRUE:FALSE
        ],
        [
        'attribute' => 'TA1HA',
        'value' => $model->TA1HA,
        'visible' => $model->TA1HA?TRUE:FALSE
        ],
        [
        'attribute' => 'TA1HX',
        'value' => $model->TA1HX,
        'visible' => $model->TA1HX?TRUE:FALSE
        ],
        [
        'attribute' => 'TA1HM',
        'value' => $model->TA1HM,
        'visible' => $model->TA1HM?TRUE:FALSE
        ],
        [
        'attribute' => 'WD',
        'value' => $model->WD,
        'visible' => $model->WD?TRUE:FALSE
        ], 
       [
        'attribute' => 'WD2MA',
        'value' => $model->WD2MA,
        'visible' => $model->WD2MA?TRUE:FALSE
        ],
        ['attribute' => 'WD10MA',
        'value' => $model->WD10MA,
        'visible' => $model->WD10MA?TRUE:FALSE
        ],
        ['attribute' => 'WD2MX',
        'value' => $model->WD2MX,
        'visible' => $model->WD2MX?TRUE:FALSE
        ],
        ['attribute' => 'WD10MX',
        'value' => $model->WD10MX,
        'visible' => $model->WD10MX?TRUE:FALSE
        ],
        ['attribute' => 'WD2MM',
        'value' => $model->WD2MM,
        'visible' => $model->WD2MM?TRUE:FALSE
        ],
        ['attribute' => 'WD10MM',
        'value' => $model->WD10MM,
        'visible' => $model->WD10MM?TRUE:FALSE
        ],
        ['attribute' => 'WD1HA',
        'value' => $model->WD1HA,
        'visible' => $model->WD1HA?TRUE:FALSE
        ],
        ['attribute' => 'WD1HX',
        'value' => $model->WD1HX,
        'visible' => $model->WD1HX?TRUE:FALSE
        ],
        ['attribute' => 'WD1HM',
        'value' => $model->WD1HM,
        'visible' => $model->WD1HM?TRUE:FALSE
        ],
        ['attribute' => 'WS',
        'value' => $model->WS,
        'visible' => $model->WS?TRUE:FALSE
        ],
        ['attribute' => 'WS2MA',
        'value' => $model->WS2MA,
        'visible' => $model->WS2MA?TRUE:FALSE
        ],
        ['attribute' => 'WS10MA',
        'value' => $model->WS10MA,
        'visible' => $model->WS10MA?TRUE:FALSE
        ],
        ['attribute' => 'WS2MX',
        'value' => $model->WS2MX,
        'visible' => $model->WS2MX?TRUE:FALSE
        ],
        ['attribute' => 'WS10MX',
        'value' => $model->WS10MX,
        'visible' => $model->WS10MX?TRUE:FALSE
        ],
        ['attribute' => 'WS2MM',
        'value' => $model->WS2MM,
        'visible' => $model->WS2MM?TRUE:FALSE
        ],
        ['attribute' => 'WS10MM',
        'value' => $model->WS10MM,
        'visible' => $model->WS10MM?TRUE:FALSE
        ],
        ['attribute' => 'QFE',
        'value' => $model->QFE,
        'visible' => $model->QFE?TRUE:FALSE
        ],
        ['attribute' => 'QFE1HA',
        'value' => $model->QFE1HA,
        'visible' => $model->QFE1HA?TRUE:FALSE
        ],
        ['attribute' => 'QFE1HX',
        'value' => $model->QFE1HX,
        'visible' => $model->QFE1HX?TRUE:FALSE
        ],
        ['attribute' => 'QFE1HM',
        'value' => $model->QFE1HM,
        'visible' => $model->QFE1HM?TRUE:FALSE
        ],
        ['attribute' => 'QFF',
        'value' => $model->QFF,
        'visible' => $model->QFF?TRUE:FALSE
        ],
        ['attribute' => 'QFF1HA',
        'value' => $model->QFF1HA,
        'visible' => $model->QFF1HA?TRUE:FALSE
        ],
        ['attribute' => 'QFF1HX',
        'value' => $model->QFF1HX,
        'visible' => $model->QFF1HX?TRUE:FALSE
        ],
        ['attribute' => 'QFF1HM',
        'value' => $model->QFF1HM,
        'visible' => $model->QFF1HM?TRUE:FALSE
        ],
        ['attribute' => 'QNH',
        'value' => $model->QNH,
        'visible' => $model->QNH?TRUE:FALSE
        ],
        ['attribute' => 'QNH1HA',
        'value' => $model->QNH1HA,
        'visible' => $model->QNH1HA?TRUE:FALSE
        ],
        ['attribute' => 'QNH1HX',
        'value' => $model->QNH1HX,
        'visible' => $model->QNH1HX?TRUE:FALSE
        ],
        ['attribute' => 'QNH1HM',
        'value' => $model->QNH1HM,
        'visible' => $model->QNH1HM?TRUE:FALSE
        ],
        ['attribute' => 'ETO',
        'value' => $model->ETO,
        'visible' => $model->ETO?TRUE:FALSE
        ],
        ]
        ])
        ?>
    </div>
</div>
