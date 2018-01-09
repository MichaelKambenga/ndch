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
<div class="ReportFilterForm" style="max-width: 90%">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL,'method'=>'GET']); ?>
    <?php
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 4,
        'attributes' => [
            'station_type' => [
                'label' => 'Type',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => 'Select Type'],
                'items' => \app\models\Station::getStationTypes(),
            ],
            'owner' => [
                'label' => 'Owner',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => yii\helpers\ArrayHelper::map(\app\models\Stakeholder::find()->orderBy('name')->asArray()->where('orgtype != :orgtype', [':orgtype' => \app\models\Stakeholder::ORG_TYPE_DATAREADONLY])->all(), 'id', 'name'), 'options' => ['prompt' => 'Select Owner'],
            ],
            'region_id' => [
                'label' => 'Region',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => yii\helpers\ArrayHelper::map(\app\models\Region::find()->orderBy('regionname')->asArray()->all(), 'id', 'regionname'), 'options' => ['prompt' => 'Select Region'],
            ],
            'district_id' => [
                'label' => 'District ',
                'type' => Form::INPUT_DROPDOWN_LIST,
                'options' => ['prompt' => 'Select District'],
                'items' => yii\helpers\ArrayHelper::map(\app\models\District::find()->orderBy('districtname')->asArray()->all(), 'id', 'districtname'),
            ],
        ]
    ]);
    ?>

</div>

<div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

</div><!-- ReportFilterForm -->




