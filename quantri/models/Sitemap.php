<?php
namespace quantri\models;

use quantri\modules\quanlytin\models\Categories;
use quantri\modules\quanlytin\models\News;

use Yii;
use yii\helpers\ArrayHelper;
use quantri\models\User;
/**
 * This is the model class for table "tbl_news".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $images
 * @property string $image_category
 * @property string $image_detail
 * @property int $category_id
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_descriptions
 * @property string $short_description
 * @property string $content
 * @property int $hot
 * @property int $view
 * @property string $related_products
 * @property string $related_news
 * @property int $sort
 * @property int $status
 * @property int $user_add
 * @property int $created_at
 * @property int $updated_at
 */
class Sitemap extends \yii\db\ActiveRecord
{
	protected $hostInfo ;
	public function createSitemap()
	{
		$this->hostInfo = Yii::$app->request->hostInfo;
// dbg($_SERVER['DOCUMENT_ROOT']);
        $begin = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';
        $end = '</urlset>
';

        $string = '    <url>
            <loc>'.$this->hostInfo.'</loc>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
';
		$stringCate = $this->CreateSimapCategory();
		$string .= $stringCate;
		
		$stringNews = $this->CreateSimapNews();
		$string .= $stringNews;

		$siteMap = $begin.$string.$end;
        $fp = fopen($_SERVER['DOCUMENT_ROOT']."/frontend/web/sitemap.xml","w");

        fwrite($fp, $siteMap);

        fclose($fp);
	}

    private function CreateSimapCategory()
    {
    	
    	$string='';
        $dataCate = Categories::find()->select(['id','cateName','slug'])->where(['status'=>true])->all();
        foreach ($dataCate as $category) {
        $string .= '        <url>
            <loc>'.$this->hostInfo.'/'.$category->slug.'</loc>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
';
        }
        return $string;
    }

    private function CreateSimapNews()
    {
    	
    	$string='';
        $dataNews = News::find()->select(['id','name','slug'])->where(['status'=>true])->all();
        foreach ($dataNews as $new) {
        $string .= '        <url>
            <loc>'.$this->hostInfo.'/'.$new->slug.'.html</loc>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
';
        }
	    return $string;
    }
}
