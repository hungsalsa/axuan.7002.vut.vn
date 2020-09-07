<?php

namespace quantri\modules\setting\controllers;

use Yii;
use quantri\modules\setting\models\SettingCategory;
use quantri\modules\quantri\models\Productcategory;
use quantri\modules\setting\models\SettingCategorySearch;
use quantri\modules\quantri\models\SeoUrl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Exception;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * SettingcategoryController implements the CRUD actions for SettingCategory model.
 */
class SettingcategoryController extends Controller
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
        ];
    }

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all SettingCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SettingCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SettingCategory model.
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
     * Creates a new SettingCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SettingCategory();

        $seo = new SeoUrl();

        $dataSetCate = $model->getParentSetCategory();
        if(empty($dataSetCate)){
            $dataSetCate = array();
        }

        $catProduct = new Productcategory();
        $dataLinkCat = $catProduct->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        // echo '<pre>';print_r($dataLinkCat);die;

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            
            if ($post['SettingCategory']['parent_id']=='') {
                $model->parent_id = 0;
            }

            $query = 'product_cate='.$post['SettingCategory']['link_cate'];
            $slug = $seo->getSlugSeo($query);
            $model->slug = $slug;

            if($model->save()){
                unset($query,$post,$query);
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'seo' => $seo,
            'dataSetCate' => $dataSetCate,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing SettingCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        $seo = new SeoUrl();


        $dataSetCate = $model->getParentSetCategory();

        $catProduct = new Productcategory();
        $dataLinkCat = $catProduct->getCategoryParent();
        
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        $model->updated_at = time();
        $model->user_add = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        
        if ($model->load($post = Yii::$app->request->post())) {

            // Sét parent_id = 0 neews ko chọn
            if ($post['SettingCategory']['parent_id'] =='') {
                $model->parent_id = 0;
            }

            $query = 'product_cate='.$post['SettingCategory']['link_cate'];
            $slug = $seo->getSlugSeo($query);
            $model->slug = $slug;

// echo '<pre>';print_r($post);
// die;
            if($model->save()){
                unset($query,$post,$query);
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'seo' => $seo,
            'dataSetCate' => $dataSetCate,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing SettingCategory model.
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
     * Finds the SettingCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelSeo($id)
    {
        if (($model = SeoUrl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
