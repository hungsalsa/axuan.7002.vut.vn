<?php

namespace frontend\widgets\products;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class megaProductMenus extends Widget
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

    	$listProduct = $model->getfeaturedProducts([$this->data['cate_slug']],$this->data['count_pro']);
        // dbg($listProduct);
    	return $this->render('megaProductMenus',['data'=>$this->data,'listProduct'=>$listProduct,'productCategory'=>(Yii::$app->params['productCategory']['arrayCateSlugSlug'])?Yii::$app->params['productCategory']['arrayCateSlugSlug'] : []]);
    }
}