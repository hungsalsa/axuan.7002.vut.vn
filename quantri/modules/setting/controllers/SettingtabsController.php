<?php

namespace quantri\modules\setting\controllers;

use Yii;
use quantri\modules\setting\models\SettingTabs;
use quantri\modules\setting\models\SettingTabsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use quantri\modules\quantri\models\Productcategory;
use yii\filters\AccessControl;
use  quantri\modules\auth\models\AuthAssignment;

class SettingtabsController extends Controller
{
    /**
     * @inheritdoc
     */
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
        die('LAM LAI');
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    public function actionStatuschange($id)
    {
        $model = Menus::findOne($id);

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

        if ($model->status==0) {
            $model->status = 1;
            $postValue = 'Kích hoạt';
        } else {
            $model->status = 0;
            $postValue = ' Ẩn ';
        }
        $result = [
            'id' => $id,
            'value_post' => $model->status,
            'name' => $model->name,
            'field' => 'status',
            "postValue" => $postValue
        ];

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
        $model = Menus::findOne($id);


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
        

        $result = [
            'id' => $id,
            'value_post' => $value_post,
            'name' => $model->$field,
            'field' => $field,
        ];
        $result = array_merge($result,["postValue" => $value_post]);
        if ($field == 'parent_id') {
            $menu = new Menus();
            $dataMenus = $menu->getMenuParent();
            $dataMenus = array_merge([0=>' Root '],$dataMenus);
            // $value_post = $dataMenus[$value_post];
            $result = array_merge($result,["postValue" => $dataMenus[$model->$field]]);
        }
        // if ($field=='status'){
        //     if ($model->status==0) {
        //         $model->status=1;
        //         $value_post = 1;
        //         $postValue = "Active";
        //     } else {
        //         $model->status=0;
        //         $value_post = 0;
        //         $postValue = "Hidden";
        //     }
        // $result = array_merge($result,["postValue" => $postValue]);
        // }
// return json_encode($result);

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
    public function actionIndex()
    {
        $searchModel = new SettingTabsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SettingTabs model.
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
     * Creates a new SettingTabs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SettingTabs();
        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->userUpdated = $model->userUpdated = Yii::$app->user->id;;

        $catProduct = new Productcategory();
        $dataLinkCat = $catProduct->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        if ($model->load($post = Yii::$app->request->post())) {
// dbg($post);idCate
            $data = Productcategory::findOne($post['SettingTabs']['link_cate']);
            if ($post['SettingTabs']['name'] =='') {
                $model->name = $data->cateName;
            }
            $child = $catProduct->getChildCate($post['SettingTabs']['link_cate']);
            if(!empty($child)){
                $model->child_cate = json_encode($child);
            }else {
                $model->child_cate='';
            }
            $model->slug = $data->slug;
            $model->title = $data->title;
            // dbg($data);
             $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing SettingTabs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;;

        $catProduct = new Productcategory();
        $dataLinkCat = $catProduct->getCategoryParent();
        if(empty($dataLinkCat)){
            $dataLinkCat = array();
        }

        if ($model->load($post = Yii::$app->request->post())) {
// $idChild = $catProduct->getChildCate($post['SettingTabs']['link_cate']);
            $data = Productcategory::findOne($post['SettingTabs']['link_cate']);
            if ($post['SettingTabs']['name'] =='') {
                $model->name = $data->cateName;
            }
            $child = $catProduct->getChildCate($post['SettingTabs']['link_cate']);
            // pr($child);
            // dbg($post);
            if(!empty($child)){
                $model->child_cate = json_encode($child);
            }else {
                $model->child_cate='';
            }
            $model->slug = $data->slug;
            $model->title = $data->title;
            // dbg($data);
             $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing SettingTabs model.
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
     * Finds the SettingTabs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SettingTabs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SettingTabs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
