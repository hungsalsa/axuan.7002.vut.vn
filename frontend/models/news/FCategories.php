<?php

namespace frontend\models\news;

use Yii;
use yii\helpers\ArrayHelper;

class FCategories extends \yii\db\ActiveRecord
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
            [['cateName', 'groupId', 'title', 'descriptions', 'status', 'created_at', 'updated_at', 'userAdd'], 'required'],
            [['groupId', 'parent_id', 'sort', 'status', 'created_at', 'updated_at', 'userAdd'], 'integer'],
            [['descriptions'], 'string'],
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
            'cateName' => 'Cate Name',
            'groupId' => 'Group ID',
            'parent_id' => 'Parent ID',
            'slug' => 'slug',
            'images' => 'Images',
            'sort' => 'Sort',
            'title' => 'Title',
            'keyword' => 'Keyword',
            'descriptions' => 'Descriptions',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userAdd' => 'User Add',
        ];
    }
    public function getChildrents()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);
    }
    public function getOnedownload()
    {
        return $this->hasOne(FDownloads::className(),['cate_id'=>'id']);
    }

    /*LẤY THÔNG TIN CATE CHO VIEW/NEWS*/
    public function getCateInfo($slug)
    {
        return self::find()->alias('pc')->select(['pc.id','pc.cateName','slug','pc.title','pc.keyword','pc.descriptions','pc.images'])
        ->where('pc.slug=:slug AND pc.status =:active',[':slug'=>$slug,'active'=>true])
        ->asArray()
        ->one();
    }

    public function getCateInfoById($id)
    {
        return self::find()->alias('c')->select(['c.id','c.cateName','c.slug','c.title','c.keyword','c.descriptions','od.name as downName'])
        ->joinWith(['onedownload od'],false)
        ->joinWith([
            'childrents as ch' => function ($query) {
                $query->select(['ch.id','ch.cateName','ch.slug','ch.title','ch.keyword','ch.descriptions','ch.parent_id','od.name as downName'])
                ->andOnCondition(['ch.status' => true])
                ->joinWith(['onedownload od'],false)
                ->joinWith([
                    'childrents as ch2' => function (\yii\db\ActiveQuery $query2) {
                        $query2->select(['ch2.id','ch2.cateName','ch2.slug','ch2.title','ch2.keyword','ch2.descriptions','ch2.parent_id','od.name as downName'])
                        // $query2->andWhere(['ch2.status'=>true]);
                        ->joinWith(['onedownload od'],false)
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
        if (!empty($data['childrents'])) {
            foreach ($data['childrents'] as $child1) {
                $result[] = $child1['id'];
                if (!empty($child1['childrents'])) {
                    foreach ($child1['childrents'] as $child2) {
                        $result[] = $child2['id'];
                    }
                }
            }
        }
        return $result;
    }

    /*HÀM LẤY DANH SÁCH CÁC CON THEO SLUG ĐỂ CHO RA NEWS/INDEX*/
    // Lấy tất cả các con của cateproduct, bao gồm cả nó
    /*    theo theo SLUG*/
    /* public function getIdChildCateById($idCate)
    {
        $data = $this->getCateInfoById($idCate);
        // $data = [];
        return self::find()->select(['id','slug','cateName','id','parent_id','sort'])->asArray()

        ->where('status =:active AND parent_id =:parent_id',[':active'=>1,':parent_id'=>$idCate])
        ->all();
        // $data[] = $result;
        
        // foreach ($result as $key =>$value) {
        //     $data['childrents'][] = $value;
        //     // self::getIdChildCateByslug($value['id']);
        // }
         $data;
    }*/
    public function getChildCateByslug($slug)
    {
        $data = self::find()->alias('pc')->select(['pc.id','pc.parent_id'])
        ->joinWith([
            'childrents as ch' => function (\yii\db\ActiveQuery $query) {
                $query
                    ->select(['ch.id','ch.parent_id'])
                    ->andOnCondition(['ch.status'=>true])

                    ->joinWith([
                        'childrents as ch2' => function (\yii\db\ActiveQuery $query2) {
                            $query2->select(['ch2.id','ch2.parent_id'])
                            ->andOnCondition(['ch2.status' => true]);
                            // ->joinWith(['sanpham ca2','baiviet cn2'],false);
                            
                        }
                    ]);
            },
        ])

        ->where('pc.slug=:slug AND pc.status =:status',[':slug'=>$slug,'status'=>true])
        ->asArray()
        ->one();
        $result[] = $data['id'];
        if ($data['childrents']) {
            foreach ($data['childrents'] as $child_1) {
                $result[] = $child_1['id'];
                if ($child_1['childrents']) {
                    foreach ($child_1['childrents'] as $child_2) {
                        $result[] = $child_2['id'];
                    }

                }
            }
        }

        return $result;
    }
    /*
    public function getChildCateByslug($slug)
    {
        $data = self::find()->alias('pc')->select(['pc.id','pc.parent_id'])
        // ->joinWith(['childrents'],true)
        ->joinWith([
            'childrents as ch' => function ($query) {
                $query->select(['ch.id','ch.parent_id']);
                // $query->andWhere(['ch.status'=> true]);
            },
        ],true)

        ->where('pc.slug=:slug AND pc.status =:active',[':slug'=>$slug,'active'=>true])
        ->asArray()
        ->one();
        // dbg($data);
        $result =[];
        if(isset($data)){
            if(isset($data['childrents'])){
                $result = array_values(ArrayHelper::map($data['childrents'],'id','id'));
            }
                $result[] = $data['id'];
        }
        
        return $result;
    }*/

    public function getAllCategories($idArray)
    {
        return yii\helpers\ArrayHelper::map(self::find()->select(['id','slug'])->where('status=:Active',[':Active'=>true])->andWhere(['IN','id',$idArray])->all(),'id','slug');
    }


    /*LẤY RA MẢNG TẤT CẢ CÁC SLUG SỬ DỤNG TRONG BẢNG NEWS*/

    public function getSlugCategoriesParentById($idCateArray,$parent = 0,$level = '')
    {
        $data=[];
        $result = self::find()->select(['slug','cateName','id'])->asArray()->where('status =:active AND parent_id =:parent',['active'=>1,'parent'=>$parent])->andWhere(['IN','id',$idCateArray])->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            $data[$value['slug']] = $level.$value['cateName'];
            self::getSlugCategoriesParentById($idCateArray,$value['id'],$level);
        }
        return $data;
    }

    public function getCategoryParentById($idCateArray,$field ='',$parent = 0,$level = '')
    {
        $data=[];
        $result = self::find()->select(['slug','cateName','id'])->asArray()->where('status =:active AND parent_id =:parent',['active'=>1,'parent'=>$parent])->andWhere(['IN','id',$idCateArray])->all();
        $level .='--| ';
        foreach ($result as $key=>$value) {
            if($parent == 0){
                $level=' --| ';
            }
            if ($field == '') {
                $data[$value['id']] = $level.$value['cateName'];
                self::getCategoryParentById($idCateArray,$field,$value['id'],$level);
            } else {
                $data[$value[$field]] = $level.$value['cateName'];
                self::getCategoryParentById($idCateArray,$field,$value['id'],$level);
            }
        }
        return $data;
    }

    public function getCategorySlugById($idCateArray)
    {
        return ArrayHelper::map(self::find()->select(['slug','id'])->where('status =:active',['active'=>1])->andWhere(['IN','id',$idCateArray])->all(),'slug','slug');
    }
}
