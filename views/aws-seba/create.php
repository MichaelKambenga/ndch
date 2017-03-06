<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AwsSeba */

$this->title = 'Create Aws Seba';
$this->params['breadcrumbs'][] = ['label' => 'Aws Sebas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aws-seba-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
