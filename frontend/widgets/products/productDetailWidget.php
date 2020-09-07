<?php

namespace frontend\widgets\products;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class productDetailWidget extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	// $model = new \frontend\models\product\FProduct();
// dbg($this->data);
    	// $listProduct = $model->getfeaturedProducts([$this->data['cate_slug']],$this->data['count_pro']);
        // dbg($this->data);
    	return $this->render('productDetailWidget',['data'=>$this->data]);
    }
}