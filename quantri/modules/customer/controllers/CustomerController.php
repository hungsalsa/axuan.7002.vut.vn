<?php

namespace quantri\modules\customer\controllers;

use Yii;
use quantri\modules\customer\models\Customers;
use quantri\modules\customer\models\CustomersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use yii\web\NotFoundHttpException;
/**
 * CustomerController implements the CRUD actions for Customers model.
 */
class CustomerController extends Controller
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
     * Lists all Customers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customers model.
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
     * Creates a new Customers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at=time();
        $model->userUpdated = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customers model.
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
     * Finds the Customers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionQuickchange($id)
    {
        try {
            $model = $this->findModel($id);
            if ($model->status==0) {
                $model->status = 1;
                $postValue = ' Đã tiếp nhận';
            } else {
                $model->status = 0;
                $postValue = 'Chưa tiếp nhận';
            }
            $result = [
                'id' => $id,
                'value_post' => $model->status,
                'name' => $model->fullname,
                'field' => 'status',
                'message' => 'Bạn '.$postValue.' khách hàng :' .$model->fullname,
            ];
            $result = array_merge($result,["postValue" => $postValue]);

            $model->updated_at = time();
            $model->userUpdated = getUser()->id;

            if($model->save()==true) {
                return json_encode($result);
            }else {
                $erros = $model->errors;
                $result = ["error" => $erros]+$result;
                return json_encode($result);
            }
        } catch (\Exception $e) {
            // $erros = $model->errors;
            $result = ["error" => 'Loi roi : '.$e->getMessage().' In File : '.$e->getFile().' In Line : '.$e->getLine()];
            return json_encode($result);
        }
        
    }
}
