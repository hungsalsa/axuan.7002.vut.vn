<?php

namespace frontend\widgets\news;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class megaNewMenus extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new \frontend\models\news\FNews();
        // dbg(Yii::$app->params['productCategory']);
        // dbg(Yii::$app->params['productCategory']);
        // $data = $this->data;
        // $data['newsCategories'] = (Yii::$app->params['newsCategories']['arrayCateSlugSlug'])?Yii::$app->params['newsCategories']['arrayCateSlugSlug'] : [];
        // $cate = new \frontend\models\news\FCategories();
        // dbg($cate->getChildCateByslug($data['slugCateNews']));
        // $data['dataNews'] = $model->getNewsByCateID($cate->getChildCateByslug($data['slugCateNews']),20);

        // pr(count($data['dataNews']));
        // dbg($data);
        // $data['dataNews'] = $model->getNewByCateSlug([$data['slugCateNews']],$this->data['count_pro']);

    	return $this->render('megaNewMenus',['data'=>$this->data]);
    }
}