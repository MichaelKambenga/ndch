<?php

use yii\helpers\Html;
use kartik\builder\Form;
use yii\helpers\FileHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = 'Account Profile';
$this->params['breadcrumbs'][] = ['label' => 'My Account Password'];
?>
<div class="login-box-body">

    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
                'method' => 'POST'
    ]);
    ?>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'current_password')->passwordInput() ?>
    </div>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'new_password')->passwordInput(['autofocus' => true]) ?>
    </div>

    <div class="form-group has-feedback">
        <?= $form->field($model, 'new_repeat_password')->passwordInput(['autofocus' => true]) ?>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <?= Html::submitButton('Change', ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
            <?= Html::a('Cancel', ['site/account-profile'], ['class' => 'btn btn-danger btn-flat', 'name' => 'cancel-button', 'confirm' => 'Are you sure you want to do this?']) ?>
        </div>
        <!-- /.col -->
    </div>

    <?php ActiveForm::end(); ?>

</div>


