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
            'districtid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'District',
                'items' => ArrayHelper::map(\app\models\District::find()->orderBy('id')->asArray()->all(), 'id', 'districtname'), 'options' => ['prompt' => 'Select District'],
                'columnOptions' => ['width' => '185px']
            ],
            'wardname' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Ward',
                'options' => ['placeholder' => 'Enter Ward Name...'],
                'columnOptions' => ['width' => '185px']
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
