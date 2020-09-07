<?php

namespace frontend\widgets\news;

use yii\base\Widget;
use frontend\models\news\FNews;
use Yii;
// use yii\web\Session;

class newsModuleCenterMega extends Widget
{
    public $model;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $data = $this->model;
        $model = new FNews();
        $data['dataNews'] = $model->getNewByCate($data['cate_id']);
        // dbg($data);
        return $this->render('newsModuleCenterMega',['data'=>$data]);
    }
}