<?php

namespace frontend\widgets\products;

use yii\base\Widget;
// use yii\helpers\Html;

class product_3_Widget extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new \frontend\models\product\FProduct();

        $cate = new \frontend\models\product\FProductCategory();
        $idCateArray = [$this->data['cate_id']=>$this->data['cate_id']];
        $idCateArray = $cate->getChildCate($idCateArray);

        $listProduct = $model->getfeaturedProducts($idCateArray,$this->data['count_pro']);

    	// pr($this->data);
    	// $listProduct = $model->getfeaturedProducts($this->data['id']);
        // dbg($listProduct);
    	return $this->render('product_3_widget',['data'=>$this->data,'listProduct'=>$listProduct]);
    }
}