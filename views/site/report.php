<?php
//(Yii::$app->user->id != 6) ? \yii\web\Controller::redirect(['index']) : '';
use yii\helpers\Html;
use yii\grid\GridView;
use hoomanMirghasemi\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\InternetUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'لیست کاربران';
?>
<br><br><br><br><br>


<p>

    <?php

    $seconds = $total;
    $hours = floor($seconds / 3600);
    $mins = floor($seconds / 60 % 60);
    $secs = floor($seconds % 60);
    if ($hours < 10)
        $hours = "0$hours";
    if ($mins < 10)
        $mins = "0$mins";
    if ($secs < 10)
        $secs = "0$secs";
    echo "$hours:$mins:$secs";


     ?>
</p>

<div class="internet-users-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'fullname',
                'label' => 'نام کامل',
                'value' => function($data) {
                    return $data->user->fullname;
                }
            ],
            [
                'attribute' => 'login',
                'value' => function($data) {
                    return Jdf::jdate('H:i:s - Y/m/d',$data->login);
                }
            ],
            [
                'attribute' => 'logout',
                'value' => function($data) {
                    return $data->logout ? Jdf::jdate('H:i:s - Y/m/d',$data->logout) : '-';
                }
            ],
            [
                'label' => 'ساعت کاری',
                'value' => function($data) {
                    $seconds = $data->logout - $data->login;
                    $hours = floor($seconds / 3600);
                    $mins = floor($seconds / 60 % 60);
                    $secs = floor($seconds % 60);
                    if ($hours < 10)
                        $hours = "0$hours";
                    if ($mins < 10)
                        $mins = "0$mins";
                    if ($secs < 10)
                        $secs = "0$secs";
                    return $data->logout ? "$hours:$mins:$secs" : '-';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

