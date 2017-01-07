<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserAuditTrail */

$this->title = 'Create User Audit Trail';
$this->params['breadcrumbs'][] = ['label' => 'User Audit Trails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-audit-trail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
