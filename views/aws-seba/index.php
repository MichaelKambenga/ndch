<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AwsSebaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SEBA data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-seba-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if (Yii::$app->user->can('Administrator') || Yii::$app->session->get('organizationUser') == 1) {
            echo Html::a('Import Records', ['import'], ['class' => 'btn btn-success']);
        }
        ?>
    </p>

    <?=
    GridView::widget([
    'dataProvider' => $dataProvider,
    // 'filterModel' => $searchModel,
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],
    'stationname',
//    'EntryDate',
    'TIME',
    'D',
    'U',
    'P_L',
    'T_L',
    'G',
    'CH',
     ['class' => 'yii\grid\ActionColumn',
    'template' => '{view}',
    ]
    ],
    ]);
    ?>
</div>
