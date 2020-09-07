<?php

namespace quantri\modules\news\controllers;

use Yii;
use quantri\modules\news\models\Categories;
use yii\web\HttpException;
use quantri\modules\news\models\CategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use  quantri\modules\auth\models\AuthAssignment;
/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule,$action)
                        {
                            $module = Yii::$app->controller->module->id;
                            $action = Yii::$app->controller->action->id;
                            $controller = Yii::$app->controller->id;
                            $route = "$module/$controller/$action";
                            $post = Yii::$app->request->post();
                            if (\Yii::$app->user->can($route)) {
                                return true;
                            }
                        }
                    ],
                    // [
                    //     'allow' => true,
                    //     'actions' => ['logout'],
                    //     'roles' => ['@'],
                    // ],
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
        $model = new Categories();
        $idcate = array_merge($model->getAllChildId(8),$model->getAllChildId(7));

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['NOT IN','c.id',$idcate]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDownloads()
    {
        $model = new Categories();
        $idcate = 7;
        $idcate =  $model->getAllChildId($idcate);
        // unset($idcate[0]);
// dbg($idcate);

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['IN','c.id', $idcate]);

        return $this->render('downloads', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAlbums()
    {
        $model = new Categories();
        $idcate = 8;
        $idcate =  $model->getAllChildId($idcate);
       // unset($idcate[0]);
// dbg($idcate);

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['IN','c.id', $idcate]);
        // $dataProvider->query->orWhere(['c.parent_id' => $idcate]);

        return $this->render('albums', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed downloads
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($parent_id = null,$title=null)
    {
        $model = new Categories();

        $data['newsCategories'] = Yii::$app->params['newsCategories']['all'];
        if ($data['newsCategories']) {
                if ($parent_id != null) {

                    $idcate =  $model->getAllChildId($parent_id);
                    
                    $idcate = array_flip($idcate);
                    $data['newsCategories'] = array_intersect_key($data['newsCategories'],$idcate);
                }else {
                    $idcate = array_merge($model->getAllChildId(7),$model->getAllChildId(8));
                    
                    $idcate = array_flip($idcate);
                    $data['newsCategories'] = array_diff_key($data['newsCategories'],$idcate);
                }
            
        }else {
            $data['newsCategories'] = [];
        }

        $model->status=true;
        $model->groupId=1;
        $model->created_at= $model->updated_at=time();
        $model->userCreated = $model->userUpdated = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {

            if ($post['Categories']['sort']=='') {
                $model->sort = 0;
            }
            if ($post['Categories']['parent_id'] =='') {
                $model->parent_id = 0;
            }

            if ($model->save()) {
                if ($parent_id == 7) {
                // $model->parent_id = $parent_id;
                    return $this->redirect(['downloads']);
                }elseif ($parent_id == 8) {
                    return $this->redirect(['albums']);
                } else {
                    return $this->redirect(['index']);
                }
                // return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'title' => isset($title)? $title :'tin tức',
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$parent_id = null,$title=null)
    {
        $model = $this->findModel($id);

        /*$seo = new SeoUrl();
        $idSeo = $seo->getSeoID($model->link);
        if ($idSeo) {
            $seo = $this->findModelSeo($idSeo);
        } else {
            $seo->slug = '';
        }*/

        /*$group = new Group();
        $dataGroups = ArrayHelper::map($group->getAllGroups(),'id','groupsName');
*/
        $data['newsCategories'] = Yii::$app->params['newsCategories']['all'];

        if ($parent_id != null) {

            $idcate =  $model->getAllChildId($parent_id);
            
            $idcate = array_flip($idcate);
            $data['newsCategories'] = array_intersect_key($data['newsCategories'],$idcate);
        }else {
            $idcate = array_merge($model->getAllChildId(7),$model->getAllChildId(8));
            
            $idcate = array_flip($idcate);
            $data['newsCategories'] = array_diff_key($data['newsCategories'],$idcate);
        }
        
        unset($data['newsCategories'][$id]);
        

        $model->updated_at=time();
        $model->userUpdated = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post())) {
           
            if ($post['Categories']['parent_id'] =='') {
                $model->parent_id = 0;
            }
            if ($post['Categories']['sort']=='') {
                $model->sort = 0;
            }
            if ($parent_id != null && $post['Categories']['parent_id']=='') {
                $model->parent_id = $parent_id;
            }

            if (in_array($id, [7,8])) {
                $model->parent_id = 0;
            }

            $model->save();
            if ($parent_id == 7) {
                // $model->parent_id = $parent_id;
                return $this->redirect(['downloads']);
            }elseif ($parent_id == 8) {
                return $this->redirect(['albums']);
            } else {
                return $this->redirect(['index']);
            }
            // }

            
        }

        return $this->render('update', [
            'model' => $model,
            'title' => $title,
            // 'dataGroups' => $dataGroups,
            'data' => $data,
        ]);
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(in_array($id,[7,8])){
            throw new HttpException(403,'Bạn không thể xóa danh mục này');
        }
        $model = $this->findModel($id);

        $news = $model->news;
        if (!empty($news)) {
            $errors = ArrayHelper::map($news,'id','name');
            $errors = implode("; ",$errors); 
            throw new HttpException(403,'Danh mục: "'.$model->cateName. '" vẫn còn các tin: '.$errors);
        }

        $menus = $model->menus;
        if($menus){
            $errors = ArrayHelper::map($menus,'id','name');
            $errors = implode("; ",$errors); 
            throw new HttpException(403, 'Danh mục: "'.$model->cateName.'" vẫn còn menu liên kết: '.$errors);
        }

        $modules = $model->modules;
        if($modules){
            $errors = ArrayHelper::map($modules,'id','name');
            $errors = implode("; ",$errors); 
            throw new HttpException(403, 'Danh mục: "'.$model->cateName.'" vẫn còn module liên kết: '.$errors);
        }

        
        $dataChilds = $this->findModelAll($model->getAllChildIdByParent($id));
        // dbg($dataChilds);
        if ($dataChilds) {
            $errors =  ArrayHelper::map($dataChilds,'id','cateName');
            $errors = implode("; ",$errors); 
            throw new HttpException(403,'Danh mục: "'.$model->cateName. '" vẫn còn các danh mục con: '.$errors);
            foreach ($dataChilds as $child) {
                $news = $child->news;
                if (!empty($news)) {
                    $errors = ArrayHelper::map($news,'id','name');
                    $errors = implode("; ",$errors); 
                    throw new HttpException(403,'Danh mục: "'.$child->cateName. '" vẫn còn các tin: '.$errors);
                }

                $menus = $child->menus;
                if($menus){
                    $errors = ArrayHelper::map($menus,'id','name');
                    $errors = implode("; ",$errors); 
                    throw new HttpException(403, 'Danh mục: "'.$child->cateName.'" vẫn còn menu liên kết: '.$errors);
                }

                $modules = $model->modules;
                if($modules){
                    $errors = ArrayHelper::map($modules,'id','name');
                    $errors = implode("; ",$errors); 
                    throw new HttpException(403, 'Danh mục: "'.$child->cateName.'" vẫn còn module liên kết: '.$errors);
                }
            }
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionStatuschange($id,$field)
    {
        $model = $this->findModel($id);

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

        if ($model->$field==0) {
            $model->$field = 1;
            if ($field == 'active' || $field == 'status') {
                $postValue = 'Kích hoạt';
            }
            if ($field == 'home_page') {
                $postValue = ' Có ';
            }
        } else {
            $model->$field = 0;
            $postValue = ' Ẩn ';
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
        // $model = Productcategory::findOne(['idCate'=>$id]);
        $model = $this->findModel($id);


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
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    private function findModelAll($idArray)
    {
        if (($model = Categories::findAll($idArray)) !== null) {
            return $model;
            
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function findUserModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}