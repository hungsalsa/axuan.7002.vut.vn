<?php

namespace quantri\modules\products\controllers;

use Yii;
use quantri\modules\products\models\ProductImages;
use quantri\modules\products\models\ProductImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
class AnhsanphamController extends Controller
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
                    // 'image' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductImages models.
     * @return mixed
     */
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    public function actionIndex()
    {
        $searchModel = new ProductImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductImages model.
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

    
    /*public function actionCreateNewImage()
    {
        $model = new ProductImages();

        $model->product_id = 1;
        $model->created_at = time();
        $model->updated_at = time();


        $model->save();
        return json_encode($model->errors);
    }*/
    public function actionUpdateNewImage($id)
    {
        $model = $this->findModel($id);
        
        $data['id'] = $id;
        $data['image'] = $model->image;
        $data['title'] = $model->title;
        $data['alt'] = $model->alt;
        $data['order'] = $model->order;
        
        // $model->save();
        // return $this->renderPartial('editImage',['data'=>$data]);
        return json_encode($data);
    }
    

    public function actionAddimages()
    {
        $post = Yii::$app->request->post();


        $model = new ProductImages();

        $model->product_id = $post['product_id'];
        $model->image = $post['image'];
        $model->seo_alt = $post['seo_alt'];
        $model->created_at = time();
        $model->updated_at = time();
        $row = '';
        $data='';
        if($model->save()){
        // $row = '<td><img style="max-height: 90px;" src="'.$post['image'].'"><label title="Xóa ảnh" class="removeimagelist icon-list-demo" id="'.$model->id.'"><i class="ti-trash"></i></label> </td>';
        $row = '<td class="waves-effect"><img style="max-height: 90px;" src="'.$post['image'].'"></td>';
        $data = $model;
        }
        // $model = new WhateverYourModel();

        



            return json_encode($row);
            
        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    public function actionCreate()
    {
        $post = Yii::$app->request->post();
        $model = new ProductImages();

        $model->product_id = 1;
        $model->created_at = time();
        $model->updated_at = time();


        // $model = new WhateverYourModel();

        



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Updates an existing ProductImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionImage()
    {
        $get = Yii::$app->request->get();

        if ($get['action']=='update') {
            $model = $this->findModel($get['idIma']);
            if ($model == null) {
                return 'anh san pham khong on tai';
            }
            $model->userUpdated = getUser()->id;
        }
        if ($get['action']=='') {
            $model = new ProductImages();
            $model->pro_id = $get['pro_id'];
            $model->created_at = time();
            $model->userCreated = getUser()->id;
        }

        $model->image = str_replace(Yii::$app->request->hostInfo,"",$get['image']);
        $model->title = $get['title'];
        $model->alt = $get['alt'];
        if ($get['order']=='') {
            $model->order = 0;
        }else {
            $model->order = $get['order'];
        }
        $model->status = true;
        $model->updated_at = time();
        if($model->save()){
            // $modelnew = new ProductImages();
            // $data = $modelnew->getAllImageBy($model->pro_id);
             $data[] = $model;
        }else {
            dbg($model->errors);
            $data['save'] = false;
        }

        $modelnew = new ProductImages();
        $data = $modelnew->getAllImageBy($get['pro_id']);
        return $this->renderPartial('newimage',['data'=>$data]);
    }
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

    
    public function actionRemoveImage($id)
    {
        // $id =Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $data['image']=$model->image;
        $data['title']=$model->title;
        $data['alt']=$model->alt;
        $data['order']=$model->order;
        $data['field']='image';
        if($model->delete()){
            $data['successful']= true;
        }else {
            $data['successful']= false;
        }
        return json_encode($data);
        // return $this->redirect(['index']);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductImages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
