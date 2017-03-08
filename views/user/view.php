<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use yii\helpers\ArrayHelper;

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
 [
 'attribute' => 'organizationid',
 'value' => \app\models\Stakeholder::getStakeholderNameById($model->organizationid),
 'format' => 'html'
 ],
 'username',
 'status',
 [
'attribute' => 'created_at',
 'format' => ['date', 'php:d-M-Y @ H:i:s']
],
 'datedeactivated',
 'lastlogin',
[
'attribute' => 'logins',
  'label'=>'No logins'
 ],
 [
'attribute' => 'user_role',
 'value' => $model->getUserRolesName(),
 'format' => 'html'
],
 [
'attribute' => 'stationid',
 'value' => \app\models\Station::getNameById($model->stationid),
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
<?php
Pjax::begin();
echo GridView::widget([
'dataProvider' => $dataProviderAuditTrail,
//      'filterModel' => $model_audit_search,
'columns' => [
['class' => 'yii\grid\SerialColumn'],
 'id',
 'userid',
 'datecreated',
 'ipaddress',
 'object',
 // 'clientdetails:ntext',
// 'details:ntext',
// 'referer',
['class' => 'yii\grid\ActionColumn'],
],
]);
Pjax::end()
?>
<?php
$userAuditTrail = ob_get_contents();
ob_end_clean();
?>

<?php ob_start(); ?>

<?php
Pjax::begin();
echo GridView::widget([
'dataProvider' => $dataProviderLogins,
//        'filterModel' => $model_login_search,
'columns' => [
['class' => 'yii\grid\SerialColumn'],
//            'login_id',
[
'attribute' => 'userid',
 'vAlign' => 'middle',
 'width' => '200px',
 'value' => function ($model) {
return ($model->user->lastname . ' ' . $model->user->firstname);
},
 'filterType' => GridView::FILTER_SELECT2,
 'filter' => ArrayHelper::map(app\models\User::findBySql("select tbl_user.*, concat(lastname,', ',firstname,' ',middlename) AS fullname from tbl_user")->orderBy('id')->asArray()->all(), 'id', 'fullname'),
 'filterWidgetOptions' => [
'pluginOptions' => ['allowClear' => true],
],
 'filterInputOptions' => ['placeholder' => 'Search...'],
 'format' => 'raw'
],
 'details',
 'ipaddress',
 ['attribute' => 'datecreated', 'format' => ['datetime', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],
],
 'responsive' => true,
 'hover' => true,
 'condensed' => true,
 'floatHeader' => true,
 'panel' => [
'heading' => ' ',
 'type' => 'default',
//        'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
'showFooter' => false
],
]);
Pjax::end();
?>

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

