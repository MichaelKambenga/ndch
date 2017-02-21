<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\Stakeholder;
use app\models\DataSources;

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
            'stationid' => [
            'class'=>'stations_list',
                'type' => Form::INPUT_CHECKBOX_LIST,
                'items' => ArrayHelper::map(\app\models\Station::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
               'columnOptions' => ['width' => '185px','height'=>'10px']
            ], 
            ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>







