<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StakeholderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stakeholders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
<?= Html::a('Create Stakeholder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php
    Pjax::begin();
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'mobileno',
            'email:email',
            'orgtype',
            [
                'label' => 'Action',
                'value' => function($model) {

                    return Html::a('<span class=" label label-primary"><i class = "glyphicon glyphicon-eye-open"></i> More</span>', Yii::$app->urlManager->createUrl(['stakeholder/view', 'id' => $model->id]), [
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
                    'heading' => 'STAKEHOLDERS',
                    'type' => 'default',
                    'showFooter' => true
                ],
            ]);
            Pjax::end();
            ?>
</div>
