<?php

namespace frontend\widgets;

use yii\base\Widget;
// use Yii;

class formIn extends Widget
{
    public $name;
    public $content;
    // public $model;

    public function init()
    {
        parent::init();
        if ($this->name === null) {
            $this->name = '';
        }
        if ($this->content === null) {
            $this->content = '';
        }
        // ob_start();
    }
    public function run()
    {
        $model_customer = new \frontend\models\FCustomers();
        return $this->render('formIn',['name'=>$this->name,'content'=>$this->content,'model'=>$model_customer]);
    }
    
}