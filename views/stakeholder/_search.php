<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StakeholderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stakeholder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mobileno') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'orgtype') ?>

    <?php // echo $form->field($model, 'datecreated') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'datedeactivated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
