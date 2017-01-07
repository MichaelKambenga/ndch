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
        ]);?>
       <?= Html::a('Set Data Source Stations', ['add-station', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
   </p>

    <?=
    DetailView::widget([
    'model' => $model,
    'attributes' => [
    'name',
    'ipaddress',
    'datalocation',
    array(
    'attribute' => 'stakeholderid',
    'value' => function ($model) {
    return Stakeholder::getStakeholderNameById($model->stakeholderid);
    },
    ),
    array(
    'attribute' => 'orgtype',
    'value' => function ($model) {
    return $model->getDataSourceTypeName();
    },
    ),
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
    GridView::widget([
    'dataProvider' => $dataProvider_stations,
    // 'filterModel' => $model_station,
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'],
    array(
      'attribute'=>'stationcode',
        'value'=>'station.stationcode',
    ),
     array(
      'attribute'=>'stationid',
        'value'=>'station.name',
    ),
     array(
      'attribute'=>'stationid',
        'value'=>'station.name',
    ),
    ['class' => 'yii\grid\ActionColumn',
    'template' => '{view}',
    'buttons' => [
    'view' => function ($url, $model) {
    return Html::a('view', Yii::$app->urlManager->createUrl(['station/view', 'id' => $model->id]), [
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
