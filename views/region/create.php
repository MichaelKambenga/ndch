<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = 'Create Region';
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create">

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="box-body">

                    <?=
                    $this->render('_form', [
                        'model' => $model,
                    ])
                    ?>

                </div>
                <!-- ./box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</div>
