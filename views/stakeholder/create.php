<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = 'Create Stakeholder';
$this->params['breadcrumbs'][] = ['label' => 'Stakeholders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stakeholder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
