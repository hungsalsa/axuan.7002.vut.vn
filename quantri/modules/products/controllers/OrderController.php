<?php

namespace quantri\modules\products\controllers;

use Yii;
use quantri\modules\products\models\Order;
use quantri\modules\products\models\ProductVersions;
use quantri\modules\products\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        // $model_version = new ProductVersions();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model_detail = $model->details;
// dbg($model_detail);
        if ($model->delete()) {
            foreach ($model_detail as $value) {
                $value->delete();
            }
        }

        return $this->redirect(['index']);
    }

    public function actionStatusChange($id)
    {
        $model = $this->findModel($id);
        // dbg($model);
        // if (Yii::$app->user->identity->getRoleName()=='author' && $model->userCreated != getUser()->id) {
        //     return json_encode(["postValue" => "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin"]);
        // }

        // $authAssis = new AuthAssignment();
        // // Lấy quyền của usẻ đăng nhập
        // $perrmission = $authAssis->PermissionUser($model->userCreated);
        // $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        // if ($perrmission_login !='admin' && $model->userCreated != getUser()->id ) {
        //     $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
        //     $return =  "Bài này do $result[$perrmission] : ".$model->userCreated->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn";
        //     return json_encode(["postValue" => $return]);
        // }

        if ($model->status==0) {
            $model->status = 1;
            $postValue = 'Đã xử lý';
        } else {
            $model->status = 0;
            $postValue = 'Chưa xử lý';
        }
        $result = [
            'id' => $id,
            'value_post' => $model->status,
            'name' => $model->khachhang->fullname,
            'field' => 'status',
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
    }
    /*protected function findModel($id)
    {
        $model = Order::findOne($id)
        ->joinWith(['khachhang' => function (ActiveQuery $query) {
            return $query
                ->andWhere(['=', 'meta_data.published_state', 1]);
        }]);
            dbg($model->khachhang);
        if ( $model!== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            // dbg($model);
            // dbg($model->khachhang);
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
