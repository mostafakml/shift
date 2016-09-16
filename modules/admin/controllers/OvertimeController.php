<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Overtimes;
use app\models\OvertimesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\component\MyController;
use yii\filters\AccessControl;
use hoomanMirghasemi\jdf\Jdf;

/**
 * OvertimeController implements the CRUD actions for Overtimes model.
 */
class OvertimeController extends MyController
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
     * Lists all Overtimes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OvertimesSearch();
        $searchModel->scenario=OvertimesSearch::SCENARIO_NEW;
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

       
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          
        ]);
    }

    /**
     * Displays a single Overtimes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Overtimes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Overtimes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Overtimes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Overtimes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionValid($id){


        $omodel=$this->findModel($id);
        $omodel->confirmed=1;
        $omodel->save();
        if ($omodel->save()){
            return $this->redirect(['index']);
        }else{
            return 0;
        }

    }
    public  function actionShowall(){
        $searchModel = new OvertimesSearch();
        $searchModel->scenario=OvertimesSearch::SCENARIO_COMPLETE;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Finds the Overtimes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Overtimes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Overtimes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
