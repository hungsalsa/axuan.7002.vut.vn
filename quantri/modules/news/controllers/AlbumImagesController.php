<?php

namespace quantri\modules\news\controllers;

use Yii;
use quantri\modules\news\models\AlbumImages;
use quantri\modules\news\models\AlbumImagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlbumImagesController implements the CRUD actions for AlbumImages model.
 */
class AlbumImagesController extends Controller
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
        $searchModel = new AlbumImagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AlbumImages model.
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

    public function actionAddimage($count,$imageFile,$Imagetitle,$Imagedescriptions)
    {
        $data = ['count'=>$count,'imageFile'=>$imageFile,'Imagetitle'=>$Imagetitle,'Imagedescriptions'=>$Imagedescriptions];
        // return $data;
         return $this->renderAjax('addimage',['data'=>$data]);
    }
    public function actionCreate($album_id='',$name='')
    {
        $model = new AlbumImages();
        $model->status=true;
        
        if($album_id!=''){
            $model->album_id = $album_id;
        }
        if ($model->load($post =Yii::$app->request->post())) {
            
            if ($post['AlbumImages']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo,'',$post['AlbumImages']['image']);
            }
            if ($post['AlbumImages']['sort']!='') {
                $model->sort = 0;
            }

             $model->save();

            if($album_id!=''){
                return $this->redirect(['/news/album/view', 'id' => $album_id]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'name' => ($name =='') ? '': $name,
            'album_id' => ($album_id =='') ? '': $album_id,
        ]);
    }

    /**
     * Updates an existing AlbumImages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        //  if ($_GET['album_id']!=''){
        //     $model->album_id = $album_id;
        // }

        if ($model->load($post =Yii::$app->request->post())) {
            
            if ($post['AlbumImages']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo,'',$post['AlbumImages']['image']);
            }

            $model->save();

            if($album_id = Yii::$app->request->get('album_id')){
                return $this->redirect(['/news/album/view', 'id' => $album_id]);

            }


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    public function actionDelete($id,$album_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/news/album/view','id'=>$album_id]);
    }

    /**
     * Finds the AlbumImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AlbumImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlbumImages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
