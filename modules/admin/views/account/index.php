<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'مدیریت حساب ها';

?>
<div class="account-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function($data) {
                    return '<a href="'.Yii::$app->urlManager->createUrl(['admin/account/report','id' => $data->id]).'">'.$data->username.'</a>';
                }
            ],
            'fullname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

