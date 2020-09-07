<?php

namespace frontend\widgets\products;

use yii\base\Widget;
use yii\helpers\Html;
use frontend\models\product\FProduct;

class product_4_Widget extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new FProduct();
    	$listProduct = $model->getfeaturedProducts($this->data['id']);
    	// dbg($listProduct);
    	return $this->render('product_4_widget',['data'=>$this->data,'listProduct'=>$listProduct]);
    }
}