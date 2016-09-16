<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Hours;
use app\models\IpAddress;
use app\models\ContactForm;
use yii\web\Request;

class IpaddressController extends Controller
{
    public function actionIndex()
    {
        // $mIpAddress = IpAddress::find()->all();
        // foreach ($mIpAddress as $value) {
        //     exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($value->ip)), $res, $rval);
        //     if ($rval) {
        //         $req = IpAddress::findOne($value->user_id);
        //         $req->delete();
        //         $mHours = Hours::find()->where(['user_id' => $value->user_id])->orderBy('login DESC')->one();
        //         $mHours->logout = time();
        //         $mHours->save();
        //     }
        //
        // }
    }
}
