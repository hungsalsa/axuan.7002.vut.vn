<?php

namespace frontend\models\product;

use Yii;
use yii\data\Pagination;
class FProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'pro_name', 'slug', 'descriptions', 'content', 'product_category_id'], 'required'],
            [['inventory', 'amount', 'order_out_stock', 'highlights', 'supplier_id', 'price', 'price_sales', 'vat', 'product_type_id', 'warranty_period', 'models_id', 'views', 'product_category_id', 'status', 'time_status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['order'], 'number'],
            [['keywords', 'descriptions', 'short_introduction', 'content', 'related_articles', 'related_products','related_albums', 'related_downloads'], 'string'],
            [['start_sale', 'end_sale'], 'safe'],
            [['code'], 'string', 'max' => 50],
            [['pro_name', 'title', 'slug', 'image', 'images_list', 'tags','pro_name_not'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['code'], 'unique'],
            [['pro_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pro_name' => 'Tên sản phẩm',
            'title' => 'Tiêu đề',
            'slug' => 'Đường dẫn',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'short_introduction' => 'Mô tả ngắn',
            'content' => 'Chi tiết',
            'price' => 'Giá',
            'price_sales' => 'Giá bán',
            'start_sale' => 'Ngày đầu giảm giá',
            'end_sale' => 'Ngày cuối giảm giá',
            'order' => 'Sắp xếp',
            'status' => 'Kích hoạt',
            'product_type_id' => 'Loại sản phẩm',
            'salse' => 'Giảm giá',
            'hot' => 'Nổi bật',
            'best_seller' => 'Bán chạy',
            'manufacturer_id' => 'Hãng sản xuất',
            'guarantee' => 'Bảo hành',
            'models_id' => 'Xe sử dụng',
            'views' => 'Số lượt xem',
            'code' => 'Mã sản phẩm',
            'image' => 'Ảnh đại diện',
            'images_list' => 'Images List',
            'tags' => 'Tags',
            'product_category_id' => 'Danh mục sản phẩm',
            'related_articles' => 'Bài viết liên quan',
            'related_articles' => 'Bài viết liên quan',
            'related_albums' => 'related_albums',
            'related_downloads' => 'related_downloads',

            'userCreated' => 'User ID',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }
    
    public function getImageList()
    {
        return $this->hasMany(FProductImages::className(),['pro_id'=>'id']);
    }
    public function getProVersions()
    {
        return $this->hasMany(FProductVersions::className(),['pro_id'=>'id'])->orderBy(['date'=>SORT_ASC]);//->active();
    }
    public function getProVersionsOne()
    {
        return $this->hasOne(FProductVersions::className(), ['pro_id' => 'id']);//->active();
    } 
    public function getImageOne()
    {
        return $this->hasOne(FProductImages::className(), ['pro_id' => 'id']);
    } 
    public function getDanhmuc()
    {
        return $this->hasOne(FProductCategory::className(),['idCate'=>'product_category_id']);
    }  
    public function getCungdanhmuc()
    {
        return $this->hasMany(self::className(),['product_category_id'=>'product_category_id']);
    } 
    
    public function getThuoctinh()
    {
        return $this->hasMany(FProductThuoctinh::className(),['product_id'=>'id']);
    }
    
    public function getOneAttribute()
    {
        return $this->hasOne(FProductThuoctinh::className(),['product_id'=>'id'])->andOnCondition(['sort' => 0]);
    }
    
    public function getTagsAll()
    {
        return $this->hasMany(\frontend\models\FTags::className(),['link'=>'id'])->andOnCondition(['type' => 'product']);
    }

    // Hàm lấy danh sách IDcate có sử dụng
    public function getAllIdCategory()
    {
        return  yii\helpers\ArrayHelper::map(self::find()->select(['product_category_id'])->distinct()->where('status=:status',[':status'=>true])->all(),'product_category_id','product_category_id');
    }

    // Sử dụng widget featuredProducts
    public function getfeaturedProducts($idCate,$limit = 12)
    {
        if($limit==''){
            $limit=12;
        }
        return self::find()->limit($limit)->alias('p')
        ->select(['p.id','p.short_introduction','p.pro_name','p.title','p.slug','p.price','p.price_sales','p.image','p.product_type_id','d.slug as slugCate','p.start_sale','end_sale'])
        // ->joinWith('danhmuc d',false)
        ->joinWith(['danhmuc d'],false)
        // ->joinWith('imageOne i',false)
        ->with([
            'imageOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['idIma','image','title','pro_id','order'])
                ->orderBy([
                    'order' => SORT_DESC,
                ]);
            },
            'oneAttribute' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','product_id','name','value','sort']);
                // ->orderBy([
                //     'sort' => SORT_DESC,
                // ]);
            },
            'proVersionsOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','pro_id','date','name','price_1','price_sale_1'])
                ->orderBy([
                    'date' => SORT_ASC,
                ])
                ->andOnCondition(['>=', 'date', date('Y-m-d')])
                ->andOnCondition(['status' => 1]);
            }
        ],true)
        ->where('p.status =:status',[':status'=>1])
        ->andWhere(['IN','p.product_category_id',$idCate])
        ->groupBy('p.id')
        ->orderBy(['p.order' => SORT_DESC,'p.created_at' => SORT_DESC])
        // ->offset(0)
        ->asArray()
        ->all();
    }

    // Hamf lấy danh sách sản phẩm danh mục sản phẩm categories/index
    public function getProductByCateList($cateIdList,$pageSize=10,$status = true)
    {
        
        $result['pages']  = $this->getPagerProduct($cateIdList,$pageSize);
         $data =  self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.title','p.slug','p.price','p.price_sales','p.product_category_id','p.short_introduction','start_sale','end_sale','p.order'])
        // ->joinWith(['imageOne i'],false)
        // ->joinWith(['proVersionsOne pv'],false)
        ->with([
            'proVersionsOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','pro_id','date','name','price_1','price_sale_1'])
                ->orderBy([
                    'date' => SORT_ASC,
                ])
                ->andOnCondition(['>=', 'date', date('Y-m-d')])
                ->andOnCondition(['status' => 1]);
                
            }
        ],true)
        ->where('p.status=:status',[':status'=>$status])
        ->andWhere(['IN','p.product_category_id',$cateIdList]);
        $result['products'] =  $data->orderBy(['p.order' => SORT_DESC, 'p.updated_at' => SORT_DESC])
                ->offset($result['pages']->offset)
                ->limit($result['pages']->limit)
                ->all();
        return $result;
    }
    public function getPagerProduct($cateIdList,$pageSize)
    {
        $data = self::find()->asArray()->where('status=:status',[':status'=>true])->andWhere(['IN', 'product_category_id', $cateIdList]);
        $pages = new Pagination([
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

        return $pages;
    }
    // Hamf lấy danh sách tất cả sản phẩm hot
    public function getProductHotWidget($limit = 25,$offset= 0 ,$status = true)
    {
        return self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.title','p.slug','p.price','p.price_sales','i.image','p.product_category_id','p.short_introduction','start_sale','end_sale','d.slug as slugCate'])
        // ->joinWith('imageOne i',false)
        ->joinWith(['imageOne i','danhmuc d'],false)
        ->with([
            'oneAttribute' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','product_id','name','value','sort']);
                // $query->orderBy([
                //     'i.order' => SORT_ASC,
                //     'i.updated_at' => SORT_DESC,
                // ]);
            },
            'proVersionsOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','pro_id','date','name','price_1','price_sale_1'])
                ->orderBy([
                    'date' => SORT_ASC,
                // //     'i.updated_at' => SORT_DESC,
                ])
                ->andOnCondition(['>=', 'date', date('Y-m-d')])
                ->andOnCondition(['status' => 1]);
            }
        ],true)

        ->where('p.status=:status AND p.hot=:hot',[':status'=>$status,':hot'=>true])
                ->limit($limit)
        ->orderBy(['p.order' => SORT_DESC, 'p.updated_at' => SORT_DESC])
                // ->offset($offset)
                ->asArray()
                ->all();
    }

    /*PHUC VU CHO CONTROLLER */
    public function getProductsHot($pageSize = 16,$status = true)
    {
        /*nếu joinWith thì phải distinct
        $query = Risks::find()->distinct()->joinWith(['solutions']);*/

        $data =  self::find()->alias('p')
                ->select(['id','pro_name','p.title','slug','price','price_sales','product_category_id','short_introduction','start_sale','end_sale'])
                ->where('p.status=:status AND hot=:hot',[':status'=>$status,':hot'=>true]);
        $result['pages'] = new Pagination([
            'totalCount' => $data->count(),
            'pageSize'=>$pageSize,
            'pageParam' => 'page',
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);
        $result['products'] =  $data->orderBy(['p.order' => SORT_ASC, 'p.updated_at' => SORT_DESC])
                                    ->offset($result['pages']->offset)
                                    ->limit($result['pages']->limit)
                                    ->all();
        return $result;
    }
// Hamf lấy danh sách tất cả sản phẩm hot
    
    /*categories/index*/
    /*public function getPagerProduct($cateIdList,$pageSize = 10)
    {
        // $data = Product::find()->asArray()->where('product_category_id =:cateId AND active =:status',['cateId'=>$cateId,'status'=>true]);
        $data = self::find()->asArray()->where(['IN', 'product_category_id', $cateIdList]);
        $pages = new Pagination([
                    'totalCount' => $data->count(),
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
    }*/

    // LAAYS CHI TIET SAN PHAM PRODUCT/VIEW
    /*hàm lấy danh sách sản phẩm cùng chuyên mục*/
    private function getAllProductBy($idPro,$category,$type='product_category_id',$limit=8)
    {
        $data = self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.views','p.content','p.title','p.slug','p.price','p.price_sales','p.product_category_id','p.keywords','p.descriptions','p.short_introduction','p.related_products','d.slug as slugCate','start_sale','end_sale'])
        ->with([
            'imageOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['idIma','image','title','pro_id','order']);
            },

            'proVersionsOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['id','pro_id','date','name','price_1','price_sale_1'])
                ->orderBy([
                    'date' => SORT_ASC,
                ])
                ->andOnCondition(['>=', 'date', date('Y-m-d')])
                ->andOnCondition(['status' => 1]);
            },
        ],true)
        // ->joinWith('danhmuc d',false)
        ->joinWith(['danhmuc d'])
        ->where('p.status=:status',[':status'=>true])
        ->andWhere(['!=', 'p.id',$idPro]);
        if ($type=='product_category_id') {
            $data->andWhere(['p.'.$type=>$category]);
        }
        return $data->limit($limit)->asArray()->all();
    }

    /*HAM LẤY CÁC SẢN PHẨM LIÊN QUAN*/
    public function getAllProductRelated($idArray,$limit = 16)
    {
        return  self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.views','p.title','p.slug','p.short_introduction','p.price','p.price_sales','p.image','d.slug as slugCate','start_sale','end_sale','pv.name as NameVersion'])
        ->joinWith(['danhmuc d','proVersionsOne pv'],false)

        ->with([
            // 'imageList as i' => function (\yii\db\ActiveQuery $query){
            'imageOne' => function (\yii\db\ActiveQuery $query){
                $query->select(['idIma','image','pro_id','order']);
                // $query->where(['i.status' => true]);
                // $query->orderBy(['i.order'=>SORT_ASC]);
                // $query->andWhere(['<>','pd.slug', $slug]);
                // $query->orderBy([
                //     'i.order' => SORT_ASC,
                //     'i.updated_at' => SORT_DESC,
                // ]);
                // $query->limit($offset)->offset($limit);
            },
            'proVersionsOne' => function (\yii\db\ActiveQuery $query){
               $query->select(['id','pro_id','date','name','price_1','price_sale_1'])
                ->orderBy([
                    'date' => SORT_ASC,
                ])
                ->andOnCondition(['>=', 'date', date('Y-m-d')])
                ->andOnCondition(['status' => 1]);
            },
        ],true)
        ->where('p.status=:status',[':status'=>true])
        ->andWhere(['IN','p.id',$idArray])
        ->asArray()->limit($limit)->all();
    }

    /*lấy sản phẩm cho ra chi tiết sp*/
    public function getProductBySlug($slug,$slugCate)
    {
        $data['product'] = self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.views','p.content','p.title','p.slug','p.price','p.price_sales','p.image','p.product_category_id','p.keywords','p.descriptions','p.short_introduction','p.related_products','p.related_articles','p.tab2','p.tab3','start_sale','end_sale','p.tags','p.related_albums', 'p.related_downloads'])
        ->joinWith('danhmuc d',false)
        ->joinWith([
            'imageList as im' => function (\yii\db\ActiveQuery $query){
                $query->select(['im.idIma','im.image','im.title','im.alt','im.order','im.updated_at','im.status','im.pro_id']);
                // $query->andWhere(['im.status' => true]);
                $query->orderBy([
                    'im.order' => SORT_ASC,
                    'im.created_at' => SORT_DESC,
                ]);
                // $query->limit($offset)->offset($limit);
            },
            'thuoctinh as t' => function (\yii\db\ActiveQuery $query){
                $query->select(['t.name','t.value','t.product_id']);
                // $query->andWhere(['im.status' => true]);
                $query->orderBy([
                    't.sort' => SORT_ASC,
                ]);
                // $query->limit($offset)->offset($limit);
            },
            'tagsAll as tg' => function (\yii\db\ActiveQuery $query){
                $query->select(['tg.value','tg.link','tg.slugTag']);
                // $query->andWhere(['im.status' => true]);
                // $query->orderBy([
                //     't.sort' => SORT_ASC,
                // ]);
                // $query->limit($offset)->offset($limit);
            },
        ])
        ->where('p.slug=:slug AND d.slug=:dslug AND p.status=:status',[':slug'=>$slug,':dslug'=>$slugCate,':status'=>true])
        // ->andWhere()
        ->one();
        if ($data['product']) {
            $data['cungdanhmuc']= $this->getAllProductBy($data['product']['id'],$data['product']['product_category_id']);
        // dbg($data['cungdanhmuc']);
            $data['productRelated']= ($data['product']['related_products']=='')? []: $this->getAllProductRelated(json_decode($data['product']['related_products']));
            $model = new FProductVersions();
            $data['versions'] = $model->getAllVersionPro($data['product']['id']);

            $model = new \frontend\models\news\FAlbum();
            $data['related_albums'] = ($data['product']['related_albums']=='')? [] : $model->findAllModel(json_decode($data['product']['related_albums']));

            $model = new \frontend\models\news\FDownloads();
            $data['related_downloads'] = ($data['product']['related_downloads']=='')? [] : $model->findAllModel(json_decode($data['product']['related_downloads']));
        }
        return $data;
    }

    /*lấy tất cả sản phẩm cho ra tags sp*/
    public function getProductsArrayID($IdList,$pageSize = 10,$status = true)
    {
        // $pages = $this->dataPagerProduct($cateIdList,$pageSize);
        /*nếu joinWith thì phải distinct
        $query = Risks::find()->distinct()->joinWith(['solutions']);*/
        $data =  self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.title','p.slug','p.price','p.price_sales','p.product_category_id','p.short_introduction','start_sale','end_sale','p.order'])
        // ->joinWith(['imageOne i','danhmuc d'],false)
        ->where('p.status=:status',[':status'=>$status])
        ->andWhere(['IN','p.id',$IdList]);

        $result['pages'] = new Pagination([
            'totalCount' => count($data->all()),
            'pageSize'=>$pageSize,
                    // 'forcePageParam' => 'trang',
                    // 'pageParam' => 'trang',
                    // 'pageParam' => yii\widgets\Pagination::createUrl(100),
                    // 'pageParam' => false,
                    // 'pageSizeParam' => ''
                    // 'pageParam' => 'start', 
                    // 'defaultPageSize' => 2,
            'pageParam' => 'page',
            'forcePageParam' => false,
            'pageSizeParam' => false,

                    // 'queryParam' => false
                    // 'route'=>'san-pham/<slug>/trang-<page:\d+>'
        ]);

        $result['listproduct'] = $data->orderBy(['p.order' => SORT_DESC, 'p.updated_at' => SORT_DESC])
                ->offset($result['pages']->offset)
                ->limit($result['pages']->limit)
                // ->asArray()
                ->all();
        return $result;
    }

    /*LAAYS CHI TIET SAN PHAM PRODUCT/VIEW*/

    // Laays san pham theo gio hang, mua hang, phục vụ mua hàng online
    public function getProductById($id)
    {
        $data = self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.title','p.slug','p.price','p.price_sales','p.image','d.slug as slugCate','start_sale','end_sale'])
        ->joinWith('danhmuc d',false)
        ->joinWith([
            'imageOne as i' => function (\yii\db\ActiveQuery $query){
                $query->select(['i.image','i.pro_id']);
            }
        ],true)
        ->where('p.status =:status AND p.id=:id',[':status'=>true,':id'=>$id])->asArray()->one();
        if ($data['price_sales']=='') {
            $data['price_sales'] = Yii::$app->formatter->asDecimal($data['price_sales']);
        }
        if ($data['price']=='') {
            $data['price'] = Yii::$app->formatter->asDecimal($data['price']);
        }
        if ($data['image']=='') {
            $data['image'] = 'images/products/p5.jpg';
        }
        return $data;
    }

    /*/tim kiem san pham*/
    public function getSearch($keysearch){
        return self::find()->alias('p')
        ->select(['p.id','p.pro_name','p.pro_name_not','p.title','p.slug','d.slug as slugCate','start_sale','end_sale','price_sales','price','p.short_introduction'])

        ->joinWith(['danhmuc d'],false)
        ->joinWith([
            // 'imageList as i' => function (\yii\db\ActiveQuery $query){
            'imageOne as i' => function (\yii\db\ActiveQuery $query){
                $query->select(['i.image','i.pro_id']);
                // $query->where(['i.status' => true]);
                // $query->orderBy(['i.order'=>SORT_ASC]);
                // $query->andWhere(['<>','pd.slug', $slug]);
                // $query->orderBy([
                //     'i.order' => SORT_ASC,
                //     'i.updated_at' => SORT_DESC,
                // ]);
                // $query->limit($offset)->offset($limit);
            }
        ],true)
        ->where('p.status =:status',[':status'=>true])
        ->andWhere(['like', 'p.pro_name', '%'.$keysearch.'%', false])
        // ->where(['like', 't.value', '%'.$keysearch.'%', false])
        ->orWhere(['like', 'p.pro_name_not', '%'.$keysearch.'%', false])

                ->groupBy(['p.pro_name'])
         // ->orderBy(['pro_name' => SORT_ASC])
        ->asArray()
         ->all();
         // return $data;
    }

    public function getProductByFilter($idCateArray,$idPro=[],$pageSize=10)
    {
        $data =  self::find()->alias('p')
                ->select(['p.id','p.pro_name','p.title','p.slug','p.price','p.price_sales','p.product_category_id','p.short_introduction','start_sale','end_sale','p.order','pv.name as NameVersion'])
                ->joinWith(['danhmuc d'],false)
                ->joinWith([
                    'proVersionsOne as pv' => function (\yii\db\ActiveQuery $query){
                        $query->select(['pv.name','pv.pro_id']);
                    }
                ],true)
                ->where('p.status=:status',[':status'=>true])
                ->andWhere(['IN', 'p.product_category_id', $idCateArray]);
                if(!empty($idPro)){
                    $data->andWhere(['IN', 'p.id', $idPro]);
                }

        /*$result['pages'] = new Pagination([
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
                ]);*/

        
        $result =  $data->orderBy(['p.order' => SORT_DESC, 'p.updated_at' => SORT_DESC])
                // ->offset($result['pages']->offset)
                // ->limit($result['pages']->limit)
                ->all();
        return $result;
    }
}
