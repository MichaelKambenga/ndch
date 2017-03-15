<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwsSeba */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aws-seba-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entrydate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stationname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'D')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'U')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'P_L')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'T_L')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'G')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CH')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
