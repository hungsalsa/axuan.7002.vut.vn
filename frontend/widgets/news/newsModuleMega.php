<?php

namespace frontend\widgets\news;

use yii\base\Widget;
use frontend\models\news\FNews;
use Yii;
// use yii\web\Session;

class newsModuleMega extends Widget
{
    public $model;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	$new = new FNews();
        $data = $this->model;
        $data['childrens'] = $new->getNewByCate($data['cate_id']);
// dbg($data);
        return $this->render('newsModuleMega',['data'=>$data]);
    }
}