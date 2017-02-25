<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DP')->textInput() ?>

    <?= $form->field($model, 'PA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SR')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'TA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'WS')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'QFE')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'QFF')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'QNH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ETO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
