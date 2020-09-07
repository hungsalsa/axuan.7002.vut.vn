<?php

namespace frontend\widgets\news;

use yii\base\Widget;
use frontend\models\news\FNews;
// use Yii;
// use yii\web\Session;

class latestNewsWidget extends Widget
{
    // public $model;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $model = new FNews();
        $data = $model->latestNewsWidget();
        // pr($data);
        
        return $this->render('latestNewsWidget',['data'=>$data]);
    }
}