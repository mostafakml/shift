<?php

namespace app\modules\admin;
use yii;

/**
 * admin module definition class
 */
class AdminModule extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::configure($this, require(__DIR__ . '/config.php'));
    

        // custom initialization code goes here
    }
}
