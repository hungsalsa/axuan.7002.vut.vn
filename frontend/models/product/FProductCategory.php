<?php
namespace frontend\models\product;

use Yii;
use yii\helpers\ArrayHelper;

class FProductCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_product_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cateName', 'active', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'required'],
            [['keyword', 'description', 'content', 'short_introduction'], 'string'],
            [['order'], 'number'],
            [['product_parent_id', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['title', 'cateName', 'slug', 'image'], 'string', 'max' => 255],
            [['home_page', 'active'], 'string', 'max' => 4],
            [['cateName', 'slug'], 'unique', 'targetAttribute' => ['cateName', 'slug']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCate' => 'Id Cate',
            'title' => 'Title',
            'cateName' => 'Cate Name',
            'slug' => 'Slug',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'content' => 'Content',
            'short_introduction' => 'Short Introduction',
            'home_page' => 'Home Page',
            'image' => 'Image',
            'order' => 'Order',
            'active' => 'Active',
            'product_parent_id' => 'Product Parent ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userCreated' => 'User Created',
            'userUpdated' => 'User Updated',
        ];
    }

    public function getAllCategoryToSlug($idArray=[])
    {
        if (empty($idArray)) {
            return ArrayHelper::map(self::find()->select(['idCate','slug'])->where(['active'=>true])->all(),'idCate','slug');
        } else {
            return ArrayHelper::map(self::find()->select(['idCate','slug'])->where(['active'=>true])->andWhere(['IN','idCate',$idArray])->all(),'idCate','slug');
            
        }
    }

    /*hàm lấy tất cả các danh mục con của nó*/
    private $parent;
    public function getChildCate($idCateArray)
    {
        $this->parent = $idCateArray;
        $data = self::find()->select(['idCate','product_parent_id'])
        ->where('active =:active',['active'=>true])
        ->andWhere(['IN','product_parent_id',$idCateArray])
        ->asArray()
        ->all();
            // dbg($data);
        foreach ($data as $value) {
            $this->parent[$value['idCate']] = $value['idCate'];
        //     // self::getChildCate([$value['product_parent_id']]);
        }
        return $this->parent;
    }

    public function getParent()
    {
        return $this->hasOne(self::className(),['idCate'=>'product_parent_id']);
    }

    public function getChildrents()
    {
        return $this->hasMany(self::className(),['product_parent_id'=>'idCate']);
    }

    // Hàm lấy tất cả các danh mục hieenj trang chu
    public function getAllShowhomepage($status=true)
    {
        return self::find()->alias('c')->select(['c.idCate','title','c.cateName','c.slug','c.product_parent_id','image'])
        // ->joinWith([
        //     'parent as p' => function (\yii\db\ActiveQuery $query) {
        //         $query->select(['p.idCate','p.cateName','p.slug']);
        //     },
        // ])
        ->where('c.home_page=:home_page AND c.active =:active',[':home_page'=>true,'active'=>$status])
        ->orderBy(['c.order' => SORT_DESC, 'c.updated_at' => SORT_DESC])
        ->asArray()->all();
    }
    // Hàm lấy tất cả các danh mục cha cho view/product
    public function getAllParent($idCate)
    {
        return self::find()->alias('c')->select(['c.idCate','c.cateName','c.slug','c.product_parent_id'])
        ->joinWith([
            'parent as p' => function (\yii\db\ActiveQuery $query) {
                $query->select(['p.idCate','p.cateName','p.slug']);
            },
        ])
        ->where('c.idCate=:idCate AND c.active =:active',[':idCate'=>$idCate,'active'=>true])
        ->asArray()->one();
    }

    // Lấy tất ra thoong tin của danh mục cho seo
    public function getCategoryProductForSeo($slug)
    {
        return self::find()->select(['idCate','title','cateName','keyword','description','image','slug','short_introduction','content'])
        // ->joinWith([
            
        //     'childrents as ch' => function (\yii\db\ActiveQuery $query) {
        //         $query->select(['ch.idCate','ch.cateName','ch.slug']);
        //     },
        // ])
        ->where('slug=:slug AND active =:active',[':slug'=>$slug,'active'=>true])
        ->asArray()
        ->one();
        
    }

    // Lấy tất cả các con của cateproduct, bao gồm cả nó
    /*    theo theo SLUG*/
    /*public function getMenusIDAllChild($idMenu)
    {
        $result[] = $link_cate;
        
        $data = self::find()->alias('m')->select(['m.id','m.link_cate','m.parent_id'])
        ->joinWith([
            'childrens ch' => function (\yii\db\ActiveQuery $query) use ($type) {
                $query->select(['ch.link_cate','ch.parent_id'])
                ->andOnCondition(['ch.type' => $type,'ch.status'=>true]);
            },
        ],true)
        ->where('m.status=:active AND m.parent_id=:parent',[':active'=>true,':parent'=>$idMenu])->asArray()->all();
        foreach ($data as $child_1) {
            $result[] = $child_1['link_cate'];
            if ($child_1['childrens']) {
                foreach ($data as $child_2) {
                    $result[] = $child_2['link_cate'];
                }
                
            }
        }

        return array_unique($result);
    }*/

    public function getChildCateByslug($slug)
    {
        $data = self::find()->alias('pc')->select(['pc.idCate','pc.product_parent_id'])
        ->joinWith([
            'childrents as ch' => function (\yii\db\ActiveQuery $query) {
                $query
                    ->select(['ch.idCate','ch.product_parent_id'])
                    ->andOnCondition(['ch.active'=>true])

                    ->joinWith([
                        'childrents as ch2' => function (\yii\db\ActiveQuery $query2) {
                            $query2->select(['ch2.idCate','ch2.product_parent_id'])
                            ->andOnCondition(['ch2.active' => true]);
                            // ->joinWith(['sanpham ca2','baiviet cn2'],false);
                            
                        }
                    ]);
            },
        ])

        ->where('pc.slug=:slug AND pc.active =:active',[':slug'=>$slug,'active'=>true])
        ->asArray()
        ->one();
        $result[] = $data['idCate'];
        if ($data['childrents']) {
            foreach ($data['childrents'] as $child_1) {
                $result[] = $child_1['idCate'];
                if ($child_1['childrents']) {
                    foreach ($child_1['childrents'] as $child_2) {
                        $result[] = $child_2['idCate'];
                    }

                }
            }
        }

        return array_unique($result);
    }

    public function getCategoryParentById($idCateArray,$field ='',$parent = 0,$level = '')
    {
        $data=[];
        $result = FProductcategory::find()->select(['slug','cateName','idCate'])->asArray()->where('active =:active AND product_parent_id =:parent',['active'=>1,'parent'=>$parent])->andWhere(['IN','idCate',$idCateArray])->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            if ($field == '') {
                $data[$value['idCate']] = $level.$value['cateName'];
                self::getCategoryParentById($idCateArray,$field,$value['idCate'],$level);
            } else {
                $data[$value[$field]] = $level.$value['cateName'];
                self::getCategoryParentById($idCateArray,$field,$value['idCate'],$level);
            }
        }
        return $data;
    }
    public function getCategorySlugById($idCateArray)
    {
        return ArrayHelper::map(self::find()->select(['slug','idCate'])->where('active =:active',['active'=>1])->andWhere(['IN','idCate',$idCateArray])->all(),'slug','slug');
    }
}
