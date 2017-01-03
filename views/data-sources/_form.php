<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Stakeholder;
use app\models\DataSources;

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
            'datasourcetype' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => DataSources::getDataSourceTypes(), 'options' => ['prompt' => '-- Select --'],
                'columnOptions' => ['width' => '185px']
            ], 
            'name' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Data Source  Name'],
                'columnOptions' => ['width' => '185px']
            ],
            'ipaddress' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Ip Adrress...'],
                'columnOptions' => ['width' => '185px']
            ],
             'stakeholderid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(Stakeholder::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => 'Select Owner'],
                'columnOptions' => ['width' => '185px']
            ],
            
            'datalocation' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Directory Path to the Data files...'],
                'columnOptions' => ['width' => '185px']
            ],
            
            
            ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>







