<?php

namespace frontend\widgets\news;

use yii\base\Widget;
use frontend\models\news\FNews;
// use Yii;
// use yii\web\Session;

class newsModule_1 extends Widget
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
        // $data['dataNews'] = $model->getNewsByCateID([$data['cate_id']]);
        $cate = new \frontend\models\news\FCategories();
        $data['dataNews'] = $model->getNewsByCateID($cate->getChildCateByslug($data['slugCateNews']),8);
        // dbg($data);
        return $this->render('newsModule_1',['data'=>$data]);
    }
}