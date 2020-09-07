<?php

namespace frontend\models\news;

use Yii;
use yii\data\Pagination;
class FNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'newSlug', 'category_id', 'content', 'status', 'userCreated', 'created_at', 'updated_at','userUpdated','formshow'], 'required'],
            // [['category_id', 'hot', 'view', 'sort', 'status', 'userUpdated', 'userCreated', 'created_at', 'updated_at'], 'integer'],
            [['htmldescriptions', 'short_description', 'content'], 'string'],
            [['name', 'newSlug', 'images', 'image_category', 'image_detail', 'htmltitle', 'htmlkeyword', 'related_products', 'related_news','tags'], 'string', 'max' => 255],
            [['related_albums', 'related_downloads'], 'string', 'max' => 500],
            [['newSlug'], 'unique'],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'newSlug' => 'newSlug',
            'images' => 'Images',
            'image_category' => 'Image Category',
            'image_detail' => 'Image Detail',
            'category_id' => 'Category ID',
            'htmltitle' => 'Htmltitle',
            'htmlkeyword' => 'Htmlkeyword',
            'htmldescriptions' => 'Htmldescriptions',
            'short_description' => 'Short Description',
            'content' => 'Content',
            'hot' => 'Hot',
            'view' => 'View',
            'interest' => 'interest',
            'related_products' => 'Related Products',
            'related_news' => 'Related News',
            'related_albums' => 'Related Albums',
            'related_downloads' => 'Related Downloads',
            'sort' => 'Sort',
            'tags' => 'tags',
            'status' => 'Status',
            'userCreated' => 'User Add',
            'userUpdated' => 'userUpdated',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getDanhmuc()
    {
        return $this->hasOne(FCategories::className(),['id'=>'category_id']);
    } 
    
    public function getTagsAll()
    {
        return $this->hasMany(\frontend\models\FTags::className(),['link'=>'id'])->andOnCondition(['type' => 'news']);
    }

    /*public function getMessageThreads()
    {
        $query = \frontend\models\FTags::find()
        ->andWhere([
            ['link' => $this->id],
            ['recipient_id' => $this->id],
        ]);
        $query->multiple = true;

        return $query;
    }*/

    public function findModel($id,$slugCate)
    {
        $model = self::find()->alias('p')
        ->select(['{{p}}.*'])
        ->joinWith('danhmuc d',false)
        ->where('p.id=:id AND d.slug=:dslug',[':id'=>$id,':dslug'=>$slugCate])->one();
        // if ($model !== null) {
            return $model;
        // }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function findAllModel($idArray,$limit=16)
    {
        return  self::find()->alias('p')->select(['p.id','p.name','p.view','p.htmltitle','p.newSlug','p.images','p.htmlkeyword','p.short_description','d.slug as slugCate'])
        ->joinWith('danhmuc d',false)
        ->where(['IN','p.id',$idArray])
        ->limit($limit)
        ->orderBy(['p.sort' => SORT_DESC, 'p.created_at' => SORT_DESC])->asArray()->all();

    }

    // Laays ra danh sách tất cả các Id Danh mục sử dụng trong bảng news
    public function getAllIdCategories()
    {
        return  yii\helpers\ArrayHelper::map(self::find()->select(['category_id'])->distinct()->where('status=:status',[':status'=>true])->all(),'category_id','category_id');
    }

    // Hamf lấy danh sách sản phẩm danh mục sản phẩm categories/view
    private function getAllProductBy($value,$type='product_category_id',$limit=8)
    {
        $data = self::find()->alias('p')
        ->select(['p.id','p.name','p.view','p.content','p.htmltitle','p.newSlug','p.images','p.category_id','p.htmlkeyword','p.htmldescriptions','p.short_description','p.related_products','d.slug as slugCate'])
        ->joinWith('danhmuc d',false)
        ->where('p.status=:status',[':status'=>true]);
        if ($type=='product_category_id') {
            $data->andWhere(['p.'.$type=>$value]);
        }
        return $data->orderBy(['p.sort' => SORT_DESC, 'p.created_at' => SORT_DESC, 'p.updated_at' => SORT_DESC])->limit($limit)->asArray()->all();
    }
     public function getAllNewsById($idArray,$pageSize = 16,$page = true)
    {
        $data =  self::find()->alias('p')
        ->select(['p.id','p.name','p.view','p.htmltitle','p.newSlug','p.images','d.slug as slugCate','short_description'])
        ->joinWith('danhmuc d',false)
        ->where('p.status=:status',[':status'=>true])
        ->andWhere(['IN','p.id',$idArray]);
        if ($page) {
            $result['pages'] = new Pagination([
                'totalCount' => $data->count(),
                'pageSize'=>$pageSize,
                    // 'forcePageParam' => 'trang',
                    // 'pageParam' => 'trang',
                    // 'pageParam' => yii\widgets\Pagination::createUrl(100),
                    // 'pageParam' => false,
                    // 'pageSizeParam' => ''
                    // 'pageParam' => 'start', 
                    // 'defaultPageSize' => 2,
                'forcePageParam' => false,
                'pageSizeParam' => false,

                    // 'queryParam' => false
                    // 'route'=>'san-pham/<slug>/trang-<page:\d+>'
            ]);

            $result['news'] =  $data->asArray()->orderBy(['p.sort' => SORT_DESC, 'p.created_at' => SORT_DESC])
            ->offset($result['pages']->offset)
            ->limit($result['pages']->limit)
            ->all();
        } else {
            $result =  $data->asArray()->orderBy(['p.sort' => SORT_DESC, 'p.created_at' => SORT_DESC])
            ->limit($pageSize)
            ->all();
        }
        
        return $result;

    }

    /*HAM LẤY CÁC SẢN PHẨM LIÊN QUAN*/
    private function getAllProductRelated($idArray)
    {
        return  self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.views','p.title','p.slug','p.image','d.slug as slugCate'])
        ->joinWith('danhmuc d',false)
        ->where('p.status=:status',[':status'=>true])
        ->andWhere(['IN','id',$idArray])
        ->orderBy(['p.sort' => SORT_DESC, 'p.created_at' => SORT_DESC, 'p.updated_at' => SORT_DESC])
        ->asArray()->all();
    }

    public function getNewsBySlug($newSlug)
    {
        $data['news'] = self::find()->alias('n')
        ->select(['n.id','n.name','n.content','n.htmltitle','n.newSlug','n.images','n.category_id','n.htmlkeyword','n.htmldescriptions','n.short_description','n.related_products','n.related_news'])
        // ->innerJoinWith('imagepro',true)
        // ->joinWith([
        //     'cungdanhmuc as pd' => function (\yii\db\ActiveQuery $query) use($newSlug,$limit,$offset){
        //         $query->select(['pd.id','pd.pro_name','pd.newSlug','pd.title','pd.newSlug','pd.price','pd.price_sales','pd.category_id','pd.order']);
        //         $query->where(['pd.status' => true]);
        //         $query->andWhere(['<>','pd.newSlug', $newSlug]);
        //         $query->orderBy([
        //             'pd.order' => SORT_ASC,
        //             'pd.updated_at' => SORT_DESC,
        //         ]);
        //         $query->limit($offset)->offset($limit);
        //     },
        // ])
        ->where('n.newSlug=:newSlug AND n.status=:status',[':newSlug'=>$newSlug,':status'=>true])->asArray()->one();
        // $data['cungdanhmuc']= $this->getAllProductBy($data['news']['category_id']);
        // $data['productRelated']= ($data['news']['related_products']=='')? []: $this->getAllProductRelated(json_decode($data['news']['related_products']));
        return $data;
    }
    // Hamf lấy danh sách sản phẩm danh mục sản phẩm categories/view


    // Hamf lấy danh sách sản phẩm danh mục sản phẩm categories/index
    public function getNewsByCateList($cateIdList,$pageSize = 10,$status = true)
    {
        // $pages = $this->dataPagerProduct($cateIdList,$pageSize);
        $result['pages'] = $this->getPagerProduct($cateIdList,$pageSize);
        $data =  self::find()->alias('n')
        ->select(['n.id','n.name','n.htmltitle','n.newSlug','n.images','n.htmlkeyword','n.htmldescriptions','n.short_description','d.slug as slugCate'])
        ->joinWith(['danhmuc d'],false)
        /*->with([
            'protype' => function($query){
                $query->select(['idtype','pro_id', 'product_type_id']);
                $query->where(['status' => true]);
            }
        ])*/
        ->where('n.status=:status',[':status'=>$status])
        ->andWhere(['IN','n.category_id',$cateIdList]);
        $result['listNews'] = $data->orderBy(['n.sort' => SORT_DESC, 'n.created_at' => SORT_DESC, 'n.updated_at' => SORT_DESC])->offset($result['pages']->offset)
                ->limit($result['pages']->limit)
                ->asArray()
                ->all();
        return $result;
    }

    
    /*categories/index*/
    public function getPagerProduct($cateIdList,$pageSize = 10)
    {
        // $data = Product::find()->asArray()->where('category_id =:cateId AND active =:status',['cateId'=>$cateId,'status'=>true]);
        $data = self::find()->asArray()->where(['IN', 'category_id', $cateIdList])->all();
        $pages = new Pagination([
                    'totalCount' => count($data),
                    'pageSize'=>$pageSize,
                    // 'forcePageParam' => 'trang',
                    // 'pageParam' => 'trang',
                    // 'pageParam' => yii\widgets\Pagination::createUrl(100),
                    // 'pageParam' => false,
                    // 'pageSizeParam' => ''
                    // 'pageParam' => 'start', 
                    // 'defaultPageSize' => 2,
                    'forcePageParam' => true,
                    'pageSizeParam' => false,
                    
                    // 'queryParam' => false
                    // 'route'=>'san-pham/<slug>/trang-<page:\d+>'
                ]);


        return $pages;
    }

    public function getNewByCateSlug($cateSlug,$limit='')
    {
        if($limit==''){
            $limit=10;
        }
        
        return self::find()->alias('p')
        ->select(['p.id','p.short_description','p.name','p.htmltitle','p.newSlug','p.images'])
        ->joinWith('danhmuc d',false)
        ->asArray()
        ->where('p.status =:status',[':status'=>1])
        ->andWhere(['IN','d.slug',$cateSlug])
        // ->andWhere(['IN','category_id',$cateId])
        ->orderBy(['p.sort' => SORT_DESC,'p.created_at' => SORT_DESC])->limit($limit)->all();
    }

    /*Hàm lấy tin tức theo CateID, sử dụng widget*/
    public function getNewsByCateID($cateID,$limit=16)
    {
        return self::find()->alias('p')
        ->select(['p.id','p.short_description','p.name','p.htmltitle','p.newSlug','p.images','d.slug as slugCate'])
        ->joinWith('danhmuc d',false)
        ->asArray()
        ->where('p.status =:status',[':status'=>1])
        ->andWhere(['IN','p.category_id',$cateID])
        // ->andWhere(['IN','category_id',$cateId])
        ->orderBy(['p.sort' => SORT_DESC,'p.created_at' => SORT_DESC])->limit($limit)->all();
    }

    // Hamf lấy danh sách tất cả tin tuc hot
    public function getNewsHotWidget($field = 'hot' ,$limit = 10,$status = true)
    {
        return self::find()->alias('n')
        ->select(['n.id','n.name','n.htmltitle','n.newSlug','n.images','n.category_id','n.short_description','d.slug as slugCate',$field])
        // ->joinWith('imageOne i',false)
        ->joinWith(['danhmuc d'],false)
        // ->joinWith([
        //     'proVersionsOne as pv' => function (\yii\db\ActiveQuery $query){
        //         $query->select(['pv.id','pv.pro_id','pv.name']);
        //     }
        // ],true)

        ->where('n.status=:status AND n.'.$field.'=:hot',[':status'=>$status,':hot'=>true])
                ->limit($limit)
        ->orderBy(['n.sort' => SORT_DESC, 'n.updated_at' => SORT_DESC, 'n.sort' => SORT_DESC])
                // ->offset($offset)
                ->asArray()
                ->all();
    }


    // Hamf lấy danh sách tất cả tin tuc mới nhất
    public function latestNewsWidget($limit = 6,$offset= 0 ,$status = true)
    {
        return self::find()->alias('n')
        ->select(['n.id','n.name','n.htmltitle','n.newSlug','n.images','n.category_id','n.short_description','d.slug as slugCate'])
        // ->joinWith('imageOne i',false)
        ->joinWith(['danhmuc d'],false)
        // ->joinWith([
        //     'proVersionsOne as pv' => function (\yii\db\ActiveQuery $query){
        //         $query->select(['pv.id','pv.pro_id','pv.name']);
        //     }
        // ],true)

        ->where('n.status=:status',[':status'=>$status])
                ->limit($limit)
        ->orderBy(['n.created_at' => SORT_DESC, 'n.updated_at' => SORT_DESC, 'n.sort' => SORT_DESC])
                // ->offset($offset)
                ->asArray()
                ->all();
    }

    
}