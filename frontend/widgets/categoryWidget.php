<?php

namespace frontend\widgets;

use yii\base\Widget;
// use frontend\models\setting\FSettingBrands;
use Yii;
class categoryWidget extends Widget
{
    

    public function init()
    {
        parent::init();       
    }

    public function run()
    {
    	$model = new \frontend\models\product\FProductCategory();
        $data = $model->getAllShowhomepage();
        // dbg($data);
    	return $this->render('categoryWidget',['data'=>$data]);
    }
}