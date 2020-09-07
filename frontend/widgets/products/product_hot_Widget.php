<?php

namespace frontend\widgets\products;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class product_hot_Widget extends Widget
{
    // public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new \frontend\models\product\FProduct();

        $listProduct = $model->getProductHotWidget();
        // $listProduct = $data['listproduct'];
    	// $listProduct = $model->getfeaturedProducts([$this->data['cate_id']],$this->data['count_pro']);
        // dbg($listProduct);
    	return $this->render('product_hot_Widget',['listProduct'=>$listProduct,'productCategory'=>(Yii::$app->params['productCategory']['arrayCateSlugSlug'])?Yii::$app->params['productCategory']['arrayCateSlugSlug'] : []]);
    }
}