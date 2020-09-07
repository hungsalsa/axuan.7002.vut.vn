<?php
namespace frontend\widgets\products;

use yii\base\Widget;

class product_2_Widget extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	// $listProduct = $model->getfeaturedProducts([$this->data['cate_id']],$this->data['count_pro']);
        $model = new \frontend\models\product\FProduct();
        
        $cate = new \frontend\models\product\FProductCategory();
        $idCateArray = [$this->data['cate_id']=>$this->data['cate_id']];
        $idCateArray = $cate->getChildCate($idCateArray);

        $listProduct = $model->getfeaturedProducts($idCateArray,$this->data['count_pro']);
        
    	// dbg($listProduct);
    	return $this->render('product_2_widget',['data'=>$this->data,'listProduct'=>$listProduct]);
    }
}