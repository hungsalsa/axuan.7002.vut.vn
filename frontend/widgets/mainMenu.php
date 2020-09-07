<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use frontend\models\setting\FMenus;

class mainMenu extends Widget
{
    public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	// $session = Yii::$app->session;
    	// $infoCart = $session['cart'];
        $menu = new FMenus();
        // $data = $menu->getAllMenus();
        
        $data = $menu->getMenusChild_3();
        // dbg($data);

        // foreach ($data as $key => $value) {
        //     $childrens = $menu->getAllMenus($value['id']);
        //     // if ($childrens) {
        //         $data[$key]['childrens'] = $childrens;
        //     // }
        // }
        return $this->render('mainMenu',['dataMenu'=>$data]);
    }
}