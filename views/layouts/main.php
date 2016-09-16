<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
        'brandLabel' => '<span style="color:#b11515;">HOME</span> <span style="color:#fff;">PAGE</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'صفحه اصلی', 'url' => ['/site/index']],
            (Yii::$app->user->id == 6) ? ['label' => 'گزارش', 'url' => ['/site/report']] : '',
            ['label' => 'پیام', 'url' => ['/site/contact']],
            [
                'label'=>'درخواست ها',
                'items'=>[
                    ['label' =>'در خواست اضافه کاری' , 'url'=>['/site/overtime']],
                    ['label'=>'درخواست مجوز خروج','url'=>['site/exitreq']],
                ]
            ],
            [
                'label'=>'گزارشات',
                'items'=>[
                    ['label'=>'گزارش اضافه کاری ها ' , 'url'=>['/site/overtimereport']],
                    ['label'=>'گزارشات کلی' ,         'url'=>['/hours/index']]
                ]
            ],

            Yii::$app->user->isGuest ?
            (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
            [
               'label' => Yii::$app->user->identity->fullname,
               'items' => [
                    ['label' => '<i class="fa fa-user fa-fw"></i> پروفایل', 'encode'=> false, 'url' => ['/site/profile']],
                    '<li class="divider"></li>',
                    ['label' => '<i class="fa fa-sign-out fa-fw"></i> خروج', 'encode'=> false, 'url' => ['/site/logout']],
                   '<li class="divider"></li>',
                   ['label'=>'تعویض گذر واژه', 'url'=>['/site/changepass']],
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
