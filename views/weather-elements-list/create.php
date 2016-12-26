<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WeatherElementsList */

$this->title = 'Create Weather Elements List';
$this->params['breadcrumbs'][] = ['label' => 'Weather Elements Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-elements-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
