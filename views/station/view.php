<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Station', 'url' => ['index']];
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
        'name',
        'stationcode',
        'stationtype',
        'stationowner',
        'geocode',
        'regionid',
        'districtid',
        'wardid',
    ],
])
?>

<?php
$stationDetails = ob_get_contents();
ob_end_clean();
?>


<?php ob_start(); ?>
<?php
Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider_station_weather_element,
    'filterModel' => $searchModel_station_weather_element,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'elementsid',
        'collectionfrequency',
        'accuracy',
        'surfacedistance',
        [
            'label' => 'Action',
            'value' => function($model) {
                return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i> More</span>', Yii::$app->urlManager->createUrl(['station-weather-elements/view', 'id' => $model->id]), [
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
        $stationWeatherElements = ob_get_contents();
        ob_end_clean();
        ?>

        <?php
        echo TabsX::widget([
            'items' => [
                [
                    'label' => ' ' . 'Basic Station Details',
                    'content' => $stationDetails,
                    'options' => ['id' => 'Station-Details-tab'],
                   // 'active' => ($activeTab == 'Station-Details-tab'),
                ],
                [
                    'label' => ' ' . 'Station Weather Elements',
                    'content' => $stationWeatherElements,
                    'options' => ['id' => 'Staions-Weather-Elements-tab'],
                  //  'active' => ($activeTab == 'Staions-Weather-Elements-tab'),
                ],
            ],
            'bordered' => true,
        ]);
        ?>

