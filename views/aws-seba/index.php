<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwsSebaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aws Sebas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-seba-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aws Seba', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'entrydate',
            'time',
            'stationname',
            'D',
            'U',
            // 'PL',
            // 'TL',
            // 'G',
            // 'CH',
            // 'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
