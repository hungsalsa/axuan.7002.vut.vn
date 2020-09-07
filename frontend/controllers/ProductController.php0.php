<?php

namespace frontend\controllers;
use frontend\models\product\FProduct;
use frontend\models\product\FProductcategory;
use frontend\models\product\FProductThuoctinh;
use frontend\models\setting\FSettingModules;
use frontend\models\setting\FSettingModulesPages;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use Yii;
use yii\helpers\Url;
// use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class ProductController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    // 'index'  => ['GET'],
                    // 'view'   => ['GET'],
                    // 'create' => ['GET', 'POST'],
                    // 'update' => ['GET', 'PUT', 'POST'],
                    'filter' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }*/
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }
    

    public function actionFilter()
    {
           
        if($post = Yii::$app->request->post())
        {
            $idFilter = isset($post['model'])? $post['model'] : [];
            $slug = str_replace('/', '', $post['url']);

            $model = new FProductcategory();
            $category = $model->getCategoryProductForSeo($slug);
            $idCateArray = $model->getChildCateByslug($slug);

            if (empty($idFilter)) {
                $idProduct = [];
            } else {
                $model = new FProductThuoctinh();
                $idProduct = $model->getAllIdproduct($idFilter);
            }

            $model = new FProduct();
            $data = $model->getProductByFilter($idCateArray,$idProduct);

        // pr($slug);
        // pr($idProduct);
        // dbg($data);
            return $this->renderAjax('filterProduct',['data'=>$data,'category'=>$category]);
        }
    }

    public function actionIndex($slug,$page=1)
    {
        $this->layout = 'product';
        // dbg(Yii::$app->params['layout']);
        $modulePage = new FSettingModulesPages();
        $site = new FSettingModules();
        $module = $site->getAllSettingModules($modulePage->getModulePages('productList'));
        Yii::$app->params['settingModules'] = $module;

        $model = new FProductcategory();
        $category = $model->getCategoryProductForSeo($slug);
        if(!isset($category)){
            throw new NotFoundHttpException('Dữ liệu này đang cập nhật, xin vui lòng quay lại sau');
        }

        $idCateArray = $model->getChildCateByslug($slug);
        $product = new FProduct();
        $data = $product->getProductByCateList($model->getChildCateByslug($slug),16);

        // pr($idCateArray);
// dbg($data);
        $product = new FProductThuoctinh();
        $data['attribute'] = $product->getAllAttribute($idCateArray);
        // dbg($data['products'][0]->danhmuc->slug);
        
        if (count($data['products'])==1) {
            return $this->redirect(['product/view','slugCate'=>$data['products'][0]->danhmuc->slug,'slug'=>$data['products'][0]['slug']]);
            // $slugCate,$slug
        }
        // pr($data);

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $category['keyword']
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $category['description']
        ]);

        Yii::$app->view->registerMetaTag([
            'itemprop' => 'image',
            'content' => Url::home(true).ltrim($category['image'],"/")
        ]);


        Yii::$app->view->registerMetaTag([
            'property' => 'og:title',
            'content' => $category['title']
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:description',
            'content' => $category['description']
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:image',
            'content' => Url::home(true).ltrim($category['image'],"/")
        ]);

        $url = Yii::$app->request->getabsoluteUrl();
        Yii::$app->view->registerMetaTag([
            'property' => 'og:url',
            'itemprop'=> 'url',
            'content' => $url
        ]);

        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>Url::to(['product/index', 'slug' => $category['slug']],true)
        ]); 

        if ($post = Yii::$app->request->post('FCustomers')) {
            $session = Yii::$app->session;

            $session['khachhang'] =[
                    'fullname'=> html_entity_decode($post['fullname']),
                    'phone'=> html_entity_decode($post['phone']),
                    'email'=> html_entity_decode($post['email']),
                    'note'=> html_entity_decode($post['note']),
                    'url'=> html_entity_decode($url),
            ];

            if(isset($session['khachhang'])){
                $model_customer = new \frontend\models\FCustomers();
                $khachhang = $session['khachhang'];
                $khachhang['url'] = $url;

                $model_customer->id_link = 0;
                $model_customer->type = 'product';
                $model_customer->fullname = $khachhang['fullname'];
                $model_customer->phone = $khachhang['phone'];
                $model_customer->email = $khachhang['email'];
                $model_customer->note = $khachhang['note'];
                $model_customer->url = $url;
                $model_customer->created_at = $model_customer->updated_at = time();
                $khachhang['hostInfo'] = Yii::$app->request->hostInfo;

                if($model_customer->save()){

                    if($khachhang['email'] !=''){
                        $bodyEmail = $this->RenderBodyEmail($khachhang);
                        $emailCC =['nguyensonqang240@gmail.com'];

                        if($model_customer->actionSendEmail('Thông tin đặt hàng của Anh/Chị tại : '.$khachhang['hostInfo'],$khachhang['email'],$emailCC,$bodyEmail)){

                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                        }else {
                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']. ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');

                        }
                    }else {
                        Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                    }

                }
                $session->remove('khachhang');
            }
            return $this->redirect($url);
        }
        
        return $this->render('index',['category'=>$category,'data'=>$data]);
    }

    private function RenderBodyEmail($data)
    {
        return $this->renderAjax('email',['data'=>$data]);
    }

    public function actionView($slugCate,$slug)
    {
        $this->layout = 'product';
        $modulePage = new FSettingModulesPages();
        $site = new FSettingModules();
        $module = $site->getAllSettingModules($modulePage->getModulePages('productDetail'));
        Yii::$app->params['settingModules'] = $module;

        $model = new FProduct;
        $data = $model->getProductBySlug($slug,$slugCate);
        if(empty($data['product'])){
            throw new NotFoundHttpException('Trang này không tồn tại.'); 
        }

        $session = Yii::$app->session;
// dbg($data['product']);
        if(!$session->has('product_'.$data['product']->id)){
            $session->set('product_'.$data['product']->id, 'product_'.$data['product']->id);
            // dbg($session['product_'.$data['product']->id]);
            $data['product']->views += 1;
            $data['product']->save();
            // dbg($data['product']->errors);
        }

        // $data['product']->views += 1;
        // $data['product']->save();
        
        if ($data['product']['related_articles']!='') {
            $news = new \frontend\models\news\FNews();
            $data['news'] = $news->getAllNewsById(json_decode($data['product']['related_articles']),16,false);
        }
        
        if ($data['product']['related_downloads']!='') {
            $news = new \frontend\models\news\FDownloads();
            $data['related_downloads'] = $news->findAllModel(json_decode($data['product']['related_downloads']),16);
        }

        $model = new FProductcategory;
        $data['category'] = $model->getAllParent($data['product']['product_category_id']);
        // $producthot = $data->getProductRandon(5);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $data['product']['descriptions']
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $data['product']['keywords'],
        ]);

        Yii::$app->view->registerMetaTag([
            'property' => 'og:title',
            'content' => $data['product']['title']
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:description',
            'content' => $data['product']['descriptions']
        ]);
            
        Yii::$app->view->registerMetaTag([
            'property' => 'og:image',
            'content' =>isset($data['product']->imageOne)? Url::home(true).ltrim($data['product']->imageOne->image,"/"):''
        ]);

        $url = Yii::$app->request->getabsoluteUrl();
        Yii::$app->view->registerMetaTag([
            'property' => 'og:url',
            'itemprop'=> 'url',
            'content' => $url
        ]);

        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>Url::to(['product/view', 'slugCate'=>$slugCate, 'slug'=>$slug],true)
        ]);
        

        if ($post = Yii::$app->request->post('FCustomers')) {
            $url = Yii::$app->request->getabsoluteUrl();
            $session = Yii::$app->session;

            $session['khachhang'] =[
                    'fullname'=> html_entity_decode($post['fullname']),
                    'phone'=> html_entity_decode($post['phone']),
                    'email'=> html_entity_decode($post['email']),
                    'note'=> html_entity_decode($post['note']),
            ];

            if(isset($session['khachhang'])){
                $model_customer = new \frontend\models\FCustomers();
                $khachhang = $session['khachhang'];
                $khachhang['url'] = $url;

                $model_customer->id_link = 0;
                $model_customer->type = 'product';
                $model_customer->fullname = $khachhang['fullname'];
                $model_customer->phone = $khachhang['phone'];
                $model_customer->email = $khachhang['email'];
                $model_customer->note = $khachhang['note'];
                $model_customer->url = $url;
                $model_customer->created_at = $model_customer->updated_at = time();
                $khachhang['hostInfo'] = Yii::$app->request->hostInfo;

                if($model_customer->save()){
                    if($khachhang['email'] !=''){
                        $bodyEmail = $this->RenderBodyEmail($khachhang);
                        $emailCC =['nguyensonqang240@gmail.com'];

                        if($model_customer->actionSendEmail('Thông tin đặt hàng của Anh/Chị tại : '.$khachhang['hostInfo'],$khachhang['email'],$emailCC,$bodyEmail)){

                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                        }else {
                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']. ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');

                        }
                    }else {
                        Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$khachhang['fullname'].' đã đăng ký thông tin từ '.$khachhang['hostInfo']);
                    }

                }
                $session->remove('khachhang');
            }
            return $this->redirect($url);
        }
        return $this->render('view',['data'=>$data]);
    }

    public function actionHotproduct()
    {
        $model = new FProduct();

        $data = $model->getProductsHot(16);
        if(empty($data)){
            throw new NotFoundHttpException('Dữ liệu đang cập nhật, hoặc trang này không tồn tại.'); 
        }
        return $this->render('hotproduct',['data'=>$data]);
    }
    public function actionTags($slugTag)
    {
        $this->layout = 'product';
            
        $slugTag = trim($slugTag);
        // if ($slugTag!='') {


        $model = new \frontend\models\FTags();

        $taginfo = $model->getInfoTags($slugTag);
        // dbg($taginfo);
        if(empty($taginfo)){
            throw new NotFoundHttpException('Dữ liệu đang cập nhật, hoặc trang này không tồn tại.'); 
        }
        $idProduct = $model->getAllTagsBytype($slugTag);

        $product = new FProduct();
        $data = $product->getProductsArrayID($idProduct,16);
        return $this->render('tags',['data'=>$data,'taginfo'=>$taginfo]);
        // }
    }
    public function actionTag($keySearch)
    {
        $this->layout = 'product';
        $keySearch = trim($keySearch);
        $model = new FProduct();
        $result = $model->getSearch($keySearch);
        // dbg($result);
        if(empty($result)){
            throw new NotFoundHttpException('Không có dữ liệu nào phù hợp.'); 
        }
        return $this->render('tag',['data'=>$result]);
    }

    public function actionSearch()
    {
        $keysearch = \Yii::$app->request->queryParams['keysearch'];
        if (!$keysearch)
        {
            return \Yii::$app->response->redirect('site/index');
        }
        $model = new \frontend\models\FTags();

        $result['tags'] = $model->getAllTag($keysearch);
        $model = new FProduct();
        $result['products'] = $model->getSearch($keysearch);

        return $this->renderAjax('timkiem',['data'=>$result]);
    }
}
