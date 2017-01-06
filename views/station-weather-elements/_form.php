<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use app\models\WeatherElements;

/* @var $this yii\web\View */
/* @var $model app\models\StationWeatherElements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="station-weather-elements-form">
<?php
    $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model' => $model,
        'form' => $form,
        'columns' => 2,
        'attributes' => [
                    
            'elementsid' => [
                'type' => Form::INPUT_DROPDOWN_LIST,
                 'options' => ['prompt' => '--select--'],
                 'items'=> ArrayHelper::map(WeatherElements::find()->all(), 'id', 'name')
                ],
            
            'collectionfrequency' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Please Enter Data collection Frequecy value in Minutes '],
                'columnOptions' => ['width' => '185px']
            ],
            
            'accuracy' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Please enter Data accuracy value in % '],
                'columnOptions' => ['width' => '185px']
            ],
            'surfacedistance' => [
                'type' => Form::INPUT_TEXT,
                'options' => ['placeholder' => 'Distance from surface in Meters(M)..'],
                'columnOptions' => ['width' => '185px']
            ],
          
        ]
    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end();
    ?>
   
</div>
