<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WeatherElements */

$this->title = 'Create Weather Elements';
$this->params['breadcrumbs'][] = ['label' => 'Weather Elements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-elements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
