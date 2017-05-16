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
