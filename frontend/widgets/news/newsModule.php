<?php

namespace frontend\widgets\news;

use yii\base\Widget;
// use yii\helpers\Html;
use Yii;
// use yii\web\Session;

class newsModule extends Widget
{
    public $model;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
        $data = new \frontend\models\news\FNews();

        $listNews = $data->getNewByCateSlug([$this->model['cate_slug']],$this->model['count_pro']);
// dbg($this->model);
        return $this->render('newsModule',['data'=>$this->model,'listNews'=>$listNews,'newsCategories'=>(Yii::$app->params['newsCategories']['arrayCateSlugSlug'])?Yii::$app->params['newsCategories']['arrayCateSlugSlug'] : []]);
    }
}