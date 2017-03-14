<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwsVaisalaSearchs */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Vaisala Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-vaisala-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if (Yii::$app->user->can('Administrator') || Yii::$app->session->get('organizationUser') == 1) {
            echo Html::a('Import Records', ['import'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'StationName',
            // 'VaisalaVersion',
            'EntryDate',
            'TIME',
//            'BAT',
//            'DP',
//            'DP1HA',
            // 'DP1HX',
            // 'DP1HM',
            // 'PA',
            // 'PA1HA',
            // 'PA1HX',
            // 'PA1HM',
            // 'PR',
            // 'PR1HS',
            // 'PR24HS',
            // 'PR5MS00',
            // 'PR5MS05',
            // 'PR5MS10',
            // 'PR5MS15',
            // 'PR5MS20',
            // 'PR5MS25',
            // 'PR5MS30',
            // 'PR5MS35',
            // 'PR5MS40',
            // 'PR5MS45',
            // 'PR5MS50',
            // 'PR5MS55',
            // 'RH',
            // 'RH1HA',
            // 'RH1HX',
            // 'RH1HM',
            // 'SR',
            // 'SR1HA',
            // 'SR1HX',
            // 'SR1HM',
            // 'TA',
            // 'TA1HA',
            // 'TA1HX',
            // 'TA1HM',
            // 'WD',
            // 'WD2MA',
            // 'WD10MA',
            // 'WD2MX',
            // 'WD10MX',
            // 'WD2MM',
            // 'WD10MM',
            // 'WD1HA',
            // 'WD1HX',
            // 'WD1HM',
            // 'WS',
            // 'WS2MA',
            // 'WS10MA',
            // 'WS2MX',
            // 'WS10MX',
            // 'WS2MM',
            // 'WS10MM',
            // 'QFE',
            // 'QFE1HA',
            // 'QFE1HX',
            // 'QFE1HM',
            // 'QFF',
            // 'QFF1HA',
            // 'QFF1HX',
            // 'QFF1HM',
            // 'QNH',
            // 'QNH1HA',
            // 'QNH1HX',
            // 'QNH1HM',
            // 'a',
            // 'p',
            // 'ETO',
            'Path',
            
            [
                'label' => '',
                'value' => function($model) {
                    return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i>View More</span>', Yii::$app->urlManager->createUrl(['aws-vaisala/view', 'id' => $model->id,]), [
                                'title' => Yii::t('yii', 'View More'),
                    ]);
                },
                        'format' => 'raw',
                    ],
//                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => false,
                'panel' => [
                    ///'heading' => 'Aws Vaisala',
                    'type' => 'default',
                    'showFooter' => true
                ],
            ]);

            Pjax::end();
            ?>
</div>