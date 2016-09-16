<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use hoomanMirghasemi\jdf\Jdf;

$day = 24 * 60 * 60;
$saturdaySum = $sundaySum = $mondaySum = $tuesdaySum = $wednesdaySum = $thursdaySum = 0;
$saturday = \app\models\Hours::find()->where('user_id = :user_id AND login >= :login AND logout <= :logout')->params([
    ':user_id' => Yii::$app->user->identity->id,
    ':login' => strtotime(date('Y/m/d 00:00:00',strtotime("previous friday")+($day*1))),
    ':logout' => strtotime(date('Y/m/d 23:59:59',strtotime("previous friday")+($day*1))),
])->all();

$sunday = \app\models\Hours::find()->where('user_id = :user_id AND login >= :login AND logout <= :logout')->params([
    ':user_id' => Yii::$app->user->identity->id,
    ':login' => strtotime(date('Y/m/d 00:00:00',strtotime("previous friday")+($day*2))),
    ':logout' => strtotime(date('Y/m/d 23:59:59',strtotime("previous friday")+($day*2))),
])->all();

$monday = \app\models\Hours::find()->where('user_id = :user_id AND login >= :login AND logout <= :logout')->params([
    ':user_id' => Yii::$app->user->identity->id,
    ':login' => strtotime(date('Y/m/d 00:00:00',strtotime("previous friday")+($day*3))),
    ':logout' => strtotime(date('Y/m/d 23:59:59',strtotime("previous friday")+($day*3))),
])->all();

$tuesday = \app\models\Hours::find()->where('user_id = :user_id AND login >= :login AND logout <= :logout')->params([
    ':user_id' => Yii::$app->user->identity->id,
    ':login' => strtotime(date('Y/m/d 00:00:00',strtotime("previous friday")+($day*4))),
    ':logout' => strtotime(date('Y/m/d 23:59:59',strtotime("previous friday")+($day*4))),
])->all();

$wednesday = \app\models\Hours::find()->where('user_id = :user_id AND login >= :login AND logout <= :logout')->params([
    ':user_id' => Yii::$app->user->identity->id,
    ':login' => strtotime(date('Y/m/d 00:00:00',strtotime("previous friday")+($day*5))),
    ':logout' => strtotime(date('Y/m/d 23:59:59',strtotime("previous friday")+($day*5))),
])->all();

$thursday = \app\models\Hours::find()->where('user_id = :user_id AND login >= :login AND logout <= :logout')->params([
    ':user_id' => Yii::$app->user->identity->id,
    ':login' => strtotime(date('Y/m/d 00:00:00',strtotime("previous friday")+($day*6))),
    ':logout' => strtotime(date('Y/m/d 23:59:59',strtotime("previous friday")+($day*6))),
])->all();

$this->title = 'صفحه اصلی';
$this->registerCssFile(Yii::$app->urlManager->createUrl('css/site.css'));
?>

<div class="row">
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin(); ?>
            <fieldset>
                <div class="form-group">
                    <?= Html::hiddenInput('type',$type); ?>
                    <?= Html::submitButton($type == 1 ? 'ثبت زمان ورود' : 'ثبت زمان خروج', $type == 1 ? ['class' => 'btn btn-lg btn-success btn-block'] : ['class' => 'btn btn-danger btn-lg btn-block']) ?>
                </div>
            </fieldset>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <h2>زمان ورود و خروج</h2>
        <p>در این جدول ۷ ورود و خروج شما را نشان میدهد، برای اطلاعات بیشتر به بخش گزارش بروید.</p>
        <p><?= Jdf::jdate('امروز: l، j F'); ?></p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>زمان ورود</th>
                    <th>زمان خروج</th>
                    <th>ساعت کاری</th>
                    <th>نوع خروج</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($model as $value) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= Jdf::jdate('H:i:s - Y/m/d',$value->login); ?></td>
                    <td><?= !$value->logout ? '-' : Jdf::jdate('H:i:s - Y/m/d',$value->logout); ?></td>
                    <td><?= !$value->logout ? '-' : gmdate('H:i:s',$value->logout - $value->login); ?></td>
                    <td>
                        <?=$value->exit_types?>
                    </td>
                </tr>
                    <?php $i++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <h2>ساعت کاری هفته جاری</h2>
        <p>در این جدول شما ساعت کاری هفته جاری را مشاهد میکنید.</p>
        <p>تاریخ هفته جاری از <?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*1)) ?> تا <?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*6)) ?></p>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>نام هفته</th>
                    <th>تاریخ</th>
                    <th>ساعت کاری</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>شنبه</td>
                    <td><?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*1)) ?></td>
                    <?php foreach ($saturday as $value) {
                        if ($value->logout == 0)
                            continue;
                        $saturdaySum += $value->logout - $value->login;
                    }?>
                    <td><?= $saturdaySum ? gmdate('H:i:s',$saturdaySum) : '-' ?></td>

                </tr>
                <tr>
                    <td>یک‌شنبه</td>
                    <td><?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*2)) ?></td>
                    <?php foreach ($sunday as $value) {
                        if ($value->logout == 0)
                            continue;
                        $sundaySum += $value->logout - $value->login;
                    }?>
                    <td><?= $sundaySum ? gmdate('H:i:s',$sundaySum) : '-' ?></td>
                </tr>
                <tr>
                    <td>دوشنبه</td>
                    <td><?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*3)) ?></td>
                    <?php foreach ($monday as $value) {
                        if ($value->logout == 0)
                            continue;
                        $mondaySum += $value->logout - $value->login;
                    }?>
                    <td><?= $mondaySum ? gmdate('H:i:s',$mondaySum) : '-' ?></td>
                </tr>
                <tr>
                    <td>سه‌شنبه</td>
                    <td><?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*4)) ?></td>
                    <?php foreach ($tuesday as $value) {
                        if ($value->logout == 0)
                            continue;
                        $tuesdaySum += $value->logout - $value->login;
                    }?>
                    <td><?= $tuesdaySum ? gmdate('H:i:s',$tuesdaySum) : '-' ?></td>
                </tr>
                <tr>
                    <td>چهارشنبه</td>
                    <td><?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*5)) ?></td>
                    <?php foreach ($wednesday as $value) {
                        if ($value->logout == 0)
                            continue;
                        $wednesdaySum += $value->logout - $value->login;
                    }?>
                    <td><?= $wednesdaySum ? gmdate('H:i:s',$wednesdaySum) : '-' ?></td>
                </tr>
                <tr>
                    <td>پنج‌شنبه</td>
                    <td><?= Jdf::jdate('Y/m/d',strtotime("previous friday")+($day*6)) ?></td>
                    <?php foreach ($thursday as $value) {
                        if ($value->logout == 0)
                            continue;
                        $thursdaySum += $value->logout - $value->login;
                    }?>
                    <td><?= $thursdaySum ? gmdate('H:i:s',$thursdaySum) : '-' ?></td>
                </tr>
                <tr>
                    <th colspan="2">جمع ساعت کاری هفته جاری</th>
                    <?php
                        $seconds = $saturdaySum + $sundaySum + $mondaySum + $tuesdaySum + $wednesdaySum + $thursdaySum;
                        $hours = floor($seconds / 3600);
                        $mins = floor($seconds / 60 % 60);
                        $secs = floor($seconds % 60);
                        if ($hours < 10)
                            $hours = "0$hours";
                        if ($mins < 10)
                            $mins = "0$mins";
                        if ($secs < 10)
                            $secs = "0$secs";
                    ?>
                    <td><?= $seconds ? "$hours:$mins:$secs" : '-' ?></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>


