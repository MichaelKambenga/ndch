<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AwsVaisala */

$this->title = 'Create Aws Vaisala';
$this->params['breadcrumbs'][] = ['label' => 'Aws Vaisalas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-vaisala-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
