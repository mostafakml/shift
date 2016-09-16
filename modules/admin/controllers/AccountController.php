<?php

namespace app\modules\admin\controllers;

use app\models\Hours;
use app\modules\admin\models\CreateHour;
use Yii;
use app\models\Account;
use app\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\models\HoursSearch;
use yii\filters\AccessControl;
use hoomanMirghasemi\jdf\Jdf;
use app\component\MyController;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends MyController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'admin',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]

                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=Hours::find()->where(['id'=>$id])->one();
        $model->login=Jdf::jdate('Y/m/d H:i:s',$model->login);
        $model->logout=Jdf::jdate('Y/m/d H:i:s',$model->logout);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $mHours = Hours::find()->where(['id'=>$id])->one();
        $mHours->changeFormat();
        if ($mHours->load(Yii::$app->request->post()) && $mHours->changeFormatJdf()) {
            return $this->redirect(['report', 'id' => $mHours->user_id]);
        } else {
            return $this->render('update', [
                'mHours' => $mHours,
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       $hModel=Hours::find()->where(['id'=>$id])->one();
        $hModel->active=0;
        $hModel->save();
        var_dump('ok');
       

        return $this->redirect(['report','id' =>$hModel->user_id]);
    }
    public function actionReport($id){


        $searchModel = new HoursSearch();
        $newHour=new Hours();
        $searchModel->user_id = $id;
        $pUser = \app\models\Account::findOne($id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $models = $dataProvider->getModels();

      
        $totallogin = '';
        $totallogout = '';
        $newHour->user_id=$id;
        
       

        if ($newHour->load(Yii::$app->request->post()) && $newHour->setNewrecord($id)) {


            return $this->redirect(['report','id'=>$id]);
        }else{
            
       // die();
        }

        foreach ($models as $value) {
            $totallogin += $value->login;
            $totallogout += $value->logout;
        }
        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'total' => ($totallogout - $totallogin),
            'pUser' => $pUser,
            'newHour'=>$newHour
        ]);
    }
    public function actionLogout($user_id){
        Hours::updateAll([
            'logout' => strval(time()),
            'exit_type' => 'ADMIN'
        ], 'user_id = :user_id', [
            ':user_id' => $user_id,
        ]);
        return $this->redirect(['report','id'=>$user_id]);


       

        }
   

       
    public function actionLogin($user_id){

        $model = new Hours();
        $model->user_id=$user_id;
        $model->login=strval(time());
        $model->active=1;
        $model->save();


        return $this->redirect(['report','id'=>$user_id]);
    }
   

        

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
}
