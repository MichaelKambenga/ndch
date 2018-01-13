<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\tabs\TabsX;
use app\models\Stakeholder;
use app\models\Region;
use app\models\District;
use app\models\Ward;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Stakeholder */

$this->title = 'Account Profile';
$this->params['breadcrumbs'][] = ['label' => 'My Account'];
?>
<?=
DetailView::widget([
    ///'options'=>['style'=>'width:100%;'],
    'model' => $model,
    'attributes' => [
        'firstname',
        'middlename',
        'lastname',
        'user_role',
        'organizationid',
        'stationid',
        'username',
        [
            'label' => 'Password',
            'attribute' => 'password_hash',
            'value' => ($model->password_hash) ? '*****************' : ''
        ]
    ],
])
?>
<p>
    <?= Html::a('Change Password', ['site/account-password'], ['class' => 'btn btn-primary']) ?>
</p>


