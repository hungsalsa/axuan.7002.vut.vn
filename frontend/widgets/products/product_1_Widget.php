<?php

namespace frontend\widgets\products;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class product_1_Widget extends Widget
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
        // dbg($listProduct);
    	return $this->render('product_1_widget',['data'=>$this->data,'listProduct'=>$listProduct,'productCategory'=>(Yii::$app->params['productCategory']['arrayCateSlugSlug'])?Yii::$app->params['productCategory']['arrayCateSlugSlug'] : []]);
    }
}