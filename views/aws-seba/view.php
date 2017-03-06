<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AwsSeba */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'SEBA Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-seba-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    DetailView::widget([
    'model' => $model,
    'attributes' => [
    'stationname', 
            'entrydate',
    'time',
    'D',
    'U',
    'PL',
    'TL',
    'G',
    'CH',
    'id',
    ],
    ])
    ?>

</div>