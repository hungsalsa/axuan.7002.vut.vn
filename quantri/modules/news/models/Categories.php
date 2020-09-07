<?php

namespace quantri\modules\news\models;

use Yii;


class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cateName', 'title', 'status', 'created_at', 'updated_at', 'userCreated','userUpdated'], 'required','message'=>'{attribute} không được để trống'],
            [['groupId', 'parent_id', 'status', 'created_at', 'updated_at', 'userCreated','userUpdated'], 'integer'],
            [['descriptions'], 'string'],
            [[ 'sort'], 'number'],
            [['cateName', 'slug', 'images', 'title', 'keyword'], 'string', 'max' => 255],
            [['cateName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cateName' => 'Tên danh mục',
            'groupId' => 'Nhóm danh mục',
            'parent_id' => 'Danh mục cha',
            'slug' => 'Đường dẫn',
            'images' => 'Ảnh',
            'title' => 'Title',
            'keyword' => 'Keywords',
            'descriptions' => 'Description',
            'status' => 'Trạng thái',
            'sort' => 'Sắp xếp',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'userCreated' => 'Người tạo',
            'userUpdated' => 'Người sửa',
        ];
    }
    public function getUserUpdate()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userUpdated']);
    }

    public function getParentCate()
    {
        return $this->hasOne(self::className(),['id'=>'parent_id']);
    }
    public function getChildCategories()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);
    }

    public function getNews()
    {
        return $this->hasMany(News::className(),['category_id'=>'id']);
    }

    public function getMenus()
    {
        return $this->hasMany(\quantri\modules\setting\models\Menus::className(),['link_cate'=>'id'])->andOnCondition(['type' => 2]);
    }

    public function getModules()
    {
        return $this->hasMany(\quantri\modules\setting\models\SettingModules::className(),['cate_id'=>'id'])->andOnCondition(['type_module' => 'news']);
    }

    public function getUserCreated()
    {
        return $this->hasOne(\quantri\models\User::className(),['id'=>'userCreated']);
    }

    // lấy tất cả id con cấp 3 của 1 danh mục
    public function getAllParentById($id)
    {
        return self::find()->alias('c')->select(['c.id','c.parent_id'])
        ->joinWith([
            'childCategories as ch' => function ($query) {
                $query->select(['ch.id','ch.parent_id'])
                ->andOnCondition(['ch.status' => true])
                ->joinWith([
                    'childCategories as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.id','ch2.parent_id'])
                        // $query2->andWhere(['ch2.status'=>true]);
                        ->andOnCondition(['ch2.status' => true]);
                        // $query2->andWhere(['chi.status'=>1]);
                        // $query2->joinWith(["category cai"],false);
                    }
                ]);
                // $query->andWhere(['ch.status'=> true]);
            },
        ],true)
        ->where('c.id=:id AND c.status =:active',[':id'=>$id,'active'=>true])
        ->asArray()
        ->one();
    }

    public function getAllChildIdByParent($idcate)
    {
        $data = $this->getAllParentById($idcate);
        // pr($data);
        // $result[] = $data['id'];
        $result =[] ;
        if (!empty($data['childCategories'])) {
            foreach ($data['childCategories'] as $child1) {
                $result[] = $child1['id'];
                if (!empty($child1['childCategories'])) {
                    foreach ($child1['childCategories'] as $child2) {
                        $result[] = $child2['id'];
                    }
                }
            }
        }
        return $result;
    }


    public function getCateInfoById($id)
    {
        return self::find()->alias('c')->select(['c.id','c.cateName','c.slug','c.title','c.keyword','c.descriptions'])
        ->joinWith([
            'childCategories as ch' => function ($query) {
                $query->select(['ch.id','ch.cateName','ch.slug','ch.title','ch.keyword','ch.descriptions','ch.parent_id'])
                ->andOnCondition(['ch.status' => true])
                ->joinWith([
                    'childCategories as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.id','ch2.cateName','ch2.slug','ch2.title','ch2.keyword','ch2.descriptions','ch2.parent_id'])
                        // $query2->andWhere(['ch2.status'=>true]);
                        ->andOnCondition(['ch2.status' => true])

                        ->orderBy([
                            'ch2.sort' => SORT_DESC,
                            'ch2.created_at' => SORT_DESC,
                        ]);
                        // $query2->andWhere(['chi.status'=>1]);
                        // $query2->joinWith(["category cai"],false);
                    }
                ])
                ->orderBy([
                    'ch.sort' => SORT_DESC,
                    'ch.created_at' => SORT_DESC,
                ]);
                // $query->andWhere(['ch.status'=> true]);
            },
        ],true)
        ->where('c.id=:id AND c.status =:active',[':id'=>$id,'active'=>true])
        ->asArray()
        ->one();
    }
    public function getAllChildId($idcate)
    {
        $data = $this->getCateInfoById($idcate);
        $result[] = $data['id'];
        if (!empty($data['childCategories'])) {
            foreach ($data['childCategories'] as $child1) {
                $result[] = $child1['id'];
                if (!empty($child1['childCategories'])) {
                    foreach ($child1['childCategories'] as $child2) {
                        $result[] = $child2['id'];
                    }
                }
            }
        }
        return $result;
    }

    /*public function getCateInfoById($id)
    {
        return self::find()->alias('c')->select(['c.id','c.cateName','c.slug','c.title','c.keyword','c.descriptions'])
        ->joinWith([
            'childrents as ch' => function ($query) {
                $query->select(['ch.id','ch.cateName','ch.slug','ch.title','ch.keyword','ch.descriptions','ch.parent_id'])
                ->andOnCondition(['ch.status' => true])
                ->joinWith([
                    'childrents as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.id','ch2.cateName','ch2.slug','ch2.title','ch2.keyword','ch2.descriptions','ch2.parent_id'])
                        // $query2->andWhere(['ch2.status'=>true]);
                        ->andOnCondition(['ch2.status' => true])

                        ->orderBy([
                            'ch2.sort' => SORT_DESC,
                            'ch2.created_at' => SORT_DESC,
                        ]);
                        // $query2->andWhere(['chi.status'=>1]);
                        // $query2->joinWith(["category cai"],false);
                    }
                ])
                ->orderBy([
                    'ch.sort' => SORT_DESC,
                    'ch.created_at' => SORT_DESC,
                ]);
                // $query->andWhere(['ch.status'=> true]);
            },
        ],true)
        ->where('c.id=:id AND c.status =:active',[':id'=>$id,'active'=>true])
        ->asArray()
        ->one();
    }
*/
    // private $child;
    // public function getAllChildId($idCateArray)
    // {
    //         $data = self::find()->select(['id','parent_id'])
    //         ->where('status =:status',['status'=>true])
    //         ->andWhere(['IN','parent_id',$idCateArray])
    //         ->asArray()
    //         ->all();
    //         // $idNews = yii\helpers\ArrayHelper::map($data,'id','id');
    //         // $this->child[] = $idNews ;

    //         // self::getAllChildId($idNews);
    //         // pr($idNews);
    //         // dbg($data);
    //         foreach ($data as $value) {
    //             $this->child[$value['id']] = $value['id'];
    //             self::getAllChildId([$value['id']]);
    //         }
    //     return $this->child;
    // }

    private $parent;
    public function getChildCate($idCateArray)
    {
            $data = self::find()->select(['id','parent_id'])
            ->where('status =:status',['status'=>true])
            ->andWhere(['IN','id',$idCateArray])
            ->asArray()
            ->all();
            // dbg($data);
            foreach ($data as $value) {
                $this->parent[$value['id']] = $value['id'];
                self::getChildCate([$value['parent_id']]);
            }
        return $this->parent;
    }

    private $dataType;
    public function getCategoryByType($idCate,$parent = 0, $level =""){
        $result = Categories::find()->asArray()
        ->where('parent_id=:parent AND status =:Status',['parent'=>$parent,'Status'=>1])
        ->andWhere(['id'=>$idCate])
        ->all();
        // dbg($result);
        // Tim tat ca cac 
        $level .=" --| ";
        foreach ($result as $key => $value) {
            if($parent == 0){
                $level = "";
            }
            $this->dataType[$value["id"]] = $level.$value["cateName"];
            self::getCategoryByType($value['id'],$level);
        }
        return $this->dataType;
    }

    private $data;
    public function getCategoryParent($parent = 0, $level =""){
        $result = Categories::find()->asArray()->where('parent_id=:parent AND status =:Status',['parent'=>$parent,'Status'=>1])->all();
        // Tim tat ca cac 
        $level .=" --| ";
        foreach ($result as $key => $value) {
            if($parent == 0){
                $level = "";
            }
            $this->data[$value["id"]] = $level.$value["cateName"];
            self::getCategoryParent($value['id'],$level);
        }
        return $this->data;
    }

    private $data_4;
    public function getCategoryParentField($idCateArray,$field = 'slug',$parent = 0,$level = '')
    {
        
        $result = Categories::find()->select(['slug','cateName','id'])->asArray()->where('status =:status AND parent_id =:parent',['status'=>1,'parent'=>$parent])
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
            self::getCategoryParentField($idCateArray,$field,$value['id'],$level);
        }
        return $this->data_4;
    }

    public function getCategoriesById($id)
    {
        $result = self::find()->select('slug')->where('id=:id',['id'=>$id])->one();
        return $result->slug;
    }
    
}