<?php

namespace app\modules\admin\controllers;
use app\models\Overtimes;
use app\modules\admin\models\LoginForm;
use yii;

use app\component\MyController;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends MyController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'admin',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        
        return $this->render('index');
    }
    public function actionLogin()
    {
        if (!Yii::$app->admin->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
         //   return $this->goBack();
        }
        $this->layout = 'login';
        return $this->renderPartial('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->admin->logout(false);
        return $this->redirect(['index']);
    }
    public function actionTest()
    {
        return $this->redirect(['index']);

    }
    public function actionOvertime(){
        $omodel=Overtimes::find()->where('confirmed'==0);
        return $this->render('overtime', [
            'omodel'=>$omodel
        ]);
    }

}
