<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hoomanMirghasemi\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hours-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <div class="well">
            <div class="row">
                <div class="col-lg-12">

                     <p>نام کاربری:</p>

                    <p><?= Yii::$app->user->identity->fullname ?></p>
                      <p> مجموع ساعات کار</p>

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
    </div>












</div>

</div>
        <?= Html::a('Create Hours', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



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
            [
                'label'=>'نوع خروج',
                'format' => 'raw',
                'value'=>function($data){
                    return $data->exit_types;
                }
            ],
            [
                'label'  =>'نوع خروج',
                'format' =>'raw',
                'value'=>function($data){
                    return $data->gettype();
                }
            ],
            // 'verified',
            // 'active',
            // 'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
