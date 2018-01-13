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
<div class="form">

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
                'styles'=>['width:20%;border 1px solid red;'],
                'items' => yii\helpers\ArrayHelper::map(\app\models\Station::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => '-- All --'],
            ],
            'weather_element' => [
                'label' => 'Observation Type',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => yii\helpers\ArrayHelper::map(\app\models\WeatherElements::find()->orderBy('name')->asArray()->all(), 'elementcode', 'name'), 'options' => ['prompt' => '-- All --'],
            ],
        ]
    ]);
    ?>
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
</div>





