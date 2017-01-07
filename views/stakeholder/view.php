<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use app\models\Region;
use app\models\District;
use app\models\Station;
use app\models\Stakeholder;

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
           // 'id',
            'name',
             array(
                'attribute' => 'orgtype',
                 'value' => function ($model) {
                 return $model->getOrgTypeName();
                 },
              ),
            'email:email',
            'mobileno',            
            array(
                'attribute'=>'datecreated',
                'value'=>Date('d, M Y @ H:i:s',  strtotime($model->datecreated)),
            ),
           array(
                'attribute'=>'status',
                'value' => function ($model) {
                 return $model->getOrgStatusName();
                 },
            ),
            [   'attribute'=>'datedeactivated',
                'value'=>$model->datedeactivated?Date('d, M Y @ H:i:s',  strtotime($model->datedeactivated)):' ',
            ],
            
        ],
    ])
    ?>

    <?php
    $stakeholdeDetails = ob_get_contents();
    ob_end_clean();
    ?>

<!--    STAKEHOLDER STATIONS-->
    
    <?php ob_start(); ?>
    <?php
   // Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider_station,
       // 'filterModel' => $model_station,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
           'stationcode',
           array(
            'attribute' => 'stationtype',
             'value' => function ($model) {
            return $model->getStationTypeName();
            },
             ),
                       [
            'attribute' => 'regionid',
             'value' => function ($model) {
            return Region::getRegionNameById($model->regionid);
            },
             ],
            [
            'attribute' => 'districtid',
             'value' => function ($model) {
            return District::getDistrictNameById($model->districtid);
            },
             ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
              'buttons' => [
              'view'=> function ($url, $model) {
                    return Html::a('view', Yii::$app->urlManager->createUrl(['station/view','id'=>$model->id]), [
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
           // Pjax::end();
            ?>

            <?php
            $stakeholderStations = ob_get_contents();
            ob_end_clean();
            ?>

<!--    SHOWWING DATA SOURCES-->
          <?php ob_start(); ?>
    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider_datasources,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             'name',
             'ipaddress',
             'datalocation',
           array(
             'attribute' => 'datasourcetype',
             'value' => function ($model) {
             return $model->getDataSourceTypeName();
                 },
             ),
//             ['class' => 'yii\grid\ActionColumn',
//            'template' => '{view}',
//             ],          
          ],
         'responsive' => true,
         'hover' => true,
         'condensed' => true,
         'floatHeader' => false,
         'panel' => [
                'showFooter' => false
            ],
          ]);
        Pjax::end();
            ?>
            <?php
            $stakeholderDataSources = ob_get_contents();
            ob_end_clean();
            ?>



        <!--START JUI TABS-->
            <?php
            echo TabsX::widget([
                'items' => [
                    [
                        'label' => ' ' . 'Basic Details',
                        'content' => $stakeholdeDetails,
                        'options' => ['id' => 'stakeholder-details-tab'],
                       // 'active' => ($activeTab == 'Stakeholder-Details-tab'),
                    ],
                    [
                        'label' => $model->name. ' - Stations',
                        'content' => $stakeholderStations,
                        'options' => ['id' => 'stations-tab'],
                      //  'active' => ($activeTab == 'Stations-tab'),
                    ],
                     [
                        'label' =>' Data Sources',
                        'content' => $stakeholderDataSources,
                        'options' => ['id' => 'data-sources-tab'],
                      //  'active' => ($activeTab == 'Stations-tab'),
                    ],
                ],
                'bordered' => true,
            ]);
            ?>

