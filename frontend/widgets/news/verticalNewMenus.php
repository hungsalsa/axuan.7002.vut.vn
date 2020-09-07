<?php

namespace frontend\widgets\news;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class verticalNewMenus extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new \frontend\models\product\FProduct();
    	// dbg(Yii::$app->params['productCategory']);
        // dbg(Yii::$app->params['productCategory']);
      $data = $this->data;

      $data['newsCategories'] = (Yii::$app->params['newsCategories']['arrayCateSlugSlug'])?Yii::$app->params['newsCategories']['arrayCateSlugSlug'] : [];

    	// $listProduct = $model->getfeaturedProducts([$this->data['cate_slug']],$this->data['count_pro']);
        // dbg($listProduct);
    	return $this->render('verticalNewMenus',['data'=>$data]);
    }
}