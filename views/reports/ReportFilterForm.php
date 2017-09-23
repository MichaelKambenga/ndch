<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;

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
        <?=
        // Use DatePicker input with ActiveForm and model validation enabled (without ajax conversion). 
        $form->field($model, 'date')->widget(DateControl::classname(), [
            'type' => DateControl::FORMAT_DATE,
            'ajaxConversion' => false,
            'widgetOptions' => [
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- ReportFilterForm -->

<div class="stakeholder-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
//    Pjax::begin();
//    echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            ['attribute' => 'TIME'],
//            ['attribute' => 'stationid'],
////            ['attribute' => 'DP'],
//            ['attribute' => 'PA'],
//            ['attribute' => 'PR'],
//            ['attribute' => 'RH'],
//            ['attribute' => 'TA'],
////            ['attribute' => 'WD'],
//            ['attribute' => 'WS'],
////            ['class' => 'yii\grid\ActionColumn'],
//        ],
//        'responsive' => true,
//        'hover' => true,
//        'condensed' => true,
//        'floatHeader' => false,
//        'panel' => [
//            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
//            'type' => 'info',
////            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add Region', ['create'], ['class' => 'btn btn-success']),
////            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
//            'showFooter' => true
//        ],
//    ]);
//    Pjax::end();
    ?>
</div>


