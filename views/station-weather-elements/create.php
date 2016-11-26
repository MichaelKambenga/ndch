<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StationWeatherElements */

$this->title = 'Create Station Weather Elements';
$this->params['breadcrumbs'][] = ['label' => 'Station Weather Elements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-weather-elements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
