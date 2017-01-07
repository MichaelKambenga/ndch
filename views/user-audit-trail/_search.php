<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserAuditTrailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-audit-trail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'datecreated') ?>

    <?= $form->field($model, 'ipaddress') ?>

    <?= $form->field($model, 'object') ?>

    <?php // echo $form->field($model, 'clientdetails') ?>

    <?php // echo $form->field($model, 'details') ?>

    <?php // echo $form->field($model, 'referer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
