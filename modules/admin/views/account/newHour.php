<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title='create new record ';
?>
<br>
<br><br><br>
    <div class="account-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($newHour, 'user_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($newHour, 'login_time')->passwordInput(['maxlength' => true]) ?>

<?= $form->field($newHour, 'logout_time')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton( 'دخیره داده ها' ) ?>
    </div>

<?php ActiveForm::end(); ?>