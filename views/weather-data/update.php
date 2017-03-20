<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */

$this->title = 'Station Weather Data: Update #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Station Weather Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="weather-data-update" style="max-width: 80%;">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
