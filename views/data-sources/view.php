<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Stakeholder;
use app\models\DataSources;
use kartik\grid\GridView;
use app\models\Region;
use app\models\District;
use app\models\DataSourceStations;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\DataSources */

$this->title = 'Data Sources Details';
$this->params['breadcrumbs'][] = ['label' => 'Data Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-sources-view">

    <h1><?= Html::encode($this->title) ?></h1>
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
        ]);
        ?>
        <?= Html::a('Set Data Source Stations', ['add-station', 'id' => $model->id], ['class' => 'btn btn-primary', 'style' => 'margin-left:5%;']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'name',
                'label' => 'Data Source Name',
                'value' => $model->name,
            ],
            [
                'attribute' => 'awsvendor',
                'label' => 'Vendor',
                'value' => $model->getAWSDataSourceVendorName(),
                'visible' => $model->awsvendor ? TRUE : FALSE
            ],
            array(
                'attribute' => 'stakeholderid',
                'label' => 'Owner',
                'value' => function ($model) {
                    return Stakeholder::getStakeholderNameById($model->stakeholderid);
                },
            ),
            array(
                'attribute' => 'datasourcetype',
                'value' => function ($model) {
                    return strtoupper($model->getDataSourceTypeName());
                },
            ),
            'ipaddress',
            'datalocation',
            'loginname',
            [
                'attribute' => 'password',
                'value' => $model->password ? '*********' : "",
            ],
        ],
    ])
    ?>

    <?php
    $datasourceDetails = ob_get_contents();
    ob_end_clean();
    ?>

    <!--    DATASOUCE STATIONS-->

    <?php ob_start(); ?>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider_stations,
//        'filterModel' => $model_station,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            array(
                'label' => 'Station Name',
                'value' => 'station.name',
            ),
            array(
                'label' => 'Station Code',
                'value' => 'station.stationcode',
            ),
            array(
                'attribute' => 'datecreated',
                'label' => 'Date Created',
                'value' => 'datecreated',
            ),
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('view', Yii::$app->urlManager->createUrl(['station/view', 'id' => $model->stationid]), [
                        ]);
                    }
                        ],
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
            $datasourceStations = ob_get_contents();
            ob_end_clean();
            ?>

            <!--START JUI TABS-->
            <?php
            echo TabsX::widget([
                'items' => [
                    [
                        'label' => ' ' . 'Data Source Details',
                        'content' => $datasourceDetails,
                        'options' => ['id' => 'datasources-tab'],
                    // 'active' => ($activeTab == 'Stakeholder-Details-tab'),
                    ],
                    [
                        'label' => ' Data Source Stations',
                        'content' => $datasourceStations,
                        'options' => ['id' => 'data-source-stations-tab'],
                    //  'active' => ($activeTab == 'Stations-tab'),
                    ],
                ],
                'bordered' => true,
            ]);
            ?>
</div>
