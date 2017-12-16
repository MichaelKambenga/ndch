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
    ?>
    <?php //echo $form->errorSummary($model);?>
    <?php
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
            'username' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Enter User Name'],
                'columnOptions' => ['width' => '185px']
            ],
            'password_hash' => [
                'type' => Form::INPUT_PASSWORD,
                'options' => ['placeholder' => 'Set User Password'],
                'columnOptions' => ['width' => '185px'],
                'visible' => !$model->isNewRecord
            ],
            'user_role' => [
                'class' => 'user_roles',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'checked' => ['Institution Normal User', 'Institution  Super User'],
                'items' => ArrayHelper::map(\app\models\AuthItem::find()->orderBy('name')->asArray()->where(['type' => 1])->all(), 'name', 'name'), 'options' => ['prompt' => '-- Select --'],
                'columnOptions' => ['width' => '185px', 'height' => '10px']
            ],
            'stationid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(\app\models\Station::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => '-- Select station --'],
                'columnOptions' => ['width' => '185px', 'id' => 'user-station']
            ],
            'status' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => \app\models\User::getStatusList(), 
                'options' => ['prompt' => '-- Select --'],
                'visible' => !$model->isNewRecord],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
