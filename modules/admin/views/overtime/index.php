<?php

use yii\helpers\Html;
use yii\grid\GridView;
use hoomanMirghasemi\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OvertimesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Overtimes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overtimes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'account.fullname',
                'value' => 'account.fullname'
            ],
            [
                'attribute' => 'hours.login',
                'value' => function($data) {
                    return $data->hours->login ? Jdf::jdate('H:i:s - Y/m/d', $data->hours->login) : '-';
                }
            ],
            [
                'attribute' => 'hours.logout',
                'value' => function($data) {
                    return $data->hours->logout ? Jdf::jdate('H:i:s - Y/m/d', $data->hours->logout) : '-';
                }
            ],

            [
                'attribute' => 'record_time',
                'value' => function($data) {
                    return $data->record_time ? Jdf::jdate('H:i:s - Y/m/d', $data->record_time) : '-';
                }
            ],

            'location',

            // 'description:ntext',
            // 'confirmed',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} {valid}',
                'buttons'=>[
                    'valid' => function ($url, $model) {
                        return Html::a('<i class="fa fa-check-square" aria-hidden="true"></i>', $url, [
                            'title' => Yii::t('yii', 'Create'),
                        ]);

                    }
                ]
            ]
        ],
    ]); ?>
</div>
<?php if($searchModel->scenario=='justNew'):?>
<div>
    <?= Html::a('نشان دادن همه اضافه کاری ها', ['showall'], ['class' => 'btn btn-primary']) ?>
</div>


<?php endif; ?>
<?php if($searchModel->scenario=='completeList'):?>
    <div>
        <?= Html::a('نشان دادن  اضافه کاری ها جدید', ['index'], ['class' => 'btn btn-success']) ?>
    </div>


<?php endif; ?>
