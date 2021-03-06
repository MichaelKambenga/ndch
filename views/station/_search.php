<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="station-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'stationcode') ?>

    <?= $form->field($model, 'stationtype') ?>

    <?= $form->field($model, 'stationowner') ?>

    <?php // echo $form->field($model, 'geocode') ?>

    <?php // echo $form->field($model, 'regionid') ?>

    <?php // echo $form->field($model, 'districtid') ?>

    <?php // echo $form->field($model, 'wardid') ?>

    <?php // echo $form->field($model, 'datecreated') ?>

    <?php // echo $form->field($model, 'createdby') ?>

    <?php // echo $form->field($model, 'createdbyinsitutionid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
