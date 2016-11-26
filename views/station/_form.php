<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Station */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stationcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stationtype')->textInput() ?>

    <?= $form->field($model, 'stationowner')->textInput() ?>

    <?= $form->field($model, 'geocode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'regionid')->textInput() ?>

    <?= $form->field($model, 'districtid')->textInput() ?>

    <?= $form->field($model, 'wardid')->textInput() ?>

    <?= $form->field($model, 'datecreated')->textInput() ?>

    <?= $form->field($model, 'createdby')->textInput() ?>

    <?= $form->field($model, 'createdbyinsitutionid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
