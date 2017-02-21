<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LoginAttemptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Login Attempts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-attempt-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Login Attempt', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'ipaddress',
            'successfulattempt:boolean',
            'lastlogin',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
