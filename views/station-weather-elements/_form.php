<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StationWeatherElements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="station-weather-elements-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stationid')->textInput() ?>

    <?= $form->field($model, 'elementsid')->textInput() ?>

    <?= $form->field($model, 'collectionfrequency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accuracy')->textInput() ?>

    <?= $form->field($model, 'surfacedistance')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
