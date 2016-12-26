<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwsVaisalaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aws-vaisala-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'TIME') ?>

    <?= $form->field($model, 'BAT') ?>

    <?= $form->field($model, 'DP') ?>

    <?= $form->field($model, 'DP1HA') ?>

    <?php // echo $form->field($model, 'DP1HX') ?>

    <?php // echo $form->field($model, 'DP1HM') ?>

    <?php // echo $form->field($model, 'PA') ?>

    <?php // echo $form->field($model, 'PA1HA') ?>

    <?php // echo $form->field($model, 'PA1HX') ?>

    <?php // echo $form->field($model, 'PA1HM') ?>

    <?php // echo $form->field($model, 'PR') ?>

    <?php // echo $form->field($model, 'PR1HS') ?>

    <?php // echo $form->field($model, 'PR24HS') ?>

    <?php // echo $form->field($model, 'PR5MS00') ?>

    <?php // echo $form->field($model, 'PR5MS05') ?>

    <?php // echo $form->field($model, 'PR5MS10') ?>

    <?php // echo $form->field($model, 'PR5MS15') ?>

    <?php // echo $form->field($model, 'PR5MS20') ?>

    <?php // echo $form->field($model, 'PR5MS25') ?>

    <?php // echo $form->field($model, 'PR5MS30') ?>

    <?php // echo $form->field($model, 'PR5MS35') ?>

    <?php // echo $form->field($model, 'PR5MS40') ?>

    <?php // echo $form->field($model, 'PR5MS45') ?>

    <?php // echo $form->field($model, 'PR5MS50') ?>

    <?php // echo $form->field($model, 'PR5MS55') ?>

    <?php // echo $form->field($model, 'RH') ?>

    <?php // echo $form->field($model, 'RH1HA') ?>

    <?php // echo $form->field($model, 'RH1HX') ?>

    <?php // echo $form->field($model, 'RH1HM') ?>

    <?php // echo $form->field($model, 'SR') ?>

    <?php // echo $form->field($model, 'SR1HA') ?>

    <?php // echo $form->field($model, 'SR1HX') ?>

    <?php // echo $form->field($model, 'SR1HM') ?>

    <?php // echo $form->field($model, 'TA') ?>

    <?php // echo $form->field($model, 'TA1HA') ?>

    <?php // echo $form->field($model, 'TA1HX') ?>

    <?php // echo $form->field($model, 'TA1HM') ?>

    <?php // echo $form->field($model, 'WD') ?>

    <?php // echo $form->field($model, 'WD2MA') ?>

    <?php // echo $form->field($model, 'WD10MA') ?>

    <?php // echo $form->field($model, 'WD2MX') ?>

    <?php // echo $form->field($model, 'WD10MX') ?>

    <?php // echo $form->field($model, 'WD2MM') ?>

    <?php // echo $form->field($model, 'WD10MM') ?>

    <?php // echo $form->field($model, 'WD1HA') ?>

    <?php // echo $form->field($model, 'WD1HX') ?>

    <?php // echo $form->field($model, 'WD1HM') ?>

    <?php // echo $form->field($model, 'WS') ?>

    <?php // echo $form->field($model, 'WS2MA') ?>

    <?php // echo $form->field($model, 'WS10MA') ?>

    <?php // echo $form->field($model, 'WS2MX') ?>

    <?php // echo $form->field($model, 'WS10MX') ?>

    <?php // echo $form->field($model, 'WS2MM') ?>

    <?php // echo $form->field($model, 'WS10MM') ?>

    <?php // echo $form->field($model, 'QFE') ?>

    <?php // echo $form->field($model, 'QFE1HA') ?>

    <?php // echo $form->field($model, 'QFE1HX') ?>

    <?php // echo $form->field($model, 'QFE1HM') ?>

    <?php // echo $form->field($model, 'QFF') ?>

    <?php // echo $form->field($model, 'QFF1HA') ?>

    <?php // echo $form->field($model, 'QFF1HX') ?>

    <?php // echo $form->field($model, 'QFF1HM') ?>

    <?php // echo $form->field($model, 'QNH') ?>

    <?php // echo $form->field($model, 'QNH1HA') ?>

    <?php // echo $form->field($model, 'QNH1HX') ?>

    <?php // echo $form->field($model, 'QNH1HM') ?>

    <?php // echo $form->field($model, 'a') ?>

    <?php // echo $form->field($model, 'p') ?>

    <?php // echo $form->field($model, 'ETO') ?>

    <?php // echo $form->field($model, 'Path') ?>

    <?php // echo $form->field($model, 'StationName') ?>

    <?php // echo $form->field($model, 'VaisalaVersion') ?>

    <?php // echo $form->field($model, 'EntryDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
