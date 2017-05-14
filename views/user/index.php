<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Stakeholder;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\UsersSearch $searchModel
 */
$this->title = 'Manage Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?php /* echo Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'firstname',
            //'middlename',
            'lastname',
                [
                'attribute' => 'organizationid',
                'value' => function($model) {
                    return $model->organizationid == 1 ? Stakeholder::getStakeholderNameById($model->organizationid) : "";
                },
            ],
                [
                'attribute' => 'user_role',
                //'value' => $model->getUserRolesName(),
                'value' => function($model) {
                    return $model->getUserRolesName();
                },
                'format' => 'html'
            ],
            'username',
            // 'password',
            [
                'label' => 'Status',
                'attribute' => 'status',
                'vAlign' => 'middle',
                'width' => '30px',
                'value' => function($model) {
                    return $model->status == 1 ? "<span class='glyphicon glyphicon-ok'></span>" : "<span class='glyphicon glyphicon-remove'></span>";
                },
                'format' => 'raw',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ['1' => 'Active', '0' => 'Inactive'],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Search...'],
                'format' => 'raw'
            ],
//            [
//                'label' => '',
//                'value' => function($model) {
//                    return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i>View More</span>', Yii::$app->urlManager->createUrl(['user/view', 'id' => $model->id,]), [
//                                'title' => Yii::t('yii', 'View More'),
//                    ]);
//                },
//                        'format' => 'raw',
//             ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"> </h3>',
            'type' => 'default',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i> Add User', ['create'], ['class' => 'btn btn-success']), 'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end();
    ?>

</div>