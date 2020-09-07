<?php

namespace quantri\modules\setting\controllers;

use Yii;
use quantri\modules\setting\models\SettingModules;
use quantri\modules\setting\models\SettingModulesPages;
use quantri\modules\setting\models\SettingModulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use quantri\modules\products\models\Productcategory;
use quantri\modules\news\models\Categories;
use yii\filters\AccessControl;
use  quantri\modules\auth\models\AuthAssignment;
use yii\web\Response;
use yii\widgets\ActiveForm;
/**
 * SettingModulesController implements the CRUD actions for SettingModules model.
 */
class SettingModulesController extends Controller
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
                                return true;
                                // throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
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
        $searchModel = new SettingModulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['parent_id'=>0]);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];

        $category = new Productcategory();
        $dataCategory = $category->getCategoryParent();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataCategory' => $dataCategory,
        ]);
    }

    /**
     * Displays a single SettingModules model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dataId = $model->getChildrent($id);
// dbg($dataId);
        $searchModel = new SettingModulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->query->andFilterWhere(['IN','parent_id',$dataId]);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataModules' => $model->getModuleParent(),
        ]);
    }

    
    public function actionCategory($type)
    {
        $data['position'] = [
                'content_left'=>'Bên trái',
                'content_center'=>'Ở giữa',
                'content_right'=>'Bên phải',
            ];
        if ($type=='product') {
            $catProduct = new Productcategory();
            $data['LinkCat'] = Yii::$app->params['productCategory']['arrayCateName'];
            $data['hienthi'] = Yii::$app->params['hienthi']['products'];
            
        } elseif ($type=='news'){
            $catProduct = new Categories();
            // $data['LinkCat'] = $catProduct->getCategoryParent();
            $data['LinkCat'] = Yii::$app->params['newsCategories']['arrayCateName'];
            $data['hienthi'] = Yii::$app->params['hienthi']['news'];
            // $data['position'] = [
            //     'content_left'=>'content_left',
            //     'content_center'=>'content_center',
            //     'content_right'=>'content_right',
            // ];
        } elseif ($type=='form'){
            $catProduct = new Categories();
            $data['LinkCat'] = [];

            $page_show = Yii::$app->params['modules']['page_show'];
            unset($page_show['newsDetail']);
            $data['page_show'] = $page_show;
            

            // $data['position'] = [
            //     'content_left'=>'content_left',
            //     'content_center'=>'content_center',
            //     'content_right'=>'content_right',
            // ];
        }else {
            $data['LinkCat'] =[];
            $data['position'] = [
                'top_header'=>'Trên cùng',
                'under_slide_show'=>'Dưới slideshow',
                'content_left'=>'Bên trái',
                'content_center'=>'Ở giữa',
                'content_right'=>'Bên phải',
                'above_footer'=>'Trên footer',
            ];
        }
        return $this->renderAjax('type',['data'=>$data]);
    }


    public function actionPosition($id)
    {
        $model = new SettingModules();
        $data = $model->getPosition($id);
            
        return json_encode($data);
    }

    public function actionCreate()
    {
        $model = new SettingModules();

        $model->type_module = 'product';
        $model->status = true;
        // $model->cate_id = 0;
        $model->created_at = time();
        $model->updated_at = time();
        $model->userCreated = Yii::$app->user->id;
        $model->userUpdated = Yii::$app->user->id;

        $data['types'] = [
            'product'=>'Sản phẩm',
            'news'=>'Tin tức',
            'custom'=>'Tự tạo',
            'form'=>'Form đăng ký'
        ];
        $data['hienthi'] = Yii::$app->params['hienthi']['products'];

        $data['parent_id'] = $model->getModuleParent();
        // $data['parent_id'] = $model->getModuleParent();
        // dbg($data);
        $data['page_show'] = Yii::$app->params['modules']['page_show'];
        // unset($data['page_show']['newsDetail']);
        // dbg($data['page_show']);
        Yii::$app->params['modules']['position'] = [
                'content_left'=>'Bên trái',
                'content_center'=>'Ở giữa',
                'content_right'=>'Bên phải',
        ];
        $data['position'] = Yii::$app->params['modules']['position'];

        $data['LinkCat'] = [];
        $data['LinkCat'] = isset(Yii::$app->params['productCategory']['arrayCateName'])? Yii::$app->params['productCategory']['arrayCateName']: [];


        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load($post = Yii::$app->request->post())) {
            if ($post['SettingModules']['parent_id']=='') {
                $model->parent_id = 0;
            }
            if (isset($post['SettingModules']['cate_id'])) {
                if ($post['SettingModules']['cate_id'] =='') {
                // $model->status = 0;
                    $model->cate_id = 0;
                }
                
            } else {
                $model->cate_id = 0;
            }
            if ($post['SettingModules']['order']=='') {
                $model->order = 0;
            }
            
            // dbg($post);
            if ($post['SettingModules']['page_show'] !='') {
                $model->page_show = json_encode($post['SettingModules']['page_show']);
            }
            if ($post['SettingModules']['cate_id'] =='') {
                $model->status = 0;
            }

            if($model->save()){
                if($model->parent_id==0 && !empty($model_page_show = json_decode($model->page_show))){

                    foreach ($model_page_show as $new) {
                        $pageModule = new SettingModulesPages();
                        $pageModule->name = $new; 
                        $pageModule->module_id =  $model->id; 
                        $pageModule->status = 1;
                        $pageModule->save();
                    }
                }

                if ($model->parent_id==0) {
                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['view', 'id' => $model->parent_id]);
                }
            }
            else {
                dbg($model->save());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }

  
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if($model->page_show != ''){
            $model->page_show = json_decode($model->page_show);
        }

        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;

        $data['types'] = [
            'product'=>'Sản phẩm',
            'news'=>'Tin tức',
            'custom'=>'Tự tạo',
            'form'=>'Form đăng ký',
        ];
        
        
        $module = new SettingModules();
        // $data['parent_id'] = $module->getAllParentById($id);
        $data['parent_id'] = $model->getAllNameIdParent($id);
        if (empty($data['parent_id'])) {
            $data['parent_id'][0] ='Root';
        }
        $data['position'] = [
            'content_left'=>'Bên trái',
            'content_center'=>'Ở Giữa',
            'content_right'=>'Bên phải',
        ];
        
        $data['page_show'] = Yii::$app->params['modules']['page_show'];
        $data['hienthi'] = Yii::$app->params['hienthi']['news'];
        $data['LinkCat'] = [];
        switch ($model->type_module) {
            case 'product':
                {
                    $data['hienthi'] = Yii::$app->params['hienthi']['products'];
                    $catProduct = new Productcategory();
                    $data['LinkCat'] = Yii::$app->params['productCategory']['arrayCateName'];
                break;
                }
            case 'news':
                {
                    $catProduct = new Categories();
                    $data['LinkCat'] = Yii::$app->params['newsCategories']['arrayCateName'];
                break;
                }
            case 'form':
                {
                    unset($data['page_show']['newsDetail']);
                break;
                }
            case 'custom':
                {
                    $data['position'] = [
                        'top_header'=>'Trên cùng',
                        'under_slide_show'=>'Dưới slideshow',
                        'content_left'=>'Bên trái',
                        'content_center'=>'Ở giữa',
                        'content_right'=>'Bên phải',
                        'above_footer'=>'Trên footer',
                    ];
                break;
                }
            
            default:
                {
                    $data['LinkCat'] = [];
                    break;
                }
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if ($model->load($post = Yii::$app->request->post())) {
            if ($post['SettingModules']['page_show'] !='') {
                $model->page_show = json_encode($post['SettingModules']['page_show']);
            }
            
            if ($post['SettingModules']['cate_id'] =='') {
                $model->status = 0;
            }
            if ($post['SettingModules']['parent_id']==''|| $post['SettingModules']['parent_id']==0) {
                $model->parent_id = 0;
            }else {
                $model->positions = $model->getPosition($post['SettingModules']['parent_id']);
            }
            if ((!isset($post['SettingModules']['hienthi']) && $post['SettingModules']['hienthi']=='' && $post['SettingModules']['type_module']=='product') || (!isset($post['SettingModules']['type_module']) && $post['SettingModules']['hienthi']=='' && $post['SettingModules']['type_module']=='news') ) {
                $model->hienthi = 'list';
            }
            if ($post['SettingModules']['parent_id'] > 0) {
                $model->status = 1;
            }

            if($model->save()){
                // dbg($model);
                $module_page = json_decode($model->page_show);
                $allPageModules = $this->findPagesModel($id);
                
                $model_page_show = json_decode($model->page_show);
                $page_ready = $this->findPagesModel($id);

                if($model->parent_id==0){
                    $new_page = array_diff($model_page_show,$page_ready);
                // $new_page = array_diff($module_page,$allPageModules);
                    if(!empty($new_page)){

                        foreach ($new_page as $new) {
                            if ($pageModule = $this->findPagesOne($id,$new)) {
                                $pageModule->status = 1;
                                $pageModule->save();
                            } else {
                                $pageModule = new SettingModulesPages();
                                $pageModule->name = $new; 
                                $pageModule->module_id =  $id; 
                                $pageModule->status = 1;
                                $pageModule->save();
                            }
                        }
//                     echo 'them moi hoac thay status=1';
// pr($new_page);
                    }
                    $status_off = array_diff($page_ready,$model_page_show);
                    if(!empty($status_off)){

                        foreach ($status_off as $off) {
                        // dbg($off);
                            $pageModule = $this->findPagesOne($id,$off);
                        // $pageModule->name = $value; 
                        // $pageModule->module_id =  $id; 
                            $pageModule->status = 0;
                            $pageModule->save();
                        }
                    }
                }


                if ($model->parent_id ==0) {
                   return $this->redirect(['index']);
               } else {
                   return $this->redirect(['view','id'=>$model->parent_id]);
               }
                // return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
    }

   
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $childrents = $model->getChildrent($id);
        unset($childrents[$id]);
        $data = yii\helpers\ArrayHelper::map(SettingModules::findAll($childrents),'id','name');
        if ($data) {
            $errors = implode("; ",$data); 
                    throw new \yii\web\HttpException(403,'Module "'.$model->name. '" vẫn còn các module con : '.$errors);
        }

        // dbg($data);
        $model->delete();
       return $this->redirect(['index']);
    }
    public function actionStatuschange($id,$field)
    {
        $model = SettingModules::findOne($id);

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
        // if ($model->cate_id=='') {
        // }

        if ($model->$field==0) {
            $model->$field = 1;
            $postValue = 'Kích hoạt';
        } else {
            $model->$field = 0;
            $postValue = ' Ẩn ';
        }
        if(($model->type_module =='news' || $model->type_module =='product') && ($model->cate_id =='')){
            return json_encode(["postValue" => 'Module '.$model->name.' chưa liên kết danh mục nào, bạn ko thể '.$postValue.' nhanh !']);
        }
         if($model->page_show =='' && $model->parent_id == 0){
            return json_encode(["postValue" => 'Module '.$model->name.' chưa liên có trang hiển thị nào, bạn ko thể '.$postValue.' nhanh !']);
        }
        $result = [
            'id' => $id,
            'value_post' => $model->$field,
            'name' => $model->name,
            'field' => $field,
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
        $model = SettingModules::findOne($id);


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

        $category = new Productcategory();
        $dataCategory = $category->getCategoryParent();
        

        $result = [
            'id' => $id,
            'value_post' => $value_post,
            'name' => 'Tên',
            'field' => $model->$field,
        ];
        
        if ($field == 'cate_id') {
            $category = new Productcategory();
            $dataCategory = $category->getCategoryParent();
            $result = [
                'id' => $id,
                'value_post' => $value_post,
                'name' => $model->name,
                'field' => $dataCategory[$model->$field],
            ];
            $model->$field = $value_post;
            $value_post = $dataCategory[$value_post];
        }elseif ($field == 'order') {
            $result = [
                'id' => $id,
                'value_post' => 'Thay đổi thứ tự ',
                'name' => $model->name.' từ : '.$model->$field,
                'field' => $model->$field,
            ];
            $model->$field = $value_post;
        }
        else {
            $model->$field = trim($value_post);
        }
        // if ($field == 'order') {
            
        // }
        $result = array_merge($result,["postValue" => $value_post]);

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
    
    protected function findPagesModel($id)
    {
        return yii\helpers\ArrayHelper::map(SettingModulesPages::find()->select(['id','name'])->where(['module_id'=>$id,'status'=>1])->all(),'id','name');
        // dbg($model);
        // if (( $model!== null) {
            // return $model;
        // }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findPagesOne($id,$name)
    {
        if (($model = SettingModulesPages::findOne(['module_id'=>$id,'name'=>$name])) !== null) {
            return $model;
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel($id)
    {
        if (($model = SettingModules::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}