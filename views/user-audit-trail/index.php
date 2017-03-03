<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAuditTrailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Audit Trails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-audit-trail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Audit Trail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'datecreated',
            'ipaddress',
            'object',
            // 'clientdetails:ntext',
            // 'details:ntext',
            // 'referer',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>