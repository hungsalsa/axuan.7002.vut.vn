<?php
namespace quantri\commands;

use Yii;
use yii\base\Component;
use quantri\modules\setting\models\SettingDefault;
// use app\commands\Access;

class SiteInfo extends Component
{
    public function init()
    {
        parent::init();
        $site = new SettingDefault();
        $site = $site->siteInfo();
        if ($site['layout_backend']==0) {
        	$site['layout_backend'] = 'main';
        } else {
        	$site['layout_backend'] = 'hoz_main';
        }
        Yii::$app->params['layout'] = $site;

        if(empty(Yii::$app->params['productCategory'])){
            $category = new \quantri\modules\products\models\Products();
            /*mảng tất cả các id danh mục sử dụng trong sản phẩm*/
            $idCateArray = $category->getAllIdCategory();

            $category = new \quantri\modules\products\models\Productcategory();
            Yii::$app->params['productCategory']['idCateArray'] = $idCateArray = $category->getChildCate($idCateArray);

            /*mảng tất cả các danh mục kích hoạt*/
            $all = Yii::$app->params['productCategory']['all'] = $category->getCategoryParent();
            if($idCateArray){
            /*mảng tất cả các tên sử dụng, với idCate là key*/
            $arrayCateName = Yii::$app->params['productCategory']['arrayCateName'] = array_intersect_key($all,$idCateArray);

            /*mảng tất cả các tên sử dụng, với slugcate là key*/
            $arrayCateSlug = $category->getCategoryParentField($idCateArray);
            Yii::$app->params['productCategory']['arrayCateSlug'] = array_intersect($arrayCateSlug,$arrayCateName);
            // dbg($category->getAllCat());
            }
            // dbg(Yii::$app->params['productCategory']);
        }

        if(empty(Yii::$app->params['newsCategories'])){
            $category = new \quantri\modules\news\models\News();
            $idCateArray =  $category->getAllIdCategories();
            
            $category = new \quantri\modules\news\models\Categories();
            Yii::$app->params['newsCategories']['idCateArray'] = $idCateArray = $category->getChildCate($idCateArray);
            /*mảng tất cả các danh mục kích hoạt*/
            $all = Yii::$app->params['newsCategories']['all'] = $category->getCategoryParent();

            // if($idCateArray){
            /*mảng tất cả các tên sử dụng, với idCate là key*/
            // $arrayCateName = Yii::$app->params['productCategory']['arrayCateName'] = array_intersect_key($all,$idCateArray);

            if($idCateArray){
                /*mảng tất cả các tên sử dụng, với idCate là key*/
                $arrayCateName = Yii::$app->params['newsCategories']['arrayCateName'] = array_intersect_key($all,$idCateArray);

                /*mảng tất cả các tên sử dụng, với slugcate là key*/
                $arrayCateSlug = $category->getCategoryParentField($idCateArray);
                Yii::$app->params['newsCategories']['arrayCateSlug'] = array_intersect($arrayCateSlug,$arrayCateName);
            }
// dbg(Yii::$app->params['newsCategories']);

            // Yii::$app->params['newsCategories']['allCateSlug'] = $category->getAllCateSlug();
            /*mảng tất cả các tên sử dụng, với idCate là key*/
            // Yii::$app->params['newsCategories']['arrayCateName'] = $category->getCateNameById(array_values(Yii::$app->params['newsCategories']['idCateArray']));
            /*mảng tất cả các tên sử dụng, với slugcate là key*/
            // Yii::$app->params['newsCategories']['arrayCateSlug'] = $category->getSlugCategoriesParentById(array_values(Yii::$app->params['newsCategories']['idCateArray']));
        }
    }

    public function Slug_url($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        $str = strtolower($str);
        return $str;
    }
}