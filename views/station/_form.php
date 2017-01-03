<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Station;

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
                //'label' => 'Name',
                'options' => ['placeholder' => 'Enter Station Name...'],
                'columnOptions' => ['width' => '185px']
            ],
            'stationcode' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'stationcode',
                'options' => ['placeholder' => 'Enter Station Code...'],
                'columnOptions' => ['width' => '185px']
            ],
            'stationtype' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                //'label' => 'stationtype',
                'options' => ['prompt' => '--select--'],
                 'columnOptions' => ['width' => '185px'],
                'items'=>  Station::getStationTypes()
            ],
            'stationowner' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Owner',
                'items' => ArrayHelper::map(\app\models\Stakeholder::find()->orderBy('id')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => 'Select Owner'],
                'columnOptions' => ['width' => '185px']
            ],
            'geocode' => [
                'type' => Form::INPUT_TEXT,
                'label' => 'Geocode',
                'options' => ['placeholder' => 'Enter Geocode...'],
                'columnOptions' => ['width' => '185px']
            ],
            'regionid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Region',
                'items' => ArrayHelper::map(\app\models\Region::find()->orderBy('id')->asArray()->all(), 'id', 'regionname'), 'options' => ['prompt' => 'Select Region'],
                'columnOptions' => ['width' => '185px']
            ],
            'districtid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'District',
                'items' => ArrayHelper::map(\app\models\District::find()->orderBy('id')->asArray()->all(), 'id', 'districtname'), 'options' => ['prompt' => 'Select District'],
                'columnOptions' => ['width' => '185px']
            ],
            'wardid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'label' => 'Ward',
                'items' => ArrayHelper::map(\app\models\Ward::find()->orderBy('id')->asArray()->all(), 'id', 'wardname'), 'options' => ['prompt' => 'Select Ward'],
                'columnOptions' => ['width' => '185px']
            ],
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
