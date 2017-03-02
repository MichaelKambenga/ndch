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
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'regionid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Region',
                'items' => ArrayHelper::map(\app\models\Region::find()->orderBy('id')->asArray()->all(), 'id', 'regionname'), 'options' => ['prompt' => 'Select Region'],
                'columnOptions' => ['width' => '185px']
            ],
            'districtname' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'District',
                'options' => ['placeholder' => 'Enter District Name...'],
                'columnOptions' => ['width' => '185px']
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
