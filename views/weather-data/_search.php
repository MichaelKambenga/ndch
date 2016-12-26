<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'daterecorded') ?>

    <?= $form->field($model, 'source') ?>

    <?= $form->field($model, 'entrydate') ?>

    <?php // echo $form->field($model, 'entryby') ?>

    <?php // echo $form->field($model, 'stationid') ?>

    <?php // echo $form->field($model, 'weatherelementid') ?>

    <?php // echo $form->field($model, 'weatherelementlistid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
