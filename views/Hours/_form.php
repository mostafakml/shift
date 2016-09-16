<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Hours */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hours-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logout')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exit_type')->dropDownList([ 'SELF' => 'SELF', 'ADMIN' => 'ADMIN', 'SYSTEM' => 'SYSTEM', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'verified')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
