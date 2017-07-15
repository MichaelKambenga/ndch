<?php

use yii\helpers\Html;
use app\models\WeatherData;

$this->title = 'Weather Data / Import AWS Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-data-index">
    <div class="callout callout-info">
        <h4>Attention!</h4>
        <p>This Area is used to  Import data from AWS servers Depending on the Information  you provide in the form below. Please be careful on the information you provide 
            <!--        <ul>
                        <li>View Weather Data for different Stations of different Organizations</li>
                        <li>Manage Stations of your Organization including Station's users and Weather Elements</li>
                        <li>Generate Reports for different Weather Data for all the Stations of different Organizations</li>
                    </ul>-->
        </p>
    </div>
    <?php
    if (Yii::$app->session->hasFlash('sms')) {
        echo Yii::$app->session->getFlash('sms');
    }
    ?>
    <?php echo $this->render('_form_import_aws_data', ['model' => $model]); ?>

</div>
