<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-form">
  
     <?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
            'weatherelementid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
             'items' => ArrayHelper::map(app\models\WeatherElements::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 'options' => ['prompt' => 'Select element'],
                  'columnOptions' => ['width' => '185px']
                ], 'weatherelementlistid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(app\models\WeatherElementsList::find()->orderBy('itemname')->asArray()->all(), 'id', 'itemname'), 'options' => ['prompt' => 'Select element'],
              'columnOptions' => ['width' => '185px']
            ], 
           
            'value' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Enter value...'],
                'columnOptions' => ['width' => '185px']
            ],
              
         
        ]
    ]);
   echo '<label>Date Recorded</label>';
   echo DateTimePicker::widget([
	'model' => $model,
	'attribute' => 'daterecorded',
	'options' => ['placeholder' => 'Enter Date Recorded time ...'],
         'pluginOptions' => [
         'autoclose' => true
	]
       ]);

   
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>
    
    

</div>
