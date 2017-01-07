<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StationWeatherElements */

$this->title = 'Add Station Weather Elements';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
   <?= Html::a('Back To Station Details', ['station/view', 'id' => $model->stationid], ['class' => 'btn btn-primary']) ?>
    
</p>
<div class="station-weather-elements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
