<?php

namespace frontend\widgets\products;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
// use frontend\models\product\FProduct;

class verticalProductMenus extends Widget
{
    public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new \frontend\models\product\FProductcategory();
    	// dbg(Yii::$app->params['productCategory']);
        $data = $this->data;

        $data['productCategory'] = (Yii::$app->params['productCategory']['arrayCateSlugSlug']) ? Yii::$app->params['productCategory']['arrayCateSlugSlug'] : [];
        // dbg($data);
    	return $this->render('verticalProductMenus',['data'=>$data]);
    }
}