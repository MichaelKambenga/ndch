<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\ReportFilterForm */
/* @var $form ActiveForm */
?>
<div class="ReportFilterForm">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>

    <?php
    echo Form::widget([

        'model' => $model,
        'form' => $form,
        'columns' => 3,
        'attributes' => [
            'owner' => [
                'label' => 'Owner',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ['' => 'Select Owner', 'TMA' => 'TMA', 'PMO' => 'PMO'], [
                ],
            ],
            'region_id' => [
                'label' => 'Region',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ['' => 'Select Region', 'Dar es salaam' => 'Dar es salaam', 'Mtwara' => 'Mtwara'], [
                ],
            ],
            'district_id' => [
                'label' => 'District',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ['' => 'Select District', 'Ilala' => 'Ilala', 'Masasi' => 'Masasi'], [
                ],
            ],
        ]
    ]);
//    ActiveForm::end();
    ?>

    <!--<div class="form-group">-->

</div>

<div class="form-group">
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

</div><!-- ReportFilterForm -->




