<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Stakeholder;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="classes-form">
    <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'firstname' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Fisrt Name'],
                'columnOptions' => ['width' => '185px']
            ],
             'middlename' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Middle Name'],
                'columnOptions' => ['width' => '185px']
            ],
             'lastname' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter Last  Name'],
                'columnOptions' => ['width' => '185px']
            ],
             'organizationid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(Stakeholder::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => '-- Select Organization --'],
                'columnOptions' => ['width' => '185px']
            ],
            'user_role[]' => [
            'class'=>'user_roles',
                'type' => Form::INPUT_CHECKBOX_LIST,
                'items' => ArrayHelper::map(\app\models\AuthItem::find()->orderBy('name')->asArray()->where(['type'=>1])->all(), 'name', 'name'),
               'columnOptions' => ['width' => '185px','height'=>'10px']
            ],
             'username' => [
                'type' => Form::INPUT_TEXT,
               'options' => ['placeholder' => 'Enter User Name'],
                'columnOptions' => ['width' => '185px']
            ],
                       
            ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
