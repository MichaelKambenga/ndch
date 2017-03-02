<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ward */

$this->title = 'Add Ward';
$this->params['breadcrumbs'][] = ['label' => 'Wards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ward-create">

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

