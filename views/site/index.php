<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to NDCH System</h1>

 <?php       
   if(Yii::$app->session->get('organizationUser') == 1){
       echo 'I am an organization user';
   }
   
    if(Yii::$app->session->get('stationUser') == 1){
       echo 'I am a station user';
   } 
   ?>

       </div>

    <div class="body-content">

    </div>
</div>
