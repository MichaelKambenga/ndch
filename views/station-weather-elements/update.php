<?php
use yii\helpers\Html;


$this->title = 'Update Station Weather Elements';
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
   <?= Html::a('Back To Station Details', ['station/view', 'id' => $model->stationid], ['class' => 'btn btn-primary']) ?>
    
</p>
<div class="station-weather-elements-update">
<h1><?= Html::encode($this->title) ?></h1>

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
