<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?php if (is_null(\yii::$app->user->identity->stationid)): ?>
        <?= $form->field($model, 'stationid')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Station::getUserStations(), 'id', 'name'), ['prompt' => '--select--']) ?>
    <?php endif; ?>
    <?= $form->field($model, 'TIME')->widget(\yii\widgets\MaskedInput::className(), ['mask' => 'D\ate: 99-99-9999  Time: 99:99',]); ?>

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
