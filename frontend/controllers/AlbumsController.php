<?php

namespace frontend\controllers;
use Yii;
use frontend\models\news\FAlbum;
use frontend\models\news\FCategories;
use frontend\models\setting\FSettingModules;
use frontend\models\setting\FSettingModulesPages;
use yii\helpers\Url;
class AlbumsController extends \yii\web\Controller
{
    public function actionIndex($slugCate,$idCate)
    {
    	$this->layout = 'album';
    	$modulePage = new FSettingModulesPages();
        $site = new FSettingModules();
        $module = $site->getAllSettingModules($modulePage->getModulePages('albums'));
        Yii::$app->params['settingModules'] = $module;


    	$model = new FCategories();
    	$idCateArray = $model->getAllChildId($idCate);
        $categories = $model->getCateInfo($slugCate);


        $model = new FAlbum();
        $data = $model->getAlbumsByCateList($idCateArray);
// pr($idCateArray);
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


        // dbg($dataProduct->description);
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
            'content' => Url::to(['albums/index', 'slugCate'=>$slugCate, 'idCate'=>$idCate],true)
        ]);
        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>Url::to(['albums/index', 'slugCate'=>$slugCate, 'idCate'=>$idCate],true)
        ]);
        return $this->render('index',['data'=>$data]);
    }

    public function actionView($slug)
    {
        $this->layout = 'album';
        $modulePage = new FSettingModulesPages();
        
        $site = new FSettingModules();
        $module = $site->getAllSettingModules($modulePage->getModulePages('albums'));
        Yii::$app->params['settingModules'] = $module;

        $model = new FAlbum();
        $data = $model->getAlbumsDetail($slug);
        // dbg($data);
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $data['descriptions']
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $data['keywords'],
        ]);
        Yii::$app->view->registerLinkTag([
            'rel' => 'canonical',
            'href' =>Url::to(['albums/view', 'slug' => $slug],true)
        ]);
        if(empty($data)){
            throw new NotFoundHttpException('Trang này không tồn tại.'); 
        }
        return $this->render('view',['data'=>$data]);
    }
        

}
