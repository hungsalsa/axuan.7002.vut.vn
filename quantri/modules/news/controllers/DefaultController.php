<?php

namespace quantri\modules\news\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use quantri\modules\news\models\News;
use quantri\modules\news\models\Album;
use quantri\modules\news\models\Downloads;
use quantri\modules\news\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  quantri\modules\auth\models\AuthAssignment;
use quantri\models\Tags;
use yii\filters\AccessControl;
use quantri\modules\products\models\Products;
/**
 * DefaultController implements the CRUD actions for News model.
 */
class DefaultController extends Controller
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
                                // return true;
                                throw new \yii\web\HttpException(403, 'Bạn không có quyền vào đây');
                            }else {
                                return true;
                            }
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
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
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        // $categories = new Categories();
        $data['categories'] = Yii::$app->params['newsCategories']['all'];
        if (empty($data['categories'])) {
            $data['categories']=array();
        }
// dbg($data);
        $product = new Products();
        $data['products'] = $product->getAllProducts();
        
        $data['news'] = $model->getAllNews();
        $tag = new Tags();
        $data['tags'] = $tag->getAllTags('news');

        $tag = new Album();
        $data['albums'] = $tag->getAllAlbums();

        $tag = new Downloads();
        $data['downloads'] = $tag->getAllDownloads();

        $model->status= true;
        $model->created_at = $model->updated_at=time();
        $model->userCreated = $model->userUpdated = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['News']['images']!='') {
                $model->images = str_replace(Yii::$app->request->hostInfo,'',$post['News']['images']);
            }
            if ($post['News']['sort'] =='') {
                $model->sort = 0;
            }
            if ($post['News']['status'] =='') {
                $model->status = 0;
            }
            // if ($post['News']['hot'] =='') {
            //     $model->hot = 0;
            // }
            if ($post['News']['related_products']!='') {
                $model->related_products = json_encode($post['News']['related_products']);
            }
            if ($post['News']['related_news']!='') {
                $model->related_news = json_encode($post['News']['related_news']);
            }
            if ($post['News']['tags']!='') {
                $model->tags = json_encode($post['News']['tags']);
            }

            if ($post['News']['related_albums'] !='') {
                $model->related_albums = json_encode($post['News']['related_albums']);
            }

            if ($post['News']['related_downloads'] !='') {
                $model->related_downloads = json_encode($post['News']['related_downloads']);
            }
            
            if($model->save()){
                /*xử lý tag*/
                if ($model->tags !='' && is_array(json_decode($model->tags))) {
                    $newTags = json_decode($model->tags);
                    foreach ($newTags as $tags) {
                        $tag = new Tags();
                        $tag->type ='news';
                        $tags = trim($tags);
                        $tag->value = $tags;
                        if (substr_count($tags," ") == 0) {
                            $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                        } else {
                            $tag->slugTag = $this->Slug_url($tags);
                        }
                        $tag->link=$model->id;
                        $tag->save();
                    }
                }
                /*xử lý tag*/
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $data['categories'] = Yii::$app->params['newsCategories']['all'];
        if (empty($data['categories'])) {
            $data['categories']=array();
        }
// dbg($data);
        $product = new Products();
        $data['products'] = $product->getAllProducts();
        
        $data['news'] = $model->getAllNews();
        if(isset($data['news'][$id])){
            unset($data['news'][$id]);
        }

        $tag = new Tags();
        $data['tags'] = $tag->getAllTags('news');

        $tag = new Downloads();
        $data['downloads'] = $tag->getAllDownloads();

        $tag = new Album();
        $data['albums'] = $tag->getAllAlbums();


        if ($model->tags != '') {
            $model->tags = json_decode($model->tags);
        }
        if ($model->related_products !='') {
            $model->related_products = json_decode($model->related_products);
        }
        if ($model->related_news !='') {
            $model->related_news = json_decode($model->related_news);
        }
        if ($model->related_albums !='') {
            $model->related_albums = json_decode($model->related_albums);
        }

        if ($model->related_downloads !='') {
            $model->related_downloads = json_decode($model->related_downloads);
        }
        $model->updated_at=time();
        $model->userUpdated = Yii::$app->user->id;

        if ($model->load($post = Yii::$app->request->post()) ) {
            if ($post['News']['images']!='') {
                $model->images = str_replace(Yii::$app->request->hostInfo,'',$post['News']['images']);
            }
            if ($post['News']['sort']=='') {
                $model->sort = 0;
            }
            
            if ($post['News']['status'] =='') {
                $model->status = 0;
            }
            if ($post['News']['related_albums'] !='') {
                $model->related_albums = json_encode($post['News']['related_albums']);
            }

            if ($post['News']['related_downloads'] !='') {
                $model->related_downloads = json_encode($post['News']['related_downloads']);
            }

            // if ($post['News']['hot']=='') {
            //     $model->hot = 0;
            // }

            if ($post['News']['related_products']!='') {
                $model->related_products = json_encode($post['News']['related_products']);
            }
            if ($post['News']['related_news']!='') {
                $model->related_news = json_encode($post['News']['related_news']);
            }
            if ($post['News']['tags']!='') {
                $model->tags = json_encode($post['News']['tags']);
            }
            
            if($model->save()){
                /*xử lý tag*/

                /*if ($model->tags !='') {
                    $newTags = json_decode($model->tags);
                    foreach ($newTags as $tags) {
                        $tag = new Tags();
                        $tag->type ='news';
                        $tags = trim($tags);
                        $tag->value = $tags;
                        if (substr_count($tags," ") == 0) {
                            $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                        } else {
                            $tag->slugTag = $this->Slug_url($tags);
                        }
                        $tag->link=$model->id;
                        $tag->save();
                    }
                }*/

                /*XỬ LÝ TAG SẢN PHẨM:START*/
                $dataTags = json_decode($model->tags);
                $tag = new Tags();
                $dataOld = $tag->getAllTagsBytype('news',$model->id);

                if($dataTags && !empty($dataTags)){
            	/*nếu tin có tag*/
                    // echo 'tag cũ';
                    if ($dataOld) {
	                    $arrayOld = ArrayHelper::map($dataOld,'id','value');
                    	/*danh sách tag mới thêm vào*/
	                    $newTags = array_diff($dataTags,$arrayOld);
	                    if(!empty($newTags)){
                            foreach ($newTags as $tags) {
                                $tag = new Tags();
                                $tag->type ='news';
                                $tags = trim($tags);
                                $tag->value = $tags;
                                $tag->name = $this->convert_name($tags);
                                if (substr_count($tags," ")==0) {
                                    $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                                } else {
                                    $tag->slugTag = $this->Slug_url($tags);
                                }
                                $tag->link=$model->id;
                                $tag->save();
                            }
                        }

                        /*danh sách tag cũ xóa đi*/
                        $deleteTags = array_diff($arrayOld,$dataTags);
                        if(!empty($deleteTags)){
                            foreach ($deleteTags as $keytg => $tags) {
                                $dataOld[$keytg]->delete();
                            }
                        }
                        // echo 'cai cu';pr($arrayOld);
// echo 'them vao';
// pr($newTags);
// echo 'xoadi';
// dbg($deleteTags);
                    	
                    }else {
						foreach ($dataTags as $tags) {
                            $tag = new Tags();
                            $tag->type ='news';
                            $tags = trim($tags);
                            $tag->value = $tags;
                            $tag->name = $this->convert_name($tags);
                            if (substr_count($tags," ")==0) {
                                $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                            } else {
                                $tag->slugTag = $this->Slug_url($tags);
                            }
                            $tag->link=$model->id;
                            
                            $tag->save();
                        
                        }
                    	
                    }
                    echo 'cai cu';
// dbg($dataOld);

                }else {
                    /*nếu sp ko có tag*/
                    if($dataOld){
                        foreach ($dataOld as $tag) {
                            $tag->delete();
                        }
                    }
                }
                        // dbg($dataOld);
                        /*XỬ LÝ TAG SẢN PHẨM:END*/


                
                /*xử lý tag*/
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'data' => $data,
        ]);
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
            if ($field == 'active' || $field == 'status'|| $field == 'formshow') {
                $postValue = 'Kích hoạt';
            }
            else {
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
        $attribute = $model->attributeLabels();
        $message =' Bạn đã '.$postValue.' '.$attribute[$field];
// pr($model->$field);
// dbg($attribute[$field]);

        $result = [
            'id' => $id,
            'value_post' => $model->$field,
            'name' => $model->name,
            'message' => $message,
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
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tagsall = $model->alltags;
        // dbg($tagsall);
        if($model->delete()){
        	if($tagsall){
                foreach ($tagsall as $tag) {
                    $tag->delete();
                }
            }
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function Slug_url($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        $str = strtolower($str);
        return $str;
    }

    private function convert_name($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", ' ', $str);
        $str = preg_replace("/(\/)/", ' ', $str);
        $str = strtolower(preg_replace("/( )/", ' ', $str));
        return $str;
    }
}
