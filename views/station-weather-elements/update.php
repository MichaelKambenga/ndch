<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StationWeatherElements */

$this->title = 'Update Station Weather Elements: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Station Weather Elements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="station-weather-elements-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
