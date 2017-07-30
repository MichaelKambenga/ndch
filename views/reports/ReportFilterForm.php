<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\WeatherElements;

/* @var $this yii\web\View */
/* @var $model app\models\ReportFilterForm */
/* @var $form ActiveForm */
?>
<div class="ReportFilterForm">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'weather_element')->dropDownList(
            ArrayHelper::map(WeatherElements::find()->all(), 'name', 'name'), [
        'prompt' => 'Select Fiscal Year',
    ]);
    ?>
    <?=
    $form->field($model, 'geo_level')->dropDownList(
            ['StationData' => 'Station Data', 'WardData' => 'Ward Data', 'DistrictData' => 'District Data', 'RegionData' => 'Region Data'], [
        'prompt' => 'Select Fiscal Year',
    ]);
    ?>
    <?= $form->field($model, 'region_id') ?>
    <?= $form->field($model, 'district_id') ?>
    <?= $form->field($model, 'ward_id') ?>
    <?= $form->field($model, 'station_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- ReportFilterForm -->
