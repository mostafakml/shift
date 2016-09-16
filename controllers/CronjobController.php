<?php
namespace app\controllers;
use app\models\Hours;
use yii\web\Controller;
use yii;
use yii\web;
class CronjobController extends Controller
{
    public function actionIndex()
    {
        Hours::updateAll([
            'logout' => time(),
            'exit_type' => 'SYSTEM'
        ], 'logout = :logout', [
            ':logout' => 0,
        ]);
    }
}