<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$script = <<< JS
$(document).ready(function(){
   $('input').focus(function(){
     //  alert('dsdf');
       if($('.alert-success').length)
       {
           $('.alert-success').remove();
       }
   }) ;
});
JS;
$this->registerJs($script);
?>
<div class="register">
 <?php if (Yii::$app->session->hasFlash('Rigistered Successfully')){ ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>
    <?php } ?>
    <?php $form = ActiveForm::begin(); ?>
<?php $model->gender='Male';?><?php $model->status='Married';       ?>
        <?= $form->field($model, 'firstname') ?>
        <?= $form->field($model, 'lastname') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'gender')->radioList(['Male'=>'Male','Female'=>'Female'])->label('Gender') ?>
        <?= $form->field($model, 'status')->radioList(['Married'=>'Married','Single'=>'Single']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- register -->
