<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stakeholders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Stakeholder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'mobileno',
            'email:email',
            'orgtype',
            // 'datecreated',
            // 'status',
            // 'datedeactivated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
