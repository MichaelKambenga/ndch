<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\District;

/* @var $this yii\web\View */
/* @var $model app\models\Ward */

$this->title = 'Ward Details';
$this->params['breadcrumbs'][] = ['label' => 'Wards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ward-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'wardname',
             array(
                'attribute'=>'districtid',
                 'value' =>function ($model) {
return District::getDistrictNameById($model->districtid);
},
                ),
        ],
    ]) ?>

</div>
