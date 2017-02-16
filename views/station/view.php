<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use app\models\Stakeholder;
use app\models\Region;
use app\models\District;
use app\models\Ward;

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
    ]);
    ?>
    <?= Html::a('Add Weather Element', ['station-weather-elements/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

</p>

<?=
DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'stationcode',
        array(
            'attribute' => 'stationtype',
            'value' => function ($model) {
                return $model->getStationTypeName();
            },
        ),
        array(
            'attribute' => 'stationowner',
            'value' => function ($model) {
                return Stakeholder::getStakeholderNameById($model->stationowner);
            },
        ),
        'geocode',
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
        [
            'attribute' => 'wardid',
            'value' => function ($model) {
                return Ward::getWardNameById($model->wardid);
            },
        ],
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
// 'filterModel' => $searchModel_station_weather_element,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        array(
            'attribute' => 'elementsid',
            'label' => 'Weather Element Name',
            'value' => function ($model) {
                return \app\models\WeatherElements::getElementNameById($model->elementsid);
            },
        ),
        'collectionfrequency',
        'accuracy',
        'surfacedistance',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{update} &nbsp;&nbsp;&nbsp;  {delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-edit"></span>', Yii::$app->urlManager->createUrl(array('station-weather-elements/update', 'id' => $model->id)), [
                    ]);
                },
                        'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', Yii::$app->urlManager->createUrl(array('station-weather-elements/delete', 'id' => $model->id)), [
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
        $stationWeatherElements = ob_get_contents();
        ob_end_clean();
        ?>

        <?php ob_start(); ?>
        <p>
            <?php
            if(Yii::$app->session->get('organizationUser') == 1){
            echo Html::a('Add User', ['update', 'id' => $model->id], ['class' => 'btn btn-success']);
            }
            ?>
        </p>
        <?php
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider_station_weather_element,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                array(
                    'attribute' => 'elementsid',
                    'label' => 'Weather Element Name',
                    'value' => function ($model) {
                        return \app\models\WeatherElements::getElementNameById($model->elementsid);
                    },
                ),
                'collectionfrequency',
                'accuracy',
                'surfacedistance',
                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{update} &nbsp;&nbsp;&nbsp;  {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', Yii::$app->urlManager->createUrl(array('station-weather-elements/update', 'id' => $model->id)), [
                            ]);
                        },
                                'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', Yii::$app->urlManager->createUrl(array('station-weather-elements/delete', 'id' => $model->id)), [
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
                $stationUsers = ob_get_contents();
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
                        [
                            'label' => ' ' . 'Station Users',
                            'content' => $stationUsers,
                            'options' => ['id' => 'Staions-User-tab'],
                        //  'active' => ($activeTab == 'Staions-User-tab'),
                        ],
                    ],
                    'bordered' => true,
                ]);
                ?>

