<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AwsSeba */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'SEBA Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->stationname;
?>
<div class="aws-seba-view">

    <h1><?= Html::encode($model->stationname.' - '.$this->title) ?></h1>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'stationname',
            'EntryDate',
            'TIME',
            'D',
            'U',
            'P_L',
            'T_L',
            'G',
            'CH',
            'id',
        ],
    ])
    ?>

</div>