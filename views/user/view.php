<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use app\models\Region;
use app\models\District;
use app\models\Station;
use app\models\Stakeholder;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = $model->firstname . ' ' . $model->lastname . ' - [ ' . $model->username . ' ]';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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
        'firstname',
        'middlename',
        'lastname',
        'organizationid',
        'username',
        'status',
        'created_at',
        'datedeactivated',
        'lastlogin',
        'logins',
        [
            'attribute' => 'user_role',
            'value' => $model->getUserRolesName(),
            'format' => 'html'
        ]
    ],
])
?>

<?php
$userDetails = ob_get_contents();
ob_end_clean();
?>

<?php ob_start(); ?>

<?php ob_start(); ?>

<?php
$userAuditTrail = ob_get_contents();
ob_end_clean();
?>

<?php ob_start(); ?>

<?php
$userLogins = ob_get_contents();
ob_end_clean();
?>


<!--START JUI TABS-->
<?php
echo TabsX::widget([
    'items' => [
        [
            'label' => ' ' . 'User Basic Details',
            'content' => $userDetails,
            'options' => ['id' => 'user-details-tab'],
        // 'active' => ($activeTab == 'Stakeholder-Details-tab'),
        ],
        [
            'label' => ' User Audit Trail',
            'content' => $userAuditTrail,
            'options' => ['id' => 'user-audit-trail-tab'],
        //  'active' => ($activeTab == 'Stations-tab'),
        ],
        [
            'label' => ' User Logins',
            'content' => $userLogins,
            'options' => ['id' => 'user-logins-tab'],
        //  'active' => ($activeTab == 'Stations-tab'),
        ],
    ],
    'bordered' => true,
]);
?>

