<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\ReportFilterForm */
/* @var $form ActiveForm */
?>
<div class="ReportFilterForm">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?=
        $form->field($model, 'geo_level')->dropDownList(
                ['AllStations' => 'All Stations', 'WardData' => 'Wards Data', 'DistrictData' => 'Districts Data', 'RegionData' => 'Regions Data'], [
            'prompt' => 'Select Geo Level',
        ]);
        ?>
    </div>

    <div class="form-group">
        <?=
        // Use DatePicker input with ActiveForm and model validation enabled (without ajax conversion). 
        $form->field($model, 'date')->widget(DateControl::classname(), [
            'type' => DateControl::FORMAT_DATE,
            'ajaxConversion' => false,
            'widgetOptions' => [
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- ReportFilterForm -->
