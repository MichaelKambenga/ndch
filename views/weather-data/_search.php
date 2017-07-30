<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use \app\models\Station;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-data-search search">
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>
    <?php if (is_null(\yii::$app->user->identity->stationid)): ?>
        <?= $form->field($model, 'stationid')->dropDownList(ArrayHelper::map(Station::find()->all(), 'id', 'name'), ['prompt' => '--select--']) ?>
    <?php endif; ?>
    <?= $form->field($model, 'TIME')->widget(yii\jui\DatePicker::className(), ['clientOptions' => ['dateFormat' => 'YY-MM-dd']]); ?>

    <?php
    echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']);
    ActiveForm::end();
    ?>
</div>
