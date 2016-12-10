<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwsVaisala */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aws-vaisala-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BAT')->textInput() ?>

    <?= $form->field($model, 'DP')->textInput() ?>

    <?= $form->field($model, 'DP1HA')->textInput() ?>

    <?= $form->field($model, 'DP1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DP1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PA1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PA1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PA1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR1HS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR24HS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS00')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS05')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS20')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS25')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS30')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS35')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS40')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS45')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS50')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR5MS55')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RH1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RH1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RH1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SR1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SR1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SR1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TA1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TA1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TA1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD2MA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD10MA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD2MX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD10MX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD2MM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD10MM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WD1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS2MA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS10MA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS2MX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS10MX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS2MM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS10MM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFE1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFE1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFE1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFF1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFF1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QFF1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QNH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QNH1HA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QNH1HX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QNH1HM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'a')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ETO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StationName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VaisalaVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EntryDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
