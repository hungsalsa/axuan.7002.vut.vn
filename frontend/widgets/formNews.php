<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use frontend\models\setting\FMenus;

class formNews extends Widget
{
    public $name;
    public $content;
    public $model;
    public $post;
    /*public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
       // dbg($info);
    }

    */

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
        // $menu = new FMenus();
     //    $dataMenu = $menu->getAllMenus();
        // dbg($this->message);
        // $content = ob_get_clean();
        // dbg($this->post);
        return $this->render('formNews',['name'=>$this->name,'content'=>$this->content,'model'=>$this->model,'post'=>$this->post]);
    }
    
}