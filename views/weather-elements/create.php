<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeatherElements */

$this->title = 'Add Weather Elements';
$this->params['breadcrumbs'][] = ['label' => 'Weather Elements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-elements-create">

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
