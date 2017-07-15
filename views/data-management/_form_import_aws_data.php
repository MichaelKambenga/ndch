<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-form search">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'DateStart')->widget(yii\jui\DatePicker::className(), ['clientOptions' => ['dateFormat' => 'yy-mm-dd']]); ?>
    <?= $form->field($model, 'DateEnd')->widget(yii\jui\DatePicker::className(), ['clientOptions' => ['dateFormat' => 'yy-mm-dd']]); ?>
    <?= $form->field($model, 'AWSType')->dropDownList(app\models\WeatherData::getAWSTypes(), ['prompt' => '-- Select --']) ?>
    <!--$form->field($model, 'StationId')->dropDownList(yii\helpers\ArrayHelper::map(app\models\Station::find()->all(), 'id', 'name'), ['prompt' => '-- Select (All Stations)--']);-->
    <div class="form-group">
        <?= Html::submitButton('Import Data', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
