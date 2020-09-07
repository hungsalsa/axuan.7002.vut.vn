<?php
// use frontend\widgets\customModulesIn;
// use frontend\widgets\categoryFeatured;
// use frontend\widgets\cateProductStatic;
// use frontend\widgets\news\newsModuleCenter;
// use frontend\widgets\news\newsModuleCenterMega;
// use frontend\widgets\formIn;
// dbg(Yii::$app->params['config']['seohome']);
$this->title = $title;

echo frontend\widgets\categoryWidget::widget();
echo frontend\widgets\products\product_hot_Widget::widget();

$content_center = isset(Yii::$app->params['settingModules']['content']['content_center']) ? Yii::$app->params['settingModules']['content']['content_center'] : null; 
if ($content_center){
	foreach ($content_center as $value){

		if ($value['type_module']=='custom'){
			echo frontend\widgets\customModulesIn::widget(['content'=>$value['content']]);
		} 
		if ($value['type_module']=='form'){
			echo frontend\widgets\formIn::widget(['name'=>$value['name'],'content'=>$value['content']]);
		}
		if ($value['type_module']=='product'){

			switch ($value['hienthi']) {
				case 'product_1':
				// 'product_1'=>'Hình ảnh',
				echo frontend\widgets\products\product_1_Widget::widget(['data'=>$value]);
				break;
				case 'product_2':
				// die;
				// 'product_2'=>'Danh sách',
				echo frontend\widgets\products\product_2_Widget::widget(['data'=>$value]);
				break;

				default:
				// 'product_3'=>'Kiểu 3',
				echo frontend\widgets\products\product_3_Widget::widget(['data'=>$value]);
				break;
			}

			
		}
		if ($value['type_module']=='news'){
			echo frontend\widgets\news\news_hot_Widget::widget();
			switch ($value['hienthi']) {
				case 'new_2':
				echo frontend\widgets\news\newsModule_2::widget(['model'=>$value]);
				break;
				case 'new_3':
				echo frontend\widgets\news\newsModule_3::widget(['model'=>$value]);
				break;
				case 'new_4':
				echo frontend\widgets\news\newsModule_4::widget(['model'=>$value]);
				break;
				default:
				echo frontend\widgets\news\newsModule_1::widget(['model'=>$value]);
				break;
			}
		} 
	} 
}


?>

