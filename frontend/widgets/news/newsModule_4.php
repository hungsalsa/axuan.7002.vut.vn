<?php
namespace frontend\widgets\news;
use yii\base\Widget;
class newsModule_4 extends Widget
{
    public $model;
    public function init()
    {
        parent::init();
    }
    public function run()
    {
        $data = $this->model;
        $model = new \frontend\models\news\FNews();
        $cate = new \frontend\models\news\FCategories();
        $data['dataNews'] = $model->getNewsByCateID($cate->getChildCateByslug($data['slugCateNews']),8);
        
        return $this->render('newsModule_4',['data'=>$data]);
    }
}