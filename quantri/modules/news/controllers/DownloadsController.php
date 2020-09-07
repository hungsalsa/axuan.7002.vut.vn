<?php

namespace quantri\modules\news\controllers;

use Yii;
use quantri\modules\news\models\Downloads;
use quantri\modules\news\models\Categories;
use quantri\modules\news\models\DownloadsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DownloadsController implements the CRUD actions for Downloads model.
 */
class DownloadsController extends Controller
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
        $this->layout = 'hoz_downloads';
        return parent::beforeAction($action); 
    }

    /**
     * Lists all Downloads models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DownloadsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Downloads model.
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
     * Creates a new Downloads model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Downloads();
        $cate = new Categories();
        $all = isset(Yii::$app->params['newsCategories']['all'])? Yii::$app->params['newsCategories']['all'] : [];
        $idcate =  $cate->getAllChildId(7);
        $idcate = array_flip($idcate);
        $data['newsCategories'] = array_intersect_key($all,$idcate);
        // dbg($data);
        $model->status=true;
        $model->created_at= $model->updated_at=time();
        $model->userCreated = $model->userUpdated = Yii::$app->user->id;
        if ($model->load($post = Yii::$app->request->post()) ) {
            // $model->link = $post['Downloads']['slug'];
            // $seo->slug = $post['Downloads']['slug'];
            $model->link = str_replace(Yii::$app->request->hostInfo, '', $post['Downloads']['link']); 

            if ($post['Downloads']['status'] =='') {
                $model->status = 0;
            }
            if ($post['Downloads']['cate_id'] =='') {
                $model->cate_id = 7;
            }
            if ($post['Downloads']['sort'] =='') {
                $model->sort = 0;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing Downloads model.
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
        
        $cate = new Categories();
        $all = isset(Yii::$app->params['newsCategories']['all'])? Yii::$app->params['newsCategories']['all'] : [];
        $idcate =  $cate->getAllChildId(7);
        $idcate = array_flip($idcate);
        $data['newsCategories'] = array_intersect_key($all,$idcate);

// dbg($data['newsCategories']);
        if ($model->load($post = Yii::$app->request->post()) ) {

            $model->link = str_replace(Yii::$app->request->hostInfo, '', $post['Downloads']['link']); 

            if ($post['Downloads']['status'] =='') {
                $model->status = 0;
            }
            if ($post['Downloads']['cate_id'] =='') {
                $model->cate_id = 7;
            }
            if ($post['Downloads']['sort'] =='') {
                $model->sort = 0;
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Deletes an existing Downloads model.
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
     * Finds the Downloads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Downloads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Downloads::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}