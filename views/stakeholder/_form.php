<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Stakeholder;

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
                'label' => 'Name',
                'options' => ['placeholder' => 'Enter Stakeholder Name...'],
                'columnOptions' => ['width' => '5px']
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
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Org Type',
                'options' => ['prompt' => '--select--'],
                'items' => Stakeholder::getOrganizationTypes()
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
