<?php

namespace quantri\modules\products\models;
use Yii;
use yii\helpers\ArrayHelper;
use quantri\models\User;
class Productcategory extends \yii\db\ActiveRecord
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
            [['title', 'cateName', 'active'], 'required','message'=>'{attribute} không được để trống'],
            [['keyword', 'description', 'content', 'short_introduction'], 'string'],
            [['product_parent_id', 'created_at', 'updated_at', 'userCreated', 'userUpdated','active'], 'integer','message'=>'{attribute} không phải là số'],
            [['title', 'cateName', 'slug', 'image'], 'string', 'max' => 255],
            // [['home_page', 'active'], 'string', 'max' => 4],
            [['order'], 'number'],
            [['home_page'], 'safe'],
            [['cateName', 'slug'], 'unique', 'targetAttribute' => ['cateName', 'slug']],
            [['product_parent_id'],'validateCategory','on'=>['update']],
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
            'cateName' => 'Tên danh mục',
            'slug' => 'Đường dẫn',
            'keyword' => 'Keywords',
            'description' => 'Description',
            'content' => 'Mô tả 2',
            'short_introduction' => 'Mô tả 1',
            'home_page' => 'Hiện ở Home',
            'image' => 'Ảnh',
            'order' => 'Sắp xếp',
            'active' => 'Trạng thái',
            'product_parent_id' => 'Danh mục cha',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày chỉnh sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }

    public function validateCategory($attribute, $params)
    {
        $count = self::find()->where('active=:active AND product_parent_id=:parent',[':active'=>true,':parent'=>0])->all();
        $old_parent = self::find()->select('product_parent_id')->where('idCate=:idCate',[':idCate'=>$this->idCate])->one();
        $one = $count[0];
        if ($one->idCate == $this->idCate && count($count) ==1 && $this->$attribute != 0) {
            $this->addError($attribute, 'Bạn không thể chọn danh mục cha cho danh mục này, danh mục này đang là danh mục Root duy nhất');
        }
    }

    public function getUseradd()
    {
        return $this->hasOne(User::className(),['id'=>'userCreated']);
    }
    public function getParent()
    {
        return $this->hasOne(self::className(),['idCate'=>'product_parent_id']);
    }
    public function getChild()
    {
        return $this->hasMany(self::className(),['product_parent_id'=>'idCate']);
    }
    public function getProducts()
    {
        return $this->hasMany(Products::className(),['product_category_id'=>'idCate']);
    }


    public function getMenus()
    {
        return $this->hasMany(\quantri\modules\setting\models\Menus::className(),['link_cate'=>'idCate'])->andOnCondition(['type' => 1]);
    }

    public function getModules()
    {
        return $this->hasMany(\quantri\modules\setting\models\SettingModules::className(),['cate_id'=>'idCate'])->andOnCondition(['type_module' => 'product']);
    }

    // lấy tất cả id con cấp 3 của 1 danh mục
    public function getCateInfoById($id)
    {
        return self::find()->alias('c')->select(['c.idCate','c.product_parent_id'])
        ->joinWith([
            'child as ch' => function ($query) {
                $query->select(['ch.idCate','ch.product_parent_id'])
                ->andOnCondition(['ch.active' => true])
                ->joinWith([
                    'child as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.idCate','ch2.product_parent_id'])
                        // $query2->andWhere(['ch2.status'=>true]);
                        ->andOnCondition(['ch2.active' => true]);
                        // $query2->andWhere(['chi.status'=>1]);
                        // $query2->joinWith(["category cai"],false);
                    }
                ]);
                // $query->andWhere(['ch.status'=> true]);
            },
        ],true)
        ->where('c.idCate=:id AND c.active =:active',[':id'=>$id,'active'=>true])
        ->asArray()
        ->one();
    }

    public function getAllChildIdByParent($idcate)
    {
        $data = $this->getCateInfoById($idcate);
        // pr($data);
        // $result[] = $data['idCate'];
        $result =[] ;
        if (!empty($data['child'])) {
            foreach ($data['child'] as $child1) {
                $result[] = $child1['idCate'];
                if (!empty($child1['child'])) {
                    foreach ($child1['child'] as $child2) {
                        $result[] = $child2['idCate'];
                    }
                }
            }
        }
        return $result;
    }
    // Lấy tất cả các cha của idCateArray
    private $parent;
    public function getChildCate($idCateArray)
    {
            $data = self::find()->select(['idCate','product_parent_id'])
            ->where('active =:active',['active'=>true])
            ->andWhere(['IN','idCate',$idCateArray])
            ->asArray()
            ->all();
            // pr($data);
            foreach ($data as $value) {
                $this->parent[$value['idCate']] = $value['idCate'];
                self::getChildCate([$value['product_parent_id']]);
            }
        return $this->parent;
    }
  

    private $data;
    public function getCategoryParent($parent = 0,$level = '')
    {
        $result = Productcategory::find()->asArray()->where('active =:active AND product_parent_id =:parent',['active'=>1,'parent'=>$parent])->all();
        // pr($result);
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            $this->data[$value['idCate']] = $level.$value['cateName'];
            self::getCategoryParent($value['idCate'],$level);
        }
        return $this->data;
    }

    
    private $data_3;
    public function getSlugCategoryParentById($idCateArray,$parent = 0,$level = '')
    {
        
        $result = Productcategory::find()->select(['slug','cateName','idCate'])->asArray()->where('active =:active AND product_parent_id =:parent',['active'=>1,'parent'=>$parent])
        // ->andWhere(['IN','idCate',$idCateArray])
        ->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            $this->data_3[$value['slug']] = $level.$value['cateName'];
            self::getSlugCategoryParentById($idCateArray,$value['idCate'],$level);
        }
        return $this->data_3;
    }

    private $data_4;
    public function getCategoryParentField($idCateArray,$field = 'slug',$parent = 0,$level = '')
    {
        
        $result = Productcategory::find()->select(['slug','cateName','idCate'])->asArray()->where('active =:active AND product_parent_id =:parent',['active'=>1,'parent'=>$parent])
        // ->andWhere(['IN','idCate',$idCateArray])
        ->all();
        
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            // pr($value['cateName']);
        // pr($value[$field]);
        // dbg($field);
            $this->data_4[$value[$field]] = $level.$value['cateName'];
            self::getCategoryParentField($idCateArray,$field,$value['idCate'],$level);
        }
        return $this->data_4;
    }

    public function getAllCat($status = 1)
    {
        return ArrayHelper::map(Productcategory::find()->where('active =:active',['active'=>$status])->all(),'idCate','cateName');
    }

    public function getSlugcate($idCate,$status = 1)
    {
       $data = Productcategory::find()->select('slug')->asArray()->where('active =:active AND idCate=:id',['active'=>$status,'id'=>$idCate])->one();
       if ($data) {
         return $data['slug'];unset($data);
       } else {
        return false;           
       }
    }
}