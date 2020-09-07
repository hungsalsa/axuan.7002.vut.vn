<?php

namespace quantri\modules\products\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use quantri\modules\products\models\Productcategory;
// use quantri\modules\quantri\models\SeoUrl;
use quantri\modules\products\models\ProductcategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use  quantri\modules\auth\models\AuthAssignment;
use yii\web\Response;
use yii\widgets\ActiveForm;
class ProductcategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
// 'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback'=> function ($rule ,$action)
                        {
                            $control = Yii::$app->controller->id;
                            $action = Yii::$app->controller->action->id;
                            $module = Yii::$app->controller->module->id;

                            $role = $module.'/'.$control.'/'.$action;
                            if (Yii::$app->user->can($role)) {
                                return true;
                            }else {
                                throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'quickchange' => ['post'],
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
        $searchModel = new ProductcategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];
        $dataCate = Yii::$app->params['productCategory']['all'];
        // dbg($dataCate);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataCate' => $dataCate,
        ]);
    }

    /**
     * Displays a single Productcategory model.
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

    public function actionStatuschange($id,$field)
    {
        $model = Productcategory::findOne(['idCate'=>$id]);

        if (Yii::$app->user->identity->getRoleName()=='author' && $model->userCreated != getUser()->id) {
            return json_encode(["postValue" => "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin"]);
        }

        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->userCreated);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->userCreated != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            $return =  "Bài này do $result[$perrmission] : ".$model->userCreated->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn";
            return json_encode(["postValue" => $return]);
        }
/*
        if ($model->$field==0) {
            $model->$field = 1;
            if ($field = 'active') {
                $postValue = 'Kích hoạt';
            }
            if ($field = 'home_page') {
                $postValue = ' Có ';
            }
        } else {
            $model->$field = 0;
            $postValue = ' Ẩn ';
            // if ($field = 'active') {
            // }
            // if ($field = 'home_page') {
            //     $postValue = ' Không ';
            // }
        }*/

        // if ($model->active==0) {
        //     $model->active = 1;
        //     $postValue = 'Kích hoạt';
        // } else {
        //     $model->active = 0;
        //     $postValue = ' Ẩn ';
        // }
        // $result = [
        //     'id' => $id,
        //     'value_post' => $model->$field,
        //     'name' => $model->cateName,
        //     'field' => $field,
        // ];

        if ($model->$field==0) {
            $model->$field = 1;
            if ($field == 'active') {
                $postValue = 'Kích hoạt';
            }
            if ($field == 'home_page') {
                $postValue = ' Có ';
            }
        } else {
            $model->$field = 0;
            $postValue = ' Ẩn ';
            // if ($field = 'status') {
            // }
            // if ($field = 'hot') {
            //     $postValue = ' Không ';
            // }
        }

        $result = [
            'id' => $id,
            'value_post' => $model->$field,
            'name' => $model->cateName,
            'field' => $field,
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
    public function actionQuickchange()
    {
        $post = Yii::$app->request->post();
        $id = $post['id'];
        $model = Productcategory::findOne(['idCate'=>$id]);


        if (Yii::$app->user->identity->getRoleName()=='author' && $model->userCreated != getUser()->id) {
            return json_encode(["postValue" => "Bài này không phải do bạn tạo, bạn không thể sửa \n Hãy liên hệ admin"]);
        }

        $authAssis = new AuthAssignment();
        // Lấy quyền của usẻ đăng nhập
        $perrmission = $authAssis->PermissionUser($model->userCreated);
        $perrmission_login = $authAssis->PermissionUser(getUser()->id);

        if ($perrmission_login !='admin' && $model->userCreated != getUser()->id ) {
            $result = ['admin'=>'Quản trị viên','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
            $return =  "Bài này do $result[$perrmission] : ".$model->userCreated->username." tạo, bạn chỉ có thể sửa bài của Cộng tác viên hoặc của chính bạn";
            return json_encode(["postValue" => $return]);
        }

        $field = $post['field'];
        $value_post = $post['value_post'];
        $model->$field = $value_post;
        

        if ($field=='active') {
            $result = [
                'id' => $id,
                'value_post' => $value_post,
                'name' => $model->$field,
                'field' => $field,
            ];

            if ($model->$field==0) {
                $model->$field = 1;
                $postValue = 'Active';
            } else {
                $model->$field = 0;
                $postValue = 'Hidden';
            }
            $result = [
                'id' => $id,
                'value_post' => $model->$field,
                'name' => $model->$field,
                'field' => $field,
            ];
            $result = array_merge($result,["postValue" => $postValue]);
            return json_encode($result);
            
        } else {
            $result = [
                'id' => $id,
                'value_post' => $value_post,
                'name' => $model->$field,
                'field' => $field,
            ];

            $result = array_merge($result,["postValue" => $value_post]);
        }

        $model->updated_at = time();
        $model->userUpdated = getUser()->id;

        if($model->save()==true) {
            return json_encode($result);
        }else {
            $erros = $model->errors;
            $result = ["error" => $erros]+$result;
            // $result = ["error" => $erros];
            return json_encode($result);
        }
    }
    public function actionCreate()
    {
        $model = new Productcategory();

        $dataCat = $model->getCategoryParent();
        if(empty($dataCat)){
            $dataCat = array();
        }

        $model->active = true;
        $model->created_at = $model->updated_at = time();
        $model->userCreated = $model->userUpdated = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        
        if ($model->load($post = Yii::$app->request->post())) {
            // $model->slug = $post['SeoUrl']['slug'];
            // $seo->slug = $post['SeoUrl']['slug'];

            if ($post['Productcategory']['product_parent_id']=='') {
                $model->product_parent_id=0;
            }
            if ($post['Productcategory']['order']=='') {
                $model->order = 1;
            }
            if ($post['Productcategory']['home_page']=='') {
                $model->home_page = 0;
            }
            if ($post['Productcategory']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo,'',$post['Productcategory']['image']);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('messeage', "Bạn đã sửa $model->cateName thành công !");
                return $this->redirect(['index']);
            }

            // if($model->save()){

            //     $seo->query = 'product_cate='.$model->idCate;
            //     $seo->save();
            //     return $this->redirect(['index']);
            // }
        }

        return $this->render('create', [
            'model' => $model,
            'dataCat' => $dataCat,
        ]);
    }

    /**
     * Updates an existing Productcategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        
        $dataCat = $model->getCategoryParent();
        unset($dataCat[$id]);
        if(empty($dataCat)){
            $dataCat = array();
        }

        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;
        $product_parent_id = $model->product_parent_id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            // $model->slug = $post['SeoUrl']['slug'];
            // $seo->slug = $post['SeoUrl']['slug'];

            if ($post['Productcategory']['product_parent_id']=='') {
                $model->product_parent_id=0;
            }
            if ($post['Productcategory']['order']=='') {
                $model->order = 1;
            }
            if ($post['Productcategory']['home_page']=='') {
                $model->home_page = 0;
            }
            if ($post['Productcategory']['image']!='') {
                $model->image = str_replace(Yii::$app->request->hostInfo,'',$post['Productcategory']['image']);
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('messeage', "Bạn đã sửa $model->cateName thành công !");
                return $this->redirect(['index']);
            }
            
            // if($model->save()){
            //     // $seo->query = 'product_cate='.$model->idCate;
            //     if($seo->save())
            //     return $this->redirect(['view', 'id' => $model->idCate]);
            // }
        }

        return $this->render('update', [
            'model' => $model,
            // 'seo' => $seo,
            'dataCat' => $dataCat,
        ]);
    }

    /**
     * Deletes an existing Productcategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        $products = $model->products;
        if ($products) {
            $errors = ArrayHelper::map($products,'id','pro_name');
            $errors = implode("; ",$errors); 
            throw new HttpException(403,'Danh mục "'.$model->cateName. '" vẫn còn các sản phẩm : '.$errors);
        }

        $menus = $model->menus;
        if($menus){
            $errors = ArrayHelper::map($menus,'id','name');
            $errors = implode("; ",$errors); 
            throw new HttpException(403, 'Danh mục : "'.$model->cateName.'" vẫn còn menu liên kết là : '.$errors);
        }

        $modules = $model->modules;
        if($modules){
            $errors = ArrayHelper::map($modules,'id','name');
            $errors = implode("; ",$errors); 
            throw new HttpException(403, 'Danh mục : "'.$model->cateName.'" vẫn còn Module liên kết là : '.$errors);
        }

        
            // dbg($CheckAll);
        $CheckAll = $this->findModelAll($model->getAllChildIdByParent($id));
        if($CheckAll){
            $errors = ArrayHelper::map($CheckAll,'idCate','cateName');
            $errors = implode("; ",$errors); 
            throw new HttpException(403,'Danh mục "'.$model->cateName. '" vẫn còn danh mục con là : '.$errors);

            foreach ($CheckAll as $child) {
                $menus = $child->menus;
                if($menus){
                    $errors = ArrayHelper::map($menus,'id','name');
                    $errors = implode("; ",$errors); 
                    throw new HttpException(403, 'Danh mục : "'.$child->cateName.'" vẫn còn menu liên kết là : '.$errors);
                }

                $modules = $model->modules;
                if($modules){
                    $errors = ArrayHelper::map($modules,'id','name');
                    $errors = implode("; ",$errors); 
                    throw new HttpException(403, 'Danh mục : "'.$child->cateName.'" vẫn còn Module liên kết là : '.$errors);
                }

            }
        }
        

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Productcategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productcategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productcategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    private function findModelAll($idAray)
    {
        if (($model = Productcategory::findAll($idAray)) !== null) {
            return $model;
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelSeo($id)
    {
        if (($model = SeoUrl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
