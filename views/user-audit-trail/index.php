<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserAuditTrailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Audit Trails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-audit-trail-index">

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'userid',
                'vAlign' => 'middle',
                'width' => '200px',
                'value' => function ($model) {
                    return ($model->user->lastname . ' ' . $model->user->firstname);
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\User::findBySql("select tbl_user.*, concat(lastname,', ',firstname,' ',middlename) AS fullname from tbl_user")->orderBy('id')->asArray()->all(), 'id', 'fullname'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Search...'],
                'format' => 'raw'
            ],
            'datecreated',
            'ipaddress',
            'object',
            // 'clientdetails:ntext',
            // 'details:ntext',
            // 'referer',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => ' ',
            'type' => 'default',
//        'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    ?>
</div>
