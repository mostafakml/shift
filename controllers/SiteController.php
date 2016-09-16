<?php

namespace app\controllers;

use app\models\Account;
use app\models\ChangepassModel;
use app\models\ExitRequest;
use app\models\Overtimes;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Hours;
use app\models\HoursSearch;
use app\models\IpAddress;
use app\models\ContactForm;
use yii\web\Request;
use app\models\TurnDateModel;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        if (Yii::$app->request->post()) {

                $type = Yii::$app->request->post('type');

          
            $type = Yii::$app->request->post('type');

            if ($type == 1) {
                $model = new Hours();
                $model->login=strval(time());
                $model->active=1;
                $model->verified=0;


                $model->user_id=yii::$app->user->id;

                $model->save();

                


 
            } else {
                $model = Hours::find()->where([
                    'user_id' => Yii::$app->user->identity->id,
                ])->orderBy(['id' => SORT_DESC])->one();
                $model->logout=strval(time());
                $model->exit_type='SELF';
                $model->save();
             
            }
            return Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl(''));
        }

        $lg = Hours::find()->where([
            'user_id' => Yii::$app->user->identity->id,
        ])->orderBy(['id' => SORT_DESC])->one();

        $model = Hours::find()->where([
            'user_id' => Yii::$app->user->identity->id,
        ])->orderBy(['id' => SORT_DESC])->limit(7)->all();

        if ($lg == null || $lg->logout != 0)
            $type = 1;
        else
            $type = 2;

        return $this->render('index',[
            'type' => $type,
            'model' => $model
        ]);
    }

    public function actionLogin()
    {
       // Yii::$app->urlManager='/site/index';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack('index');
        }
        $this->layout = 'login';
        return $this->renderPartial('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout(false);

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionReport()
    {
        $searchModel = new HoursSearch();
        $searchModel->user_id = 7;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();
        $totallogin = '';
        $totallogout = '';
        foreach ($models as $value) {
            $totallogin += $value->login;
            $totallogout += $value->logout;
        }
        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'total' => ($totallogout - $totallogin),
        ]);
    }
    public function actionOvertime(){
        $overtimModel=new Overtimes();
        $Turndate=new TurnDateModel();
        $Turndate->scenario='overtime';
        
        
//        $hourModel=new Hours();
//        $hourModel->scenario='overtime';

        if ($Turndate->load(Yii::$app->request->post()) && $Turndate->setTimestamp(Yii::$app->user->id)) {
            
            if ($overtimModel->load(Yii::$app->request->post()) && $overtimModel->setNewrecord(Yii::$app->user->id)) {


                return $this->redirect(['index']);
            } else {
                return 0;
            }
        }
       
        return $this->render('overtime' , [
            'overtimeModel'=>$overtimModel,
            'Turndate'=>$Turndate,
            
           ]);
    }
    public function actionChangepass(){

        $Cmodel= new ChangepassModel();
        if ($Cmodel->load(Yii::$app->request->post()) && $Cmodel->validate()) {
            $Umodel=Account::findOne(Yii::$app->user->id);
            $Umodel->password = $Cmodel->newpassword;
            $Umodel->save(false);
            return $this->redirect(['index']);
        }

        return $this->render('changepass',compact('Cmodel'));
    }


    public function actionOvertimereport(){
        $Omodel=Overtimes::find()->where([
            'user_id' => Yii::$app->user->identity->id,
        ])->orderBy(['id' => SORT_DESC])->limit(7)->all();
        return $this->render('reportovertime', compact('Omodel'));
    }
    public function actionExitreq(){
        $Turndate=new TurnDateModel();
        $Turndate->scenario='exitreq';
        $Emodel=new ExitRequest();


//        $hourModel=new Hours();
//        $hourModel->scenario='overtime';

        if ($Turndate->load(Yii::$app->request->post()) && $Turndate->setTimestamp(Yii::$app->user->id)) {

            if ($Emodel->load(Yii::$app->request->post()) && $Emodel->setNewrecord(Yii::$app->user->id)) {


                return $this->redirect(['index']);
            } else {
                return 0;
            }
        }
        
       
        return $this->render('exitrequest',[
            'Turndate'=>$Turndate,
            'Emodel'=>$Emodel
        ]);
        
    }
}
