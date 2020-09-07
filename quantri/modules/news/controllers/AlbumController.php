<?php

namespace quantri\modules\news\controllers;

use Yii;
use quantri\models\Model;
use quantri\modules\news\models\Album;
use quantri\modules\news\models\AlbumImages;
use quantri\modules\news\models\AlbumSearch;
use quantri\modules\news\models\AlbumImagesSearch;
use quantri\modules\news\models\Categories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumController implements the CRUD actions for Album model.
 */
class AlbumController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new AlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Album model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new AlbumImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['album_id'=>$id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Album model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Album();
        $data['all'] = Yii::$app->params['newsCategories']['all'];
        
        $cate = new Categories();
        $all = isset(Yii::$app->params['newsCategories']['all'])? Yii::$app->params['newsCategories']['all'] : [];
        $idcate =  $cate->getAllChildId(8);
        $idcate = array_flip($idcate);
        $data['allCate'] = array_intersect_key($all,$idcate);

        $model->status = true;
        $model->created_at = $model->updated_at = time();
        $model->userCreated = $model->userUpdated = Yii::$app->user->id;

        // $modelsImages = new AlbumImages();

        if ($model->load($post = Yii::$app->request->post())){
            // dbg($post);
            if ($post['Album']['sort'] =='') {
                $model->sort = 0;
            }
            if ($post['Album']['cate_id'] =='') {
                $model->cate_id = 8;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            // 'modelsImages' => $modelsImages,
            'data' => $data,
            // 'modelsImages' => (empty($modelsImages)) ? [new AlbumImages] : $modelsImages
        ]);
    }

    /**
     * Updates an existing Album model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;
        
        $cate = new Categories();
        $all = isset(Yii::$app->params['newsCategories']['all'])? Yii::$app->params['newsCategories']['all'] : [];
        $idcate =  $cate->getAllChildId(8);
        $idcate = array_flip($idcate);
        $data['allCate'] = array_intersect_key($all,$idcate);

        if ($model->load($post = Yii::$app->request->post())){
            // $model->slug = trim($postP['Products']['slug']);
            if ($post['Album']['sort'] =='') {
                $model->sort = 0;
            }
            if ($post['Album']['cate_id'] =='') {
                $model->cate_id = 8;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Deletes an existing Album model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $image_album = $model->image_album;
        // pr($model);
        // dbg($image_album);
        if($model->delete()){
            if($image_album){
                foreach ($image_album as $album) {
                    $album->delete();
                }
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Album model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Album the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Album::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
