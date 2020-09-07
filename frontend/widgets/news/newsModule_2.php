<?php

namespace frontend\widgets\news;

use yii\base\Widget;
use frontend\models\news\FNews;
// use Yii;
// use yii\web\Session;

class newsModule_2 extends Widget
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
        // $model->getNewsByCateID([$data['cate_id']]);
        $cate = new \frontend\models\news\FCategories();
        $data['dataNews'] = $model->getNewsByCateID($cate->getChildCateByslug($data['slugCateNews']),8);
        // dbg($idCate);
        // dbg($data);
        return $this->render('newsModule_2',['data'=>$data]);
    }
}