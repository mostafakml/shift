<?php
$this->title='تغییر گذر واژه';
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div>
    <br><br><br>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-5',
                'offset' => 'col-sm-offset-5',
                'wrapper' => 'col-sm-12'
            ]
        ],
        'layout' => 'horizontal',

        'options' => ['class' => 'form-inline' ,]

    ]);?>
    <fieldset>



        <?= $form->field($Cmodel,'password')->passwordInput()?>
        <?= $form->field($Cmodel,'newpassword')->passwordInput()?>

        <?= $form->field($Cmodel,'password_repeat')->passwordInput()?>

        <div class="form-group">
            <?= Html::submitButton('ثبت', ['class' => 'btn btn-lg btn-success btn-block']) ?>
        </div>
    </fieldset>

    <?php ActiveForm::end()?>
</div>
