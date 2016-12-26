<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwsVaisalaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aws Vaisala Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-vaisala-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('New Record', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Import Records', ['import'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'TIME',
            'BAT',
            'DP',
            'DP1HA',
            // 'DP1HX',
            // 'DP1HM',
            // 'PA',
            // 'PA1HA',
            // 'PA1HX',
            // 'PA1HM',
            // 'PR',
            // 'PR1HS',
            // 'PR24HS',
            // 'PR5MS00',
            // 'PR5MS05',
            // 'PR5MS10',
            // 'PR5MS15',
            // 'PR5MS20',
            // 'PR5MS25',
            // 'PR5MS30',
            // 'PR5MS35',
            // 'PR5MS40',
            // 'PR5MS45',
            // 'PR5MS50',
            // 'PR5MS55',
            // 'RH',
            // 'RH1HA',
            // 'RH1HX',
            // 'RH1HM',
            // 'SR',
            // 'SR1HA',
            // 'SR1HX',
            // 'SR1HM',
            // 'TA',
            // 'TA1HA',
            // 'TA1HX',
            // 'TA1HM',
            // 'WD',
            // 'WD2MA',
            // 'WD10MA',
            // 'WD2MX',
            // 'WD10MX',
            // 'WD2MM',
            // 'WD10MM',
            // 'WD1HA',
            // 'WD1HX',
            // 'WD1HM',
            // 'WS',
            // 'WS2MA',
            // 'WS10MA',
            // 'WS2MX',
            // 'WS10MX',
            // 'WS2MM',
            // 'WS10MM',
            // 'QFE',
            // 'QFE1HA',
            // 'QFE1HX',
            // 'QFE1HM',
            // 'QFF',
            // 'QFF1HA',
            // 'QFF1HX',
            // 'QFF1HM',
            // 'QNH',
            // 'QNH1HA',
            // 'QNH1HX',
            // 'QNH1HM',
            // 'a',
            // 'p',
            // 'ETO',
            // 'Path',
             'StationName',
             'VaisalaVersion',
             'EntryDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
