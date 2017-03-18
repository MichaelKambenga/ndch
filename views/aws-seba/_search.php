<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwsSebaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aws-seba-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EntryDate') ?>

    <?= $form->field($model, 'TIME') ?>

    <?= $form->field($model, 'stationname') ?>

    <?= $form->field($model, 'D') ?>

    <?= $form->field($model, 'U') ?>

    <?php // echo $form->field($model, 'P_L') ?>

    <?php // echo $form->field($model, 'T_L') ?>

    <?php // echo $form->field($model, 'G') ?>

    <?php // echo $form->field($model, 'CH') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
