<?php
use yii\helpers\Html;
use yii\grid\GridView;
use hoomanMirghasemi\jdf\Jdf;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
$this->title='report page'
    ?>
<br><br><br><br><br>
<div class="well">
   <div class="row">
       <div class="col-lg-12">

               <p>نام کاربری:</p>

               <p><?= $pUser->fullname ?></p>
           <p> مجموع ساعات کار</p>
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
           <p>وضعیت کاربر</p>
           <p>
               <?= $pUser->status() ?>
           </p>


           <p>
               <?php if ($pUser->status()=='آنلاین'):?>

                   <?= Html::a('خروج توسط ادمین', ['logout','user_id'=>$pUser->id], ['class' => 'btn btn-danger']) ?>
               <?php endif;?>
               <?php if ($pUser->status()=='آفلاین'):?>

                   <?= Html::a('ثبت زمان ورود توسط ادمین', ['login','user_id'=>$pUser->id], ['class' => 'btn btn-success']) ?>
               <?php endif;?>
           </p>









       </div>
      
   </div>
</div>
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



        <?= $form->field($newHour,'login')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '9999/99/99 99:99:99',
        ])?>

        <?= $form->field($newHour,'logout')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '9999/99/99 99:99:99',
        ])?>

        <div class="form-group">
            <?= Html::submitButton('ثبت', ['class' => 'btn btn-lg btn-success btn-block']) ?>
        </div>
    </fieldset>

<?php ActiveForm::end()?>



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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
