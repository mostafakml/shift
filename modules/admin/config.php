<?php
return

[
    'components' => [
        'admin'=>[
            'class' =>'yii\web\User',
            'identityClass' => 'app\models\Account',
            'enableAutoLogin' => true,
            'loginUrl'=>['admin/default/login'],
            'idParam'=> 'admin',

        ]
        ]
]
?>