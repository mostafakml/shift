<?php
$this->title='در خواست اضافه کاری';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\time\TimePicker;
use jDate\DatePicker;

?>
<div class="row">
    <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
        <div id="admin_login_logo">
           <p1>فرم درخواست اضافه کاری</p1>
        </div>
        <div class="login-panel panel">
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'id' => 'FORMOT',
                    ]
                ]); ?>
                <fieldset>
                    <?= $form->field($Turndate,'date')->widget(DatePicker::classname(), [ 'name' => 'datepicker'])
                    ?>
                    <?= $form->field($Turndate,'startTime')->widget(TimePicker::classname(), [])
                   ?>

                    <?= $form->field($Turndate,'endTime')->widget(TimePicker::classname(), [])?>

                    <?= $form->field($overtimeModel, 'location_Serve')->dropDownList(['داخل شرکت','خارج شرکت'],[0,1]) ?>
                    <?= $form->field($overtimeModel, 'description')->textarea()?>

                    
                    <div class="form-group">
                        <?= Html::submitButton('ثبت', ['class' => 'btn btn-lg btn-success btn-block']) ?>
<!--                       
                    </div>
                </fieldset>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>

<?php
//$this->registerJs("
//$('#sendform').click(function(){
//    $.ajax({
//            type: 'POST',
//            url: '".Yii::$app->urlManager->createUrl('site/overtime')."',
//            data: $('#FORMOT').serialize(),
//            success: function(result){
//                if(result) {
//                    $.alert({
//                        title: 'Alert!',
//                        content: 'درخواست شما با موفقین ثبت شد ',
//                        confirm: function(){
//
//
//                        }
//                    });
//                } else {
//                    $.alert({
//                        title: 'Alert!',
//                        content: 'مشکلی در ثبت درخواست به وجود امده لطفا دباره تلاش نمایید',
//                        confirm: function(){
//
//                        }
//                    });
//                }
//            }
//        });
//    });
////");
//?>
