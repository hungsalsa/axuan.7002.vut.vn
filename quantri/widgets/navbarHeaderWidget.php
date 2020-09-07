<?php

namespace quantri\widgets;

use yii\base\Widget;
use yii\helpers\Html;
// use quantri\modules\quanlytin\models\Categories;
// use quantri\modules\setting\models\Menus;

class navbarHeaderWidget extends Widget
{
    // public $message;

    public function init()
    {
        parent::init();
       
    }

    public function run()
    {
    	/*$cate = Categories::findAll(['status'=>true,'parent_id'=>0]);
    	foreach ($cate as $value) {
    		// $Menus = Menus::findOne($value->id);
    		$Menus = Menus::findAll(['user_id'=>true]);
    		foreach ($Menus as $menu) {
    			if ($menu->id != $value->id) {
    				dbg($menu);
    				continue;
    			}

    			$menu->name = $value->cateName;
	    		$menu->link_cate = $value->id;
	    		$menu->slug = $value->slug;
	    		$menu->save();
    		}
    	}
    	// dbg($cate);*/
         return $this->render('navbarHeaderWidget');
    }
}
