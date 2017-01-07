<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LoginAttempt */

$this->title = 'Create Login Attempt';
$this->params['breadcrumbs'][] = ['label' => 'Login Attempts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-attempt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
