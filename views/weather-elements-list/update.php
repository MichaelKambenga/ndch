<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherElementsList */

$this->title = 'Update Weather Elements List: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Weather Elements Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="weather-elements-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
