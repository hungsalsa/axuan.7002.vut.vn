<?php

namespace quantri\modules\setting\controllers;

use Yii;
use quantri\modules\setting\models\SettingDefault;
use quantri\modules\setting\models\SettingDefaultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for SettingDefault model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
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
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all SettingDefault models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingDefaultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SettingDefault model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SettingDefault model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SettingDefault();
        $model->layout_frontent = 1;

        if ($model->load($post = Yii::$app->request->post())) {
            $hostInfo = Yii::$app->request->hostInfo;
            if ($post['SettingDefault']['logo'] !='') {
                $model->logo = str_replace($hostInfo, "", $post['SettingDefault']['logo']);
            }
            if ($post['SettingDefault']['ad'] !='') {
                $model->ad = str_replace($hostInfo, "", $post['SettingDefault']['ad']);
            }
            if($model->errors){
                dbg($model->errors);
            }
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SettingDefault model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->layout_frontent = 1;

        if ($model->load($post = Yii::$app->request->post())) {
            $hostInfo = Yii::$app->request->hostInfo;
            if ($post['SettingDefault']['logo'] !='') {
                $model->logo = str_replace($hostInfo, "", $post['SettingDefault']['logo']);
            }
            if ($post['SettingDefault']['ad'] !='') {
                $model->ad = str_replace($hostInfo, "", $post['SettingDefault']['ad']);
            }
            if($model->errors){
                dbg($model->errors);
            }
            if($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SettingDefault model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SettingDefault model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingDefault the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingDefault::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
