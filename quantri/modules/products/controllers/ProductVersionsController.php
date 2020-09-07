<?php

namespace quantri\modules\products\controllers;

use Yii;
use quantri\modules\products\models\ProductVersions;
use quantri\modules\products\models\ProductVersionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductVersionsController implements the CRUD actions for ProductVersions model.
 */
class ProductVersionsController extends Controller
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
                    // 'addnew' => ['POST'],
                ],
            ],
        ];
    }
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all ProductVersions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductVersionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductVersions model.
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
     * Creates a new ProductVersions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductVersions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /*HÀM THÊM MỚI VÀ CẬP NHẬT PHIÊN BẢN:::START*/
    public function actionAddnew()
    {
        $get = Yii::$app->request->get();
        if ($get['action']=='update') {
            $model = $this->findModel($get['id']);
        }
        if ($get['action']=='') {
            $model = new ProductVersions();
            $model->pro_id = $get['pro_id'];
        }
        $product_id = $get['product'];

        // $date = new \DateTime($get['date']);
        // echo ;

        // $data['date'] = 
        if ($get['date']=='') {
            $model->date = '';
        } else {
            $model->date = Yii::$app->formatter->asDate($get['date'], 'Y-M-d');
        }
        // $data['date'] = $model->date = strtotime($date->format('Y-m-d 0:0:0'));
        // dbg($model->date);
        // $data['name'] = 
        $model->name = $get['name'];

        $model->price_1 = $get['price_1'];
        $data['price_1'] = number_format((int) $get['price_1'], 0, ',', '.');


        $model->price_sale_1 = $get['price_sale_1'];
        $data['price_sale_1'] = number_format((int) $get['price_sale_1'], 0, ',', '.');

        $model->price_2 = $get['price_2'];
        // $data['price_2'] = number_format((int) $get['price_2'], 0, ',', '.');

        $model->price_3 = $get['price_3'];
        // $data['price_3'] = number_format((int) $get['price_3'], 0, ',', '.');
        
        $model->status = $get['status'];
        // $data['status'] = ($get['status'] ==1 )? 'Kích hoạt':' Ẩn ';

        if($model->save()){
            $data['save'] = true;
            $model = ProductVersions::find()->where(['pro_id'=>$product_id])->orderBy(['date'=>SORT_ASC])->all();
            // ProductVersions::findAll(['pro_id'=>$product_id]);
                return $this->renderAjax('row_version',['model'=>$model]);
        }
        // $model->save();
        // $model = $this->findModel($get['id']);
        // return json_encode([$model->price_1,$model->price_sale_1]);
        // return json_encode($data);
        else {
            $errors = Yii\helpers\ArrayHelper::toArray($model->errors);
            return $this->renderAjax('row_version_errors',['errors'=>$errors]);
            $data['save'] = false;
        }
        
    }

    /*HÀM XÓA NHANH PHIÊN BẢN*/

    public function actionDeleteVersion($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $data['name'] = $model->name = $model->name;

            // $data['price'] = number_format((int) $model->price, 0, ',', '.');

            // $data['price_sale'] = number_format((int) $model->price_sale, 0, ',', '.');

            $data['status'] = ($model->status ==1 )? 'Kích hoạt':' Ẩn ';

            $data['message'] = 'Bạn đã xóa thành công phiên bản : '.$model->name;
            $model->delete();
            $data['successful'] = true;
        } else {
            $data['successful'] = false;
        }
        
        return json_encode($data);

        // return $this->redirect(['index']);
    }

    /**
     * hàm lấy thông tin khi click vào edit
     */
    public function actionInfoUpdate($id)
    {
        $model = $this->findModel($id);
        if($model){
        $data['date'] = $model->date;
        $data['name'] = $model->name;
        $data['price_1'] = $model->price_1;
        $data['price_sale_1'] = $model->price_sale_1;
        $data['price_2'] = $model->price_2;
        $data['price_3'] = $model->price_3;
        $data['status'] = $model->status;
        }else{
            $data = false;
        }
        return json_encode($data);
    }

    /**
     * HÀM LẤY THÔNG TIN KHI CLICK VÀO EDIT :END
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductVersions model.
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
     * Finds the ProductVersions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductVersions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductVersions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
