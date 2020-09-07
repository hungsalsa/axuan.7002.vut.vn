<?php

namespace quantri\modules\setting\controllers;

use Yii;
use yii\helpers\Url;
use quantri\modules\setting\models\Banner;
use quantri\models\CacheWebsite;
use quantri\modules\setting\models\BannerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use  quantri\modules\auth\models\AuthAssignment;
use yii\filters\AccessControl;
/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends Controller
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
    public function actionStatuschange($id)
    {
        $model = Banner::findOne($id);

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
        $model = Banner::findOne($id);


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
        $searchModel = new BannerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['order' => SORT_ASC,'created_at' => SORT_DESC,'updated_at' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
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
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        $model->status = true;
        // 'created_at', 'updated_at', 'userCreated', 'userUpdated'

        $model->created_at = $model->updated_at = time();
        $model->userCreated = $model->userUpdated = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            $hostInfo =Yii::$app->request->hostInfo;
            $model->image = str_replace($hostInfo, "", $post['Banner']['image']);
            // echo '<pre>';print_r($post);die;
            if ($post['Banner']['url'] !='') {
                $model->url = str_replace($hostInfo,"",$post['Banner']['url']);
            }
            $cache = new CacheWebsite();
            $cache->updateCache('cache_website_banner');

            if($model->save()){
                Yii::$app->session->setFlash('messeage', "Bạn đã sửa banner $model->name thành công !");
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $this->layout = '@backend/views/layouts/edit';
        $model = $this->findModel($id);

        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;
// dbg(Yii::$app->request->hostInfo);
        
        if ($model->load($post = Yii::$app->request->post()) ) {
            $hostInfo =Yii::$app->request->hostInfo;
            $model->image = str_replace($hostInfo, "", $post['Banner']['image']);
            // echo '<pre>';print_r($post);die;
            if ($post['Banner']['url'] !='') {
                $model->url = str_replace($hostInfo,"",$post['Banner']['url']);
            }
            $cache = new CacheWebsite();
            $cache->updateCache('cache_website_banner');
            
            // if ($post['Banner']['type']==4) {
            //     $model->introduction = str_replace("</p>","",str_replace("<p>","",$post['Banner']['introduction']));
            // }

            if($model->save()){
                Yii::$app->session->setFlash('messeage', "Bạn đã sửa banner $model->name thành công !");
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Banner model.
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
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
