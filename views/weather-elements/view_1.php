<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;

//popup  name spaces
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;


/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Weather Elements', 'url' => ['index']];
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
            'unitmeasure',
            'elementcode',
                      
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
        'dataProvider' => $dataElementList,
        'filterModel' => $searchElementList,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'itemname',
            'itemcode',
            
          ['class' => 'yii\grid\ActionColumn'],
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
                        'label' => ' ' . 'Element Details',
                        'content' => $stakeholdeDetails,
                        'options' => ['id' => 'Stakeholder-Details-tab'],
                       // 'active' => ($activeTab == 'Stakeholder-Details-tab'),
                    ],
                    [
                        'label' => ' ' . 'Sub Elements',
                        'content' => $stakeholderStations,
                        'options' => ['id' => 'Stations-tab'],
                      //  'active' => ($activeTab == 'Stations-tab'),
                    ],
                ],
                'bordered' => true,
            ]);
            ?>

    <?php
    // advanced html content (forms) with popover footer

$form = ActiveForm::begin( //'method' => 'POST',
                        // 'action' => ['site/index'],
        //['fieldConfig'=>['showLabels'=>false],]
        );
$searchElementList->elementid = $model->id;
PopoverX::begin([
    'placement' => PopoverX::ALIGN_TOP,
        'size'=>PopoverX::SIZE_LARGE,
    'toggleButton' => ['label'=>'Add Sub Element Item', 'class'=>'btn btn-default'],
    'header' => '<i class="glyphicon glyphicon-lock"></i> Add Sub Element for '.$model->name,
    'footer'=>Html::submitButton('Save', ['class'=>'btn btn-sm btn-primary']) 
]);
echo $form->field($searchElementList, 'itemname')->textInput(['placeholder'=>'Enter Item Name']);
echo $form->field($searchElementList, 'itemcode')->passwordInput(['placeholder'=>'Enter Item Code']);
PopoverX::end();
ActiveForm::end();
  ?>

