<?php
namespace frontend\widgets\news;
use yii\base\Widget;
use frontend\models\news\FNews;
class newsModule_3 extends Widget
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
        $cate = new \frontend\models\news\FCategories();
        $data['dataNews'] = $model->getNewsByCateID($cate->getChildCateByslug($data['slugCateNews']),8);
        // pr($data);
        return $this->render('newsModule_3',['data'=>$data]);
    }
}