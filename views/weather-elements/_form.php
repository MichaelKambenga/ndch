<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\WeatherElements;

/**
 * @var yii\web\View $this
 * @var app\models\Classes $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="classes-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'name' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Enter Element Name...'],
                'columnOptions' => ['width' => '185px']
            ],
            'unitmeasure' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Unit of Measure...'],
                'columnOptions' => ['width' => '185px']
            ],
           
            'elementcode' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Element Code...'],
                'columnOptions' => ['width' => '185px']
            ],
         
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
