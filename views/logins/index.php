<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoginsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logins-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Logins', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'ipaddress',
            'details',
            'datecreated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
