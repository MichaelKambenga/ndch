<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AwsVaisalaSearchs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <?php 
    echo $form->field($model,'TIME')->widget(yii\jui\DatePicker::className(),
            ['clientOptions' => ['dateFormat' => 'yy-mm-dd']]); 
    ?>
    <?php
//    echo DatePicker::widget([
//        'model' => $model,
//        'attribute' => 'TIME',
////        'name' => 'TIME',
//        'options' => ['placeholder' => 'Select operating time ...'],
//        'convertFormat' => true,
//        'pluginOptions' => [
//            'format' => 'd-M-Y g:i A',
//            'startDate' => '01-Mar-2014 12:00 AM',
//            'todayHighlight' => true
//         ]       
//    ]);
    ?>
    <?= $form->field($model, 'StationName')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Station::find()->orderBy('name')->all(), 'name', 'name'), ['prompt' => '--select--']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top:2%;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
