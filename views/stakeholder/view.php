<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stakeholders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
ob_start();
?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'mobileno',
            'email:email',
            'orgtype',
            'datecreated',
            'status',
            'datedeactivated',
        ],
    ])
    ?>

    <?php
    $stakeholdeDetails = ob_get_contents();
    ob_end_clean();
    ?>

    
    <?php ob_start(); ?>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider_station,
        'filterModel' => $searchModel_station,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'stationcode',
            'stationtype',
            'stationowner',
            'geocode',
            'regionid',
            'districtid',
            'wardid',
            [
                'label' => 'Action',
                'value' => function($model) {
                    return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i> More</span>', Yii::$app->urlManager->createUrl(['station/view', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'View Details'),
                    ]);
                },
                        'format' => 'raw',
                    ],
                ],
                'responsive' => true,
                'hover' => true,
                'condensed' => true,
                'floatHeader' => false,
                'panel' => [
                    'heading' => ' ',
                    'type' => 'default',
                    'showFooter' => false
                ],
            ]);
            Pjax::end();
            ?>

            <?php
            $stakeholderStations = ob_get_contents();
            ob_end_clean();
            ?>

            <?php
            echo TabsX::widget([
                'items' => [
                    [
                        'label' => ' ' . 'Basic Stakeholder Details',
                        'content' => $stakeholdeDetails,
                        'options' => ['id' => 'Stakeholder-Details-tab'],
                        'active' => ($activeTab == 'Stakeholder-Details-tab'),
                    ],
                    [
                        'label' => ' ' . 'Stakeholder Stations',
                        'content' => $stakeholderStations,
                        'options' => ['id' => 'Staions-tab'],
                        'active' => ($activeTab == 'Staions-tab'),
                    ],
                ],
                'bordered' => true,
            ]);
            ?>

