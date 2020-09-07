<?php

namespace frontend\controllers;
use frontend\models\news\FCategories;
use frontend\models\news\FNews;
use frontend\models\setting\FSettingModules;
use frontend\models\setting\FSettingModulesPages;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class NewsController extends \yii\web\Controller
{
    public function actions()
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
    }
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    public function actionIndex($slugCate,$idCate)
    {
        $this->layout = 'news';
        $modulePage = new FSettingModulesPages();
        $site = new FSettingModules();
        $module = $site->getAllSettingModules($modulePage->getModulePages('newsList'));
        Yii::$app->params['settingModules'] = $module;
        // dbg($modulePage->getModulePages('news'));

        /*$model = new FProduct;
        $data = $model->getProductBySlug($slug);
        */
        $cate = new FCategories();
        $categories = $cate->getCateInfo($slugCate);

        if(!isset($categories)){
            throw new NotFoundHttpException('Dữ liệu này đang cập nhật, xin vui lòng quay lại sau');
        }

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $categories['keyword']
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $categories['descriptions']
        ]);

        Yii::$app->view->registerMetaTag([
            'itemprop' => 'image',
            'content' => Url::home(true).$categories['images']
        ]);


        Yii::$app->view->registerMetaTag([
            'property' => 'og:title',
            'content' => $categories['title']
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:description',
            'content' => $categories['descriptions']
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:image',
            'content' => Url::home(true).$categories['images']
        ]);

        Yii::$app->view->registerMetaTag([
            'property' => 'og:url',
            'itemprop'=> 'url',
            'content' => Url::to(['categories/index', 'slug'=>$categories['slug']],true)
        ]);
        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>Url::to(['news/index', 'slugCate' => $slugCate, 'idCate' => $idCate],true)
        ]); 

        $model = new FNews();
        $data = $model->getNewsByCateList($cate->getChildCateByslug($slugCate));
        // dbg($data);
        if (count($data['listNews'])==1) {
            return $this->redirect(['news/view','slugCate'=>$slugCate,'slug'=>$data['listNews'][0]['newSlug'],'idNew'=>$data['listNews'][0]['id']]);
        }
        return $this->render('index',['data'=>$data,'categories'=>$categories]);
    }

    public function actionView($slugCate,$slug,$idNew)
    {

    	$this->layout = 'news';
        $modulePage = new FSettingModulesPages();
        $site = new FSettingModules();
        $module = $site->getAllSettingModules($modulePage->getModulePages('newsDetail'));
        Yii::$app->params['settingModules'] = $module;

        $cate = new FCategories;
        $category  = $cate->getCateInfo($slugCate);
        
        $model = new FNews;
        $data['model'] = $model->findModel($idNew,$slugCate); 
        if(!isset($data['model'])){
            throw new NotFoundHttpException('Dữ liệu này đang cập nhật, xin vui lòng quay lại sau');
        }
        $session = Yii::$app->session;

        if(!$session->has('news_'.$data['model']->id)){
            $session->set('news_'.$data['model']->id, 'news_'.$data['model']->id);
            // dbg($session['news_'.$data['model']->id]);
            $data['model']->view += 1;
            $data['model']->save();
        }
        // echo $session['news_'.$data['model']->id];
        // Yii::$app->session->set('blabla','1234')

        if(is_array(json_decode($data['model']->related_news))){
            $data['related_news'] = $model->findAllModel(json_decode($data['model']->related_news)); 
        }

        if(is_array(json_decode($data['model']->related_products))){
            $model = new \frontend\models\product\FProduct();
            $data['related_products'] = $model->getAllProductRelated(json_decode($data['model']->related_products)); 
        }

        if(is_array(json_decode($data['model']->related_albums))){
            $model = new \frontend\models\news\FAlbum();
            $data['related_albums'] = $model->findAllModel(json_decode($data['model']->related_albums)); 
        }
        if(is_array(json_decode($data['model']->related_downloads))){
            $model = new \frontend\models\news\FDownloads();
            $data['related_downloads'] = $model->findAllModel(json_decode($data['model']->related_downloads)); 
        }
        
        // dbg($data['related_downloads']);
        
        

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $data['model']->htmlkeyword
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $data['model']->htmldescriptions
        ]);

        Yii::$app->view->registerMetaTag([
            'itemprop' => 'image',
            'content' => Url::home(true).$data['model']->images
        ]);


        Yii::$app->view->registerMetaTag([
            'property' => 'og:htmltitle',
            'content' => $data['model']->htmltitle
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:description',
            'content' => $data['model']->htmldescriptions
        ]);
        Yii::$app->view->registerMetaTag([
            'property' => 'og:image',
            'content' => Url::home(true).$data['model']->images
        ]);

        Yii::$app->view->registerMetaTag([
            'property' => 'og:url',
            'itemprop'=> 'url',
            'content' => Url::to(['news/index', 'slug'=>$data['model']->newSlug],true)
        ]);
        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>Url::to(['news/view', 'slugCate' => $slugCate, 'slug' => $slug, 'idNew' => $idNew],true)
        ]); 
        $post = Yii::$app->request->post();
        
        $model_customer = new \frontend\models\FCustomers();

        if (Yii::$app->request->isAjax && $model_customer->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model_customer);
        }

        /*==============*/

        if ($model_customer->load($post = Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->order_id]);
            /*if ($post['g-recaptcha-response'] =='') {
                
                Yii::$app->session->setFlash('messeage', 'Bạn chưa chọn capcha, bạn hãy chọn lại capcha');
                return $this->render('view',['data'=>$data,'category'=>$category,'model_customer'=>$model_customer]);
                
            } else {*/
                $model_customer->id_link = $data['model']->id;
                $model_customer->type = 'news';
                $model_customer->url = Yii::$app->request->url;
                $model_customer->created_at = $model_customer->updated_at = time();
                $hostInfo = Yii::$app->request->hostInfo;

                $url = Yii::$app->request->getabsoluteUrl();
                if($model_customer->save()){

                    $khachhang['fullname'] = $model_customer->fullname;
                    $khachhang['phone'] = $model_customer->phone;
                    $khachhang['email'] = $model_customer->email;
                    $khachhang['note'] = $model_customer->note;
                    $khachhang['url'] = $url;
                    $khachhang['hostInfo'] = $hostInfo;

                    if($model_customer->email !=''){
                        $bodyEmail = $this->RenderBodyEmail($khachhang);
                        $emailCC =['nguyenvanxuan@hotmail.com'];

                        if($model_customer->actionSendEmail('Thông tin đặt hàng của Anh/Chị tại : '.$hostInfo,$model_customer->email,$emailCC,$bodyEmail)){

                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$model_customer->fullname.' đã đăng ký thông tin từ '.$hostInfo);
                        }else {
                            Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$model_customer->fullname.' đã đăng ký thông tin từ '.$hostInfo. ' | Nhưng thông tin Email của Anh/Chị chúng tôi không gửi được');

                        }
                    }else {
                        Yii::$app->session->setFlash('messeage', 'Cảm ơn Anh/Chị '.$model_customer->fullname.' đã đăng ký thông tin từ '.$hostInfo);
                    }

                }

                // Yii::$app->session->setFlash('messeage', 'Cảm ơn bạn đã đăng ký thông tin !');
                return $this->redirect($url);
                // dbg($model_customer);
            // }
        }
        
    	return $this->render('view',['data'=>$data,'category'=>$category,'model_customer'=>$model_customer]);
    }

    private function RenderBodyEmail($data)
    {
        return $this->renderAjax('email',['data'=>$data]);
    }

    public function actionTags($slugNewTag)
    {
        $this->layout = 'product';

        $model = new \frontend\models\FTags();

        $taginfo = $model->getInfoTags($slugNewTag,'news');

        if(empty($taginfo)){
            throw new NotFoundHttpException('Dữ liệu đang cập nhật, hoặc trang này không tồn tại.'); 
        }
        $idNews = $model->getAllTagsBytype($slugNewTag,'news');

        $news = new FNews();
        $data = $news->getAllNewsById($idNews,16);
        
        return $this->render('tags',['data'=>$data,'taginfo'=>$taginfo]);
    }

}