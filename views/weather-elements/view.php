<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
//use yii\jui\Tabs;
use yii\bootstrap\Tabs;



/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Weather Elements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('Update Element', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?=
    Html::a('Delete Element', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
    'confirm' => 'Are you sure you want to delete this item?',
    'method' => 'post',
    ],
    ])
    ?>
    <?= Html::a('Add Sub Element', ['weather-elements-list/create', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    
</p>
<?php
    $content=DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'unitmeasure',
            'elementcode',
                      
        ],
    ]);
    
    $content_subelement=GridView::widget([
        'dataProvider' => $dataElementList,
       //'filterModel' => $searchElementList,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'itemname',
            'itemcode',
            
          ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
              'delete'=> function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>', Yii::$app->urlManager->createUrl(['weather-elements-list/delete','id'=>$model->id]), [
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
echo TabsX::widget([
//       'options'=>[
//        'class'=>'Elements'
//        ],
        'items' => [
            [
            'label' => 'Element Details',
            'content' => $content,
            'options' => ['id' => 'details-tab'],
          // 'active' => true
            ],
            [
            'label' => $model->name.' - Sub Elemets',
            'content' => $content_subelement,
            'options' => ['id' => 'sub-elements-tab'],
            //'active' => TRUE
            ],

            ],
             'bordered' => true,
            ]);
?>