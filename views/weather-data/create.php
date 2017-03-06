<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */

$this->title = 'Post Station Weather Data';
$this->params['breadcrumbs'][] = ['label' => 'Station Weather Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
