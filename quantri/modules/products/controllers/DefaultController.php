<?php

namespace quantri\modules\products\controllers;

use Yii;
use quantri\models\Model;
use quantri\models\Tags;
use quantri\modules\products\models\Products;
use quantri\modules\products\models\ProductsSearch;
use quantri\modules\products\models\Productcategory;
use quantri\modules\products\models\ProductsType;
use quantri\modules\products\models\ProductVersions;
use quantri\modules\news\models\Album;
use quantri\modules\news\models\Downloads;
use quantri\modules\products\models\ProductProperties;
use quantri\modules\products\models\ProductImages;
use quantri\modules\products\models\ProductThuoctinh;
use quantri\modules\news\models\News;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response; // Add This line
use yii\widgets\ActiveForm; //Add This Line
use yii\filters\AccessControl;
use  quantri\modules\auth\models\AuthAssignment;
// use quantri\modules\quantri\models\related\ProductRelatedTypeInterdependent;
use kartik\select2\Select2;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use quantri\commands\SiteInfo;
use yii\helpers\ArrayHelper;

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
                    'quickchange' => ['post'],
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
    

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$data = Products::find()->where(['!=','tags',''])->all();
        // dbg($data);
        foreach ($data as $new) {
            $dataNew = json_decode($new->tags);
            foreach ($dataNew as $tags) {
                // dbg($dataNew);
                $tag = new Tags();
                $tag->type ='product';
                $tags = trim($tags);
                $tag->value = $tags;
                $tag->name = $this->convert_name($tags);
                if (substr_count($tags," ")==0) {
                    $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                } else {
                    $tag->slugTag = $this->Slug_url($tags);
                }
                $tag->link=$new->id;

                $tag->save();
            }

        }
*/
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['updated_at' => SORT_DESC,'order' => SORT_ASC,'created_at' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionAttribute()
    {
        $counter = Yii::$app->request->post('counter');
        $model = new ProductProperties();
        $data = $model->getProductProperties();

        $row = Select2::widget([
            'name' => 'color_2',
    // 'value' => ['red', 'green'], // initial value
            'data' => $data,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a color ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'maximumInputLength' => 10
            ],
        ]);
        return json_encode($row);
        // return $this->renderAjax('attribute',['counter'=>$counter,'data'=>$data]);
    }

    
    public function actionCreate()
    {
        $model = new Products();
        // $image_model = new ProductImages();
        // $model->scenario = 'create';

        $data['category'] = Yii::$app->params['productCategory']['all'];
        if(empty($data['category'])){
            $data['category'] = array();
        }

        // dbg($data);
        
        $tag = new Tags();
        $data['tags'] = $tag->getAllTags();

        $tag = new Album();
        $data['albums'] = $tag->getAllAlbums();

        $tag = new Downloads();
        $data['downloads'] = $tag->getAllDownloads();

        // $product = new ProductsType();
        // $data['productType'] = $product->getAllProductsType();
        // if(empty($dataType)){
        //     $dataType = array();
        // }

        // $product = new Suppliers();
        // $data['suppliers'] = $product->getAllSuppliers();
        $data['inventory'] = [0=>'Không quản lý kho hàng',1=>'Quản lý kho hàng'];

        $product = new News();
        $data['news'] = $product->getAllNews();

        $product = new ProductProperties();
        $data['productproperties'] = $product->getProductProperties();
        // dbg($data);

        $data['products'] = $model->getAllProducts();

        $model->status = true;
        $model->inventory = 0;
        $model->created_at = time();
        $model->updated_at = time();
        $model->userCreated = Yii::$app->user->id;
        $model->userUpdated = Yii::$app->user->id;

        
        $modelsProductThuoctinh = [new ProductThuoctinh];

        if ($model->load($postP = Yii::$app->request->post())){
                $model->pro_name_not = $this->convert_name(trim($model->pro_name));
            // $model->image = UploadedFile::getInstance($model, 'image');
            // $model->image = UploadedFile::getInstance($model, 'image');
            if ($postP['Products']['related_articles'] != '') {
                $model->related_articles = json_encode($postP['Products']['related_articles']);
            }
            
            if ($postP['Products']['related_products'] != '') {
                $model->related_products = json_encode($postP['Products']['related_products']);
            }

            if ($postP['Products']['related_albums'] !='') {
                $model->related_albums = json_encode($postP['Products']['related_albums']);
            }

            if ($postP['Products']['related_downloads'] !='') {
                $model->related_downloads = json_encode($postP['Products']['related_downloads']);
            }
            
            if ($postP['Products']['order'] == '') {
                $model->order = 0;
            }
            
            if ($postP['Products']['tags'] != '') {
                $dataTags = $postP['Products']['tags'];
                $model->tags = json_encode($dataTags);
            }
            // if ($postP['Products']['image'] != '') {
            //     $model->image = str_replace(Yii::$app->request->hostInfo."/","",$postP['Products']['image']);
            // }

            if ($postP['Products']['start_sale'] != '') {
                $model->start_sale = Yii::$app->formatter->asDate($postP['Products']['start_sale'], 'Y-M-dd');;
            }

            if ($postP['Products']['end_sale'] != '') {
                $model->end_sale = Yii::$app->formatter->asDate($postP['Products']['end_sale'], 'Y-M-dd');;
            }
            
            $model->slug = trim($postP['Products']['slug']);
            
            $modelsProductThuoctinh = Model::createMultiple(ProductThuoctinh::classname());
            Model::loadMultiple($modelsProductThuoctinh, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsProductThuoctinh),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductThuoctinh) && $valid;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        Yii::$app->session->setFlash('messeage', "Bạn đã thêm thành công sản phẩm: ".$model->pro_name.'. Hãy thêm 1 hoặc nhiều ảnh cho sản phẩm ở phía dưới phần MÔ TẢ NGẮN'); 
                        foreach ($modelsProductThuoctinh as $modelProductThuoctinh) {
                            $modelProductThuoctinh->product_id = $model->id;
                            if (! ($flag = $modelProductThuoctinh->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        /*xử lý tag*/
                        if (isset($dataTags) && !empty($dataTags)) {
                            // $newTags = json_decode($model->tags);
                            foreach ($dataTags as $tags) {
                                $tag = new Tags();
                                $tag->type ='product';
                                $tags = trim($tags);
                                $tag->value = $tags;
                                $tag->name = $this->convert_name($tags);
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

                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash('messeage', "Bạn đã thêm thành công sản phẩm: ".$model->pro_name.'. Hãy thêm 1 hoặc nhiều ảnh cho sản phẩm ở phía dưới phần MÔ TẢ NGẮN'); 
                        // return $this->redirect(['index']);
                        return $this->redirect(['update', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                
                }
            }
            /*else {
                foreach ($modelsProductThuoctinh as $value) {
                    // pr($valid);
                dbg($value->errors);
                }
                dbg($model->errors);
            }*/
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
            // 'image_model' => $image_model,
            'modelsProductThuoctinh' => (empty($modelsProductThuoctinh)) ? [new ProductThuoctinh] : $modelsProductThuoctinh
            // 'dataType' => $dataType,
            // 'dataManufac' => $dataManufac,
            // 'dataNews' => $dataNews,
            // 'dataProduct' => $dataProduct,
            // 'dataModel' => $dataModel,
        ]);
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


    public function actionUpdate($id)
    {
        // dbg(Yii::$app->request->hostInfo);
        $model = $this->findModel($id);
        // $image_model = new ProductImages();
        if ($model->related_articles != '') {
            $model->related_articles = json_decode($model->related_articles);
        }
        if ($model->related_products != '') {
            $model->related_products = json_decode($model->related_products);
        }

        if ($model->related_albums !='') {
            $model->related_albums = json_decode($model->related_albums);
        }

        if ($model->related_downloads !='') {
            $model->related_downloads = json_decode($model->related_downloads);
        }

        if ($model->tags != '') {
            $model->tags = json_decode($model->tags);
        }

        $listImages = $model->listimages;
        $productVersions = $model->versions;
        
        $data['category'] = Yii::$app->params['productCategory']['all'];
        if(empty($data['category'])){
            $data['category'] = array();
        }

        // $product = new Suppliers();
        // $data['suppliers'] = $product->getAllSuppliers();
        // $data['inventory'] = [0=>'Không quản lý kho hàng',1=>'Quản lý kho hàng'];
        
        $tag = new Tags();
        $data['tags'] = $tag->getAllTags();
        // dbg($data['tags']);
        $tag = new Album();
        $data['albums'] = $tag->getAllAlbums();

        $tag = new Downloads();
        $data['downloads'] = $tag->getAllDownloads();

        $product = new News();
        $data['news'] = $product->getAllNews();

        $product = new ProductProperties();
        $data['productproperties'] = $product->getProductProperties();
        
        $data['products'] = $model->getAllProducts();
        unset($data['products'][$id]);
        // dbg($data['products']);

        if ($model->start_sale !='') {
            $model->start_sale = Yii::$app->formatter->asDate($model->start_sale, 'dd-M-Y');
        }
        if ($model->end_sale !='') {
            $model->end_sale = Yii::$app->formatter->asDate($model->end_sale, 'd-M-Y');
        }
        $model->updated_at = time();
        $model->userUpdated = Yii::$app->user->id;
        
        // Kiem tra load ajax
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
            // Yii::$app->session->setFlash('messeage','aaaaaaaaaaa');
        }
        $modelsProductThuoctinh = $model->thuoctinh;
        
        if ($model->load($postP = Yii::$app->request->post())) {
            $model->pro_name_not = $this->convert_name(trim($model->pro_name));
            $model->slug = trim($postP['Products']['slug']);

            if ($postP['Products']['tags'] != '') {
                $dataTags  = $postP['Products']['tags'];
                $model->tags = json_encode($dataTags);
            }
            if ($postP['Products']['related_articles'] != '') {
                $model->related_articles = json_encode($postP['Products']['related_articles']);
            }
            
            if ($postP['Products']['related_products'] != '') {
                $model->related_products = json_encode($postP['Products']['related_products']);
            }

            if ($postP['Products']['related_albums'] !='') {
                $model->related_albums = json_encode($postP['Products']['related_albums']);
            }

            if ($postP['Products']['related_downloads'] !='') {
                $model->related_downloads = json_encode($postP['Products']['related_downloads']);
            }

            if ($postP['Products']['order'] == '') {
                $model->order = 0;
            }
            if ($postP['Products']['start_sale'] != '') {
                $model->start_sale = Yii::$app->formatter->asDate($postP['Products']['start_sale'], 'Y-M-dd');;
            }
            if ($postP['Products']['end_sale'] != '') {
                $model->end_sale = Yii::$app->formatter->asDate($postP['Products']['end_sale'], 'Y-M-dd');;
            }
            
            
            $oldIDs = ArrayHelper::map($modelsProductThuoctinh, 'id', 'id');
            $modelsProductThuoctinh = Model::createMultiple(ProductThuoctinh::classname(), $modelsProductThuoctinh);
            Model::loadMultiple($modelsProductThuoctinh, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsProductThuoctinh, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductThuoctinh) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            ProductThuoctinh::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsProductThuoctinh as $modelProductThuoctinh) {
                            $modelProductThuoctinh->product_id = $model->id;
                            if (! ($flag = $modelProductThuoctinh->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        /*XỬ LÝ TAG SẢN PHẨM:START*/
                        $tag = new Tags();
                        $dataOld = $tag->getAllTagsBytype('product',$model->id);

                        if(isset($dataTags) && !empty($dataTags)){
                            /*nếu sp có tag*/
                            // echo 'tag mới all';
                            // pr($dataTags);

                            // echo 'tag cũ';
                            $arrayOld = ArrayHelper::map($dataOld,'id','value');
                            // pr($arrayOld);

                            if ($arrayOld) {
                                /*danh sách tag mới thêm vào*/
                                $newTags = array_diff($dataTags,$arrayOld);
                                // echo 'tag newTags ';
                                // pr($newTags);
                                if(!empty($newTags)){
                                    foreach ($newTags as $tags) {
                                        $tag = new Tags();
                                        $tag->type ='product';
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
                                // echo 'tag deleteTags ';
                                // pr($deleteTags);

                            } else {
                                foreach ($dataTags as $tags) {
                                    $tag = new Tags();
                                    $tag->type ='product';
                                    $tags = trim($tags);
                                    $tag->value = $tags;
                                    $tag->name = $this->convert_name($tags);
                                    if (substr_count($tags," ")==0) {
                                        $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                                    } else {
                                        $tag->slugTag = $this->Slug_url($tags);
                                    }
                                    $tag->link=$model->id;
                                    // echo $tags.'=>';
                                    // echo (substr_count($tags," "));
                                    // echo '<br>';
                                    $tag->save();
                                }
                                // dbg($dataTags);
                            }
                            
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
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                        // return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
            'listImages' => $listImages,
            'productVersions' => $productVersions,
            'modelsProductThuoctinh' => (empty($modelsProductThuoctinh)) ? [new ProductThuoctinh] : $modelsProductThuoctinh
        ]);
    }

    public function getErrors($attribute = null)
    {
        if ($attribute === null) {
            return $this->_errors === null ? [] : $this->_errors;
        }
        return isset($this->_errors[$attribute]) ? $this->_errors[$attribute] : [];
    }

    //  private function createSlug($str) {

    //     $str = trim(mb_strtolower($str));
    //     $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    //     $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    //     $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    //     $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    //     $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    //     $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    //     $str = preg_replace('/(đ)/', 'd', $str);
    //     $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    //     $str = preg_replace('/([\s]+)/', '-', $str);
    //     return $str;

    // }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {        
        $post = Yii::$app->request->post();
        // dbg($post);
        $id = $post['id'];
        $model = $this->findModel($id);
        $versions = $model->versions;
        $listimages = $model->listimages;
        $thuoctinhs = $model->thuoctinh;

        $tagsall = $model->alltags;

        /*lấy danh sách khách đặt hàng*/
        $order = new \quantri\modules\products\models\Order();
        $customers = $order->getAllCustomerByPro($id);


        if ($customers && !isset($post['delete'])) {
            return $this->render('delete', ['model'=>$model,'customers'=>$customers]);
        }
        // dbg($customers);
        $pro_name = $model->pro_name;

        // dbg($pro_name);
        if($model->delete()){
            if ($customers && isset($post['delete'])&& $post['delete']==true) {
                foreach ($customers as $order) {
                    foreach ($order['details'] as $details) {
                        $details->pro_name = $pro_name;
                        $details->save();
                    // dbg($details);
                    }
                    
                }
            }

            if($versions){
                foreach ($versions as $version) {
                    $version->delete();
                }
            }
            if($listimages){
                foreach ($listimages as $images) {
                    $images->delete();
                }
            }
            if($thuoctinhs){
                foreach ($thuoctinhs as $thuoctinh) {
                    $thuoctinh->delete();
                }
            }
            if($tagsall){
                foreach ($tagsall as $tag) {
                    $tag->delete();
                }
            }
        }
        // $idSeo = $seo->getSeoID($model->slug);
        // if($idSeo){
        //     $this->findModelSeo($idSeo)->delete();
        // }
        return $this->redirect(['index']);
    }
    public function actionDouble($id)
    {        
        $model = $this->findModel($id);
        $listimages = $model->listimages;

        if($model){
            $model->id = null;
            $model->isNewRecord = true;
            $model->pro_name = $model->pro_name.' ' .time();
            $model->created_at = $model->created_at = time();
            $model->userCreated = $model->userUpdated = getUser()->id;

            $model->slug = $model->slug.'-' .time();
            $model->save();
            if ($listimages) {
                foreach ($listimages as $image) {
                    $image->idIma = null;
                    $image->pro_id = $model->id;
                    $image->isNewRecord = true;
                    $image->save();
                // dbg($image->errors);
                }
            }

            if ($model->tags !='') {
                $newTags = json_decode($model->tags);
                foreach ($newTags as $tags) {
                    $tag = new Tags();
                    $tag->type ='product';
                    $tags = trim($tags);
                    $tag->value = $tags;
                    if (substr_count($tags," ")==0) {
                        $tag->slugTag = $this->Slug_url($tags.' '.$tags);
                    } else {
                        $tag->slugTag = $this->Slug_url($tags);
                    }
                    $tag->link=$model->id;
                                    // echo $tags.'=>';
                                    // echo (substr_count($tags," "));
                                    // echo '<br>';
                    $tag->save();
                }
            }

            if($model->errors){
                dbg($model->errors);
            }
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelSeo($id)
    {
        if (($model = SeoUrl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTabsData() {
        $html = $this->renderPartial('tabContent');
        return Json::encode($html);
    }

    public function actionValidation() {
        $model = new Products();
       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    public function actionStatuschange($id,$field)
    {
        $model = Products::findOne($id);
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
            if ($field == 'status') {
                $postValue = 'Kích hoạt';
            }
            if ($field == 'hot') {
                $postValue = ' Có ';
            }
        } else {
            $model->$field = 0;
            if ($field == 'status') {
                $postValue = ' Ẩn ';
            }
            if ($field == 'hot') {
                $postValue = ' Không ';
            }
        }

        $result = [
            'id' => $id,
            'value_post' => $model->$field,
            'name' => $model->pro_name,
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
        $model = Products::findOne($id);


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
        $value_post = trim($post['value_post']);
        $result = [
            'id' => $id,
            'value_post' => $value_post,
            'name' => $model->pro_name,
            'field' => 'Thành',
            "postValue" => $value_post
        ];

        if ($field== 'price_sales' || $field== 'price') {
            $fields = 'đổi giá bán';
            $result = [
                'id' => $id,
                'value_post' => $value_post,
                'name' => $model->pro_name,
                'field' => $fields,
                "postValue" => Yii::$app->formatter->asDecimal($value_post,0)
            ];
        }

        if ($field== 'product_category_id') {

            $cate = new Productcategory();
            $dataCate = $cate->getCategoryParent();
            $result = [
                'id' => $id,
                'value_post' => $value_post,
                'name' => $model->pro_name,
                'field' => "sang danh mục",
                "postValue" => $dataCate[$value_post]
            ];
        }

        $model->$field = trim($value_post);

        $model->updated_at = time();
        $model->userUpdated = getUser()->id;

        if($model->save()===true) {
            return json_encode($result);
        }else {
            $erros = $model->errors;
            $result = ["error" => $erros[$field][0]]+$result;
            // $result = ["error" => $erros];
            return json_encode($result);
        }
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
}