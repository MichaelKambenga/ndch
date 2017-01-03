<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Stakeholder;
use app\models\DataSources;

/* @var $this yii\web\View */
/* @var $model app\models\DataSources */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Data Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-sources-view">

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
            'name',
            'ipaddress',
            'datalocation',
                     array(
'attribute' => 'stakeholderid',
 'value' => function ($model) {
return Stakeholder::getStakeholderNameById($model->stakeholderid);
},
 ),
 array(
     'attribute' => 'orgtype',
     'value' => function ($model) {
     return $model->getDataSourceTypeName();
     },
     ),
        ],
    ]) ?>

</div>
