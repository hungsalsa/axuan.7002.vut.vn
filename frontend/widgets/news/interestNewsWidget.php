<?php

namespace frontend\widgets\news;

use yii\base\Widget;
// use frontend\models\news\FNews;
// use Yii;
// use yii\web\Session;

class interestNewsWidget extends Widget
{
    // public $model;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $model = new \frontend\models\news\FNews();

        $data = $model->getNewsHotWidget('interest');
        // dbg($data);
        
        return $this->render('interestNewsWidget',['data'=>$data]);
    }
}