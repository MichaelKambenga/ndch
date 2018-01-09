<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\ReportFilterForm */
/* @var $form ActiveForm */
?>
<div class="ReportFilterForm" style="max-width: 90%">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'method' => 'GET']); ?>
    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [
            'station_id' => [
                'label' => 'Station',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => 'Select Type'],
                'items' => yii\helpers\ArrayHelper::map(\app\models\Station::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => '-- Select --'],
            ],
            'date_start' => [
                'label' => 'Date Start',
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => yii\jui\DatePicker::className(),
                'pluginOptions' => [
                    'format' => 'y-m-d',
                    'todayHighlight' => true
                ]
            ],
            'date_end' => [
                'label' => 'Date End',
                'type' => Form::INPUT_WIDGET,
                'widgetClass' => yii\jui\DatePicker::className(),
                'pluginOptions' => [
                    'format' => 'y-m-d',
                    'todayHighlight' => true
                ]
            ],
            'weather_element' => [
                'label' => 'Observation Type',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => yii\helpers\ArrayHelper::map(\app\models\WeatherElements::find()->orderBy('name')->asArray()->all(), 'elementcode', 'name'), 'options' => ['prompt' => '-- All --'],
            ],
        ]
    ]);
    ?>

</div>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

</div><!-- ReportFilterForm -->




