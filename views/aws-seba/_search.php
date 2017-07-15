<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AwsVaisalaSearchs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <?= $form->field($model, 'TIME')->widget(yii\jui\DatePicker::className(), ['clientOptions' => ['dateFormat' => 'yy-mm-dd']]);
    ?>
    
    <?= $form->field($model, 'stationname')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Station::find()->all(), 'name', 'name'), ['prompt' => '--select--']) ?>

    <div class="form-group">
    <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-top:2%;']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
