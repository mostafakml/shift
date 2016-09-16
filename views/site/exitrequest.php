<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use jDate\DatePicker;
use kartik\time\TimePicker;
$this->title='مجوز خروج';
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
        <div id="admin_login_logo">
            <p1>فرم درخواست مجوز خروج</p1>
        </div>
        <div class="login-panel panel">
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>
                <fieldset>
                    <?= $form->field($Turndate,'date')->widget(DatePicker::classname(), [ 'name' => 'datepicker'])
                    ?>
                    <?= $form->field($Turndate,'startTime')->widget(TimePicker::classname(), [])
                    ?>

                    <?= $form->field($Turndate,'endTime')->widget(TimePicker::classname(), [])?>

                    <?= $form->field($Emodel, 'type')->dropDownList(['مرخصی','ماموریت'],[0,1]) ?>
                    <?= $form->field($Emodel, 'description')->textarea()?>


                    <div class="form-group">
                                                <?= Html::submitButton('ثبت', ['class' => 'btn btn-lg btn-success btn-block']) ?>
                        
                    </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>

