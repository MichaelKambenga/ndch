<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StationWeatherElementsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="station-weather-elements-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'stationid') ?>

    <?= $form->field($model, 'elementsid') ?>

    <?= $form->field($model, 'collectionfrequency') ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'accuracy') ?>

    <?php // echo $form->field($model, 'surfacedistance') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
