<?php

namespace quantri\modules\setting\controllers;

use Yii;
use quantri\modules\setting\models\Menus;
use quantri\modules\setting\models\MenusSearch;
use quantri\modules\products\models\Productcategory;
use quantri\modules\news\models\Categories;
// use quantri\modules\quantri\models\Pages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use  quantri\modules\auth\models\AuthAssignment;
use yii\web\Response;
use yii\widgets\ActiveForm;
class MenusController extends Controller
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
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    

    public function actionIndex()
    {
        $searchModel = new MenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // $dataProvider->query->andWhere(['m.parent_id'=>0]);

        // $results = $dataProvider->joinWith(['parent parent']);
        $dataProvider->query->andFilterWhere(['m.parent_id'=>0]);
        // $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];

        $data = new Menus();
        // $dataparent = $data->getMenuById();

        /*$menu = Menus::findAll(['status'=>1]);
        foreach ($menu as $value) {
            if ($value['parent_id']!=0) {
                $value->parent_name = $dataparent[$value['parent_id']];
                $value->save();
            }else {
                $value->parent_name = 'Root';
                $value->save();
            }
        }*/
        // pr($menu);
        // $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];
// dbg($results);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataMenu' => $data->getMenuById(),
        ]);
    }

    /**
     * Displays a single Menus model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $menu = new Menus();
        $dataMenus = $menu->getIdMenuChild($id);
            // dbg($dataMenus);

        $searchModel = new MenusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['IN','m.parent_id',$dataMenus]);
        //     dbg($dataMenus[5]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            'dataMenu' => $menu->getMenuById()
        ]);
    }

    /**
     * Creates a new Menus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Menus();
// dbg('chinh sua duong dan theo san pham hay bai viet');
        $dataMenus = $model->getMenuChildrents();

        $menuType = array(
            1 => 'Sản phẩm',
            2 => 'Bài viết',
            3 => 'Downloads',
            4 => 'Tự tạo',
            5 => 'Albums',
        );
        $dataLinkCat = array();

        $model->status = true;
        $model->created_at = time();
        $model->updated_at = time();
        $model->userCreated = Yii::$app->user->id;
        $model->userUpdated = Yii::$app->user->id;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load($post = Yii::$app->request->post()) ) {
            $model->name = ucfirst($post['Menus']['name']);

            if ($post['Menus']['parent_id'] == '') {
                $model->parent_id = 0;
                $model->parent_name = 'Root';
            }else {
                $model->parent_name = $dataMenus[$post['Menus']['parent_id']];
            }
            if ($post['Menus']['order'] == '') {
                $model->order = 1;
            }
            
            if ($post['Menus']['image'] != '') {
                $model->image = str_replace(Yii::$app->request->hostInfo,'',$post['Menus']['image']);
            }
            if ($post['Menus']['type'] == 1) {
                $catProduct = new Productcategory();
                $model->slug = $catProduct->getSlugcate($post['Menus']['link_cate']);

            }
            if ($post['Menus']['type']==4) {
                $model->introduction = str_replace("</p>","",str_replace("<p>","",$post['Menus']['introduction']));
            }
            // echo $model->parent_id;
            // echo '<pre>';print_r($post);die;
            if($model->save()){
                Yii::$app->session->setFlash('messeage', "Bạn đã thêm menu $model->name thành công !");
                return $this->redirect(['index']);
            }else {
            dbg($model->errors);
                
            }
        }

        return $this->render('create', [
            'model' => $model,
            'dataMenus' => $dataMenus,
            'menuType' => $menuType,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Updates an existing Menus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // dbg( Yii::$app->params['productCategory']['all']);
        // dbg( Yii::$app->params['newsCategories']['all']);
        $model = $this->findModel($id);
        $menu = new Menus();
        $dataMenus = $menu->getMenuChildrents();
        if (!isset($dataMenus)) {
            $dataMenus =[];
        }else {
            unset($dataMenus[$id]);
        }

        $menuType = array(
            1 => 'Sản phẩm',
            2 => 'Bài viết',
            3 => 'Downloads',
            4 => 'Tự tạo',
            5 => 'Albums',
        );

        $catProduct = new Productcategory();
        $cate = new Categories();
        $all = isset(Yii::$app->params['newsCategories']['all'])? Yii::$app->params['newsCategories']['all'] : [];
        // dbg($all);

        switch ($model->type) {
            case 1:
                $dataLinkCat = isset(Yii::$app->params['productCategory']['all']) ? Yii::$app->params['productCategory']['all'] : [];
                break;
            case 2:
                $dataLinkCat = Yii::$app->params['newsCategories']['all'];
                break;
            case 3:
                {
                    // mục downloads
                    $idcate =  array_flip($cate->getAllChildId(7));
                    // $idcate = $idcate);
                    $dataLinkCat = array_intersect_key($all,$idcate);

                    break;
                }
            case 5:
                {
                    //mục album
                    $idcate =  array_flip($cate->getAllChildId(8));
                    
                    // $idcate = array_flip($idcate);
                    $dataLinkCat = array_intersect_key($all,$idcate);
                    break;
                }
            default:
                $dataLinkCat = [];
                break;
        }
       
        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['Menus']['parent_id'] == '') {
                $model->parent_id = 0;
                $model->parent_name = 'Root';
            }else {
                $model->parent_name = $dataMenus[$post['Menus']['parent_id']];
            }
            if ($post['Menus']['order'] == '') {
                $model->order = 1;
            }
            if ($post['Menus']['image'] != '') {
                $model->image = str_replace(Yii::$app->request->hostInfo,'',$post['Menus']['image']);
            }
            // if ($post['Menus']['type']==1) {
            //     $model->slug = ($catProduct->getSlugcate($post['Menus']['link_cate']))? $catProduct->getSlugcate($post['Menus']['link_cate']):'';
            // }
            // if ($post['Menus']['type']==2) {
            //     $model->slug = $cate->getCategoriesById($post['Menus']['link_cate']);
            // }
            if ($post['Menus']['type']==4) {
                $model->introduction = str_replace("</p>","",str_replace("<p>","",$post['Menus']['introduction']));
            }
            // pr($model);
            // dbg($post);
        
            if($model->save()){
                Yii::$app->session->setFlash('messeage', "Bạn đã sửa menu $model->name thành công !");
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'dataMenus' => $dataMenus,
            'menuType' => $menuType,
            'dataLinkCat' => $dataLinkCat,
        ]);
    }

    /**
     * Deletes an existing Menus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $childrents = $model->getIdMenuChild($id);
        unset($childrents[$id]);
        $data = yii\helpers\ArrayHelper::map(Menus::findAll($childrents),'id','name');
        
        if ($data) {
            $errors = implode("; ",$data); 
                    throw new \yii\web\HttpException(403,'Menu "'.$model->name. '" vẫn còn các menu con : '.$errors.' . Hãy xóa hết các menu con trước');
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = Menus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLists($id)
    {
        $all = Yii::$app->params['newsCategories']['all'];
        $model = new Categories();

        switch ($id) {
            case 1:
                $dataCategory = isset(Yii::$app->params['productCategory']['all']) ? Yii::$app->params['productCategory']['all'] : [];
                break;
            case 2:
                $dataCategory = isset(Yii::$app->params['newsCategories']['all']) ? Yii::$app->params['newsCategories']['all'] : [];
                unset($dataCategory[7],$dataCategory[8]);
                break;
            case 3:
                {
                    $idcate =  array_flip($model->getAllChildId(7));
                    // $idcate = array_flip($idcate);
                    $dataCategory = array_intersect_key($all,$idcate);
                    break;
                }
            case 5:
                {
                    //mục album
                    $idcate =  array_flip($model->getAllChildId(8));
                    // $idcate = array_flip($idcate);
                    $dataCategory = array_intersect_key($all,$idcate);
                    break;
                }

                
            // case 5:
            //     {
            //         $idcate =  array_flip($cate->getAllChildId(7));
            //         $dataCategory = array_intersect_key($all,$idcate);
            //         break;
            //     }
                    
            
            default:
                $dataCategory = [];
                break;
        }
        /*$dataCatPro = Yii::$app->params['productCategory']['all'];
        if(empty($dataCatPro)){
            $dataCatPro = array();
        }

        // $dataCatNew = $categories->getCategoryParent();
        $dataCatNew = Yii::$app->params['newsCategories']['all'];
        if(empty($dataCatNew)){
            $dataCatNew = array();
        }
        // dbg($dataCatNew);
        // if($id==3){*/
        


        echo '<option value="">-- Select a ... --</option>';
        foreach ($dataCategory as $key => $value) {
            echo '<option value="'.$key.'">'.$value.'</option>';
        }
        /*switch ($id) {
            case 1:{
                break;
            }
            case 2:{
                foreach ($dataCatNew as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            }
            case 3:{
                foreach ($dataDownloads as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            }
                
            
            default:{
                    // echo '<option value="'.$key.'">'.$value.'</option>';
            }
        }*/
        
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
        if ($field=='parent_id' && $value_post == null) {
            $value_post = 0;
        }
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
            $dataMenus = $menu->getMenuById();
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
}