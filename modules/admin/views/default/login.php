<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
AppAsset::register($this);
$this->registerCssFile(Yii::$app->urlManager->createUrl('css/login.css'));
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <title>ورود ادمین</title>
        <?php $this->head() ?>
    </head>
    <body>
    <div class="well">
        <h1 class="center-block"> صحفه ورود ادمین</h1>
    </div>
        <?php $this->beginBody() ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
               
                <div class="login-panel panel">
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(); ?>
                            <fieldset>
                                <?= $form->field($model, 'type')->hiddenInput(['value' => 0])->label(false) ?>

                                <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder'=> 'نام کاربری'])->label(false) ?>

                                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder'=> 'کلمه‌عبور'])->label(false) ?>

                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                <div class="form-group">
                                    <?= Html::submitButton('ورود', ['class' => 'btn btn-lg btn-success btn-block']) ?>
                                </div>
                            </fieldset>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <p style="text-align:center">طراحی و پیاده سازی توسط شرکت <a href="#">داده نگاران آساد کویر</a></p>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
