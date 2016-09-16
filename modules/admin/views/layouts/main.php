<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
$new_data_number=5;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span style="color:#b11515;">ASAD</span> <span style="color:#fff;">CO</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label'=>'مدیریت حساب', 'url'=>['account/index']],
            ['label' => 'صفحه اصلی', 'url' => ['default/index']],
            ['label'=>'درخواست های اضافه کاری '.\app\models\Overtimes::find()->where(['confirmed'=>0])->count(),'url'=>['overtime/index']],
            (Yii::$app->admin->id ) ? ['label' => 'گزارش', 'url' => ['default/report']] : '',
            ['label' => 'پیام', 'url' => ['/site/contact']],
            Yii::$app->admin->isGuest ?
            (
            ['label' => 'Login', 'url' => ['default/login']]
            ) : (
            [
               'label' => Yii::$app->admin->identity->fullname,
               'items' => [
                    ['label' => '<i class="fa fa-user fa-fw"></i> پروفایل', 'encode'=> false, 'url' => ['default/profile']],
                    '<li class="divider"></li>',
                    ['label' => '<i class="fa fa-sign-out fa-fw"></i> خروج', 'encode'=> false, 'url' => ['default/logout']],
               ],

           ])
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ASAD CO <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer> -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
