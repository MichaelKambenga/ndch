<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DataSources */

$this->title = 'Data Sources Station';
$this->params['breadcrumbs'][] = ['label' => 'Data Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-sources-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form_set_station', [
        'model' => $model,
    ]) ?>

</div>
