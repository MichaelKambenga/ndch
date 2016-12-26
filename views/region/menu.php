<?php
  use yii\helpers\Html;
  ?>

<p>
    <?= Html::a('Create/Add New Region', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Back to  Region(s)', ['index'], ['class' => 'btn btn-info']) ?>
   
  <?php // if(isset ($model)):
  ?>
    <?php   //Html::a('Update This Region', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    <?php 
//    Html::a('Delete This Region', ['delete', 'id' => $model->id], [
//    'class' => 'btn btn-danger',
//    'data' => [
//    'confirm' => 'Are you sure you want to delete this item?',
//    'method' => 'post',
//    ],
//    ])
    ?>
    
    <?php //endif; ?>
</p>