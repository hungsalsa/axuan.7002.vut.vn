<?php

namespace frontend\widgets\news;

use Yii;
use yii\base\Widget;

class news_hot_Widget extends Widget
{
    // public $data;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$model = new \frontend\models\news\FNews();

        $data = $model->getNewsHotWidget('hot',5);
        // dbg($data);
    	return $this->render('news_hot_Widget',['data'=>$data]);
    }
}