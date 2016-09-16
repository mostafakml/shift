<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title='به روز رسانی';
?>
<br>
<br>
<<br>
<br>
<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-2',
            'offset' => 'col-sm-offset-2',
            'wrapper' => 'col-sm-10'
        ]
    ],
    'layout' => 'horizontal',

    'options' => ['class' => 'form-inline' ,]

]);?>
<fieldset>



    <?= $form->field($mHours,'login')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '9999/99/99 99:99:99',
    ]);
    ?>

    <?= $form->field($mHours,'logout')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '9999/99/99 99:99:99',
    ])?>

    <div class="form-group">
        <?= Html::submitButton('ثبت', ['class' => 'btn btn-lg btn-success btn-block']) ?>
    </div>
</fieldset>

<?php ActiveForm::end()?>

