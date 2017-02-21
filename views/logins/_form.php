<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Logins */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logins-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datecreated')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
