<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'daterecorded')->textInput() ?>

    <?= $form->field($model, 'source')->textInput() ?>

    <?= $form->field($model, 'entrydate')->textInput() ?>

    <?= $form->field($model, 'entryby')->textInput() ?>

    <?= $form->field($model, 'stationid')->textInput() ?>

    <?= $form->field($model, 'weatherelementid')->textInput() ?>

    <?= $form->field($model, 'weatherelementlistid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
