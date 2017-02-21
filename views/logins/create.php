<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Logins */

$this->title = 'Create Logins';
$this->params['breadcrumbs'][] = ['label' => 'Logins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logins-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
