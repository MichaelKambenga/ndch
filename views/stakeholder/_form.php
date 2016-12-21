<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/**
 * @var yii\web\View $this
 * @var app\models\Classes $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="classes-form">

    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'name' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Name',
                'options' => ['placeholder' => 'Enter Stakeholder Name...'],
                'columnOptions' => ['width' => '185px']
            ],
            'mobileno' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Mobile',
                'options' => ['placeholder' => 'Enter Mobile Number...'],
                'columnOptions' => ['width' => '185px']
            ],
            'email' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Email',
                'options' => ['placeholder' => 'Enter Email Address...'],
                'columnOptions' => ['width' => '185px']
            ],
            'orgtype' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Type',
                'options' => ['placeholder' => 'Enter Organization type...'],
                'columnOptions' => ['width' => '185px']
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
