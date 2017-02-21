<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;


/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\LoginsSearch $searchModel
 */
$this->title = 'Logins';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="logins-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'login_id',

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
            //'details',
            [
                'attribute' => 'details',
                'vAlign' => 'middle',
                'width' => '500px',
                //'value' => $model->details,
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\Logins::find()->orderBy('id')->asArray()->all(), 'details', 'details'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Search...'],
                'format' => 'raw'
            ],

            [
                'attribute' => 'ipaddress',
                'vAlign' => 'middle',
                'width' => '200px',
                'value' => function ($model) {
                    return ($model->ipaddress);
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(app\models\Logins::find()->orderBy('id')->asArray()->all(), 'ipaddress', 'ipaddress'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Search...'],
                'format' => 'raw'
            ],
            ['attribute' => 'datecreated', 'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],
//            [
//                'class' => 'yii\grid\ActionColumn',
//                'buttons' => [
//                'update' => function ($url, $model) {
//                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['logins/view','id' => $model->login_id,'edit'=>'t']), [
//                                                    'title' => Yii::t('yii', 'Edit'),
//                                                  ]);}
//
//                ],
//            ],
        ],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'panel' => [
            'heading' => ' ',
            'type' => 'default',
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter' => false
        ],
    ]);
    Pjax::end();
    ?>

</div>
